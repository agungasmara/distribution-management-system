@extends('master')





@section('heading')

Sales Summary - Item Wise


@endsection
@section('breadcrumb')


<li>
    <a href="#">Reports</a>
</li>
<li class="active">
    <strong>Sales - Item Wise</strong>
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
                        <tr class="info">

                            <th>Item</th>
                            <th colspan="2">Bill</th>
                            <th colspan="2">Free</th>
                            <th colspan="2">M/R</th>
                            <th colspan="2">G/R</th>
                            <th colspan="2">Exchange</th>
                            <th colspan="2">Net Sold Qty.</th>

                        </tr>
                        <tr class="">
                            <th class="col-md-2">Name</th>

                            <th>Qty</th>
                            <th>Amt</th>
                            <th>Qty</th>
                            <th>Amt</th>
                            <th>Qty</th>
                            <th>Amt</th>
                            <th>Qty</th>
                            <th>Amt</th>
                            <th>Qty</th>
                            <th>Amt</th>
                            <th>Qty</th>
                            <th>Amt</th>

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
        document.getElementById("SMI").setAttribute('class','active');
        
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
            "ajax": "sales_summary_itemwise_info?"+$('#f1').serialize(),
            "columns": [
                { "data": "sub_name" },
                { "data": "qty" },
                { "data": "qty_amt" },
                { "data": "free" },
                { "data": "free_amt" },
                { "data": "mr" },
                { "data": "mr_amt" },
                { "data": "gr" },
                { "data": "gr_amt" },
                { "data": "ex" },
                { "data": "ex_amt" },
                { "data": "sold" },
                { "data": "sold_amt" }

            ]
        } );
        return false;
    }
</script>
@endsection