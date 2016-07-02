@extends('master')





@section('heading')

Invoice Report Summary


@endsection
@section('breadcrumb')


<li>
    <a href="#">Reports</a>
</li>
<li class="active">
    <strong>Invoice Report Summary</strong>
</li>


@endsection









@section('content')


<br>

<div class="row" style="padding:0cm">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">

            <div class="ibox-content">

                <form class="form-horizontal" id="f1" onsubmit="return dataLoad()">
                    <div class="form-group">

                        <label class="col-lg-1 control-label">Vehicle</label>

                        <div class="col-lg-4">

                            <select class="  chosen-select" style="width:350px;" tabindex="4" id="vehicle" name="vehicle"  required>

                                <option value="0">All</option>

                                @foreach($vehicles as $v)

                                <option value="{{$v->id}}"> {{$v->vehicle_number }} - {{$v->vehicle_type}} ({{$v->vehicle_model }}) </option>


                                @endforeach

                            </select>
                        </div>  

                        <label class="col-lg-1 control-label">Date</label>


                        <div class="col-lg-4">
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" class="input form-control" name="start" value="{{date('Y-m-d')}}"/>
                                <span class="input-group-addon">to</span>
                                <input type="text" class="input form-control" name="end" value="{{date('Y-m-d')}}" />
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" onclick="dataLoad()" class="btn btn-block btn-primary">Search</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="row" style="padding:0cm">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">

            <div class="ibox-content">

                <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable"  style="font-size:85%">
                    <thead>
                        <tr>
                            <th class=""> Invoice Number</th>
                            <th>Date</th>
                            <th>Customer Name</th>
                            <th>Vehicle Number</th>

                            <th>Total</th>
                            <th>Paid</th>
                            <th>Due</th>

                        </tr>

                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="4" style="text-align:right">Total:</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>

                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

    $('document').ready(function(){



        $('#repo').click();
        document.getElementById("INV").setAttribute('class','active');

        $('.input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            format:"yyyy-mm-dd"
        });


        $('#vehicle').chosen({

            width:"100%"

        });

    });


    function dataLoad(){

        var oTable = $('#dd').DataTable();
        oTable.destroy();

        $('#dd').DataTable( {
            "ajax": "sales_summary_invoice_report?"+$('#f1').serialize(),
            "columns": [
                { "data": "bill_num" },
                { "data": "date" },
                { "data": "customer" },
                { "data": "vehicle_number" },
                { "data": "net_total" },
                { "data": "paid" },
                { "data": "due" }


            ],
            "iDisplayLength": 10000,
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
                };

                // Total over all pages
                var  total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );


                var paid =     api
                .column( 5)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ); 

                var due =     api
                .column( 6)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                // Update footer
                $( api.column( 4 ).footer() ).html(
                    total
                );
                
                 $( api.column( 5 ).footer() ).html(
                    paid
                );
                
                 $( api.column( 6 ).footer() ).html(
                    due
                );
            }
        } );
        return false;
    }
</script>
@endsection