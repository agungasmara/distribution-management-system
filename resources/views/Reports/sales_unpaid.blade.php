@extends('master')





@section('heading')

Unpaid Customers


@endsection
@section('breadcrumb')


<li>
    <a href="#">Reports</a>
</li>
<li class="active">
    <strong>Unpaid Customers</strong>
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
                            <th class="col-md-3">Customer</th>

                            <th>Date</th>
                            <th>Bill Num</th>
                            <th>Net Sale Amt</th>
                            <th>Age (Days)</th>
                            <th>Documents</th>
                            
                        </tr>

                    </thead>
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
        document.getElementById("UNP").setAttribute('class','active');

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
            "ajax": "sales_unpaidReport?"+$('#f1').serialize(),
            "columns": [
                { "data": "customer" },
                { "data": "date" },
                { "data": "bill_num" },
                { "data": "net_total" },
                { "data": "age" },
                { "data": "id" }
              

            ]
        } );
        return false;
    }
</script>
@endsection