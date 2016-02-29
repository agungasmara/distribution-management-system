@extends('master')





@section('heading')

Discard Stocks


@endsection
@section('breadcrumb')


<li>
    <a href="#">Stocks</a>
</li>
<li class="active">
    <strong>Discard Stocks</strong>
</li>


@endsection


@section('headerbuttons')
@endsection






@section('content')

<br>
<div class="row" style="padding:0cm">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">

            <div class="ibox-content">
                <legend> Main Info</legend>
                <form class="form-horizontal" id="stockMain" onsubmit="return insertSM()">





                    <div class="form-group">

                        <label class="col-lg-2 control-label">Reverse GRN Code</label>

                        <div class="col-lg-4"><input   class="form-control" type="text" required id="grncode" name="grncode">

                        </div> 

                        <label class="col-lg-2 control-label">Discard Date</label>

                        <div class="col-lg-4"><input   class="form-control" type="text" required id="rdate" name="rdate" value="{{date('Y-m-d')}}">


                        </div> 
                    </div>




                    <div class="form-group">
                        <label class="col-lg-2 control-label">Remarks</label>

                        <div class="col-lg-6"><textarea placeholder="Any special Comments?" class="form-control" type="text" required id="remarks" name="remarks"> </textarea>
                        </div>

                    </div>







                </form>




            </div>
        </div>

        <div class="ibox float-e-margins">

            <div class="ibox-content">
                <legend> Discard Stock Info </legend>
                <form class="form-horizontal" id="stock1" onsubmit="return insert()">



                    <div class="form-group">

                        <label class="col-lg-2 control-label"> Product </label>

                        <div class="col-lg-10">

                            <select class="  chosen-select" style="width:350px;" tabindex="4" id="product" name="product">

                                @foreach($products as $p)

                                <option value="{{$p->id}}" data-available="{{$p->available}}" data-name="{{$p->product_name}}-{{$p->sub_name}}"> {{$p->product_name}}-{{$p->sub_name}} ( <b> {{number_format($p->available)}} Stocks Available </b>)</option>
                                @endforeach

                            </select>

                        </div>
                    </div>
                    <input type="text" id="sid" name="sid" hidden="true">
                    <div class="form-group">

                        <label class="col-lg-2 control-label">Quantitiy</label>

                        <div class="col-lg-4"><input   class="form-control" type="number" required id="quantity" name="qty">

                        </div>



                        <div class="col-md-offset-4  col-lg-2">


                            <button type="submit" class="btn btn-primary btn-block"> Add </button>
                        </div>
                    </div>











                </form>




            </div>
        </div>



        <div class="ibox float-e-margins">

            <div class="ibox-content">
                <legend>Discard Stock List</legend>
                <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>Product Name</th>
                            <th>Discard Quantitiy</th>


                            <th class="col-md-1"></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>

            </div>
        </div>

        <div class="col-lg-offset-10 col-lg-2">


            <button class="btn btn-danger btn-block" id="dne" disabled type="button" onclick="saveall()">Discard All</button>
        </div>


    </div>
</div>

@endsection



@section('js')


<script>


    //Test for browser compatibility
    if (window.openDatabase) {
        //Create the database the parameters are 1. the database name 2.version number 3. a description 4. the size of the database (in bytes) 1024 x 1024 = 1MB
        var mydb = openDatabase("temp_load_items", "0.1", "A DB for local load Data", 1024 * 1024);

        //create  table using SQL for the database using a transaction
        mydb.transaction(function (t) {

            t.executeSql("DROP TABLE IF  EXISTS discard_items_temp");

            t.executeSql("CREATE TABLE IF NOT EXISTS discard_items_temp (id INTEGER PRIMARY KEY ASC,  product_id INTEGER, quantity INTEGER , product_name TEXT)");
        });

    } else {
        alert("WebSQL is not supported by your browser!");
    }




    function change(a){

        var max = $('#product').children('option:selected').data('available');

        if(max == null || max == ""){
            $('#quantity').attr({
                "max" : 0,        // substitute your own
                "min" : 0  

            });

        }else{
            $('#quantity').attr({
                "max" : max,        // substitute your own
                "min" : 1  

            });
        }

    }

    $('document').ready(function(){

        $('#sto').click();
        document.getElementById("dis").setAttribute('class','active');



        $('#stock1').find('input, textarea, button, select').attr('disabled','disabled');
        enableStocks();


        $('#product').chosen({

            width:"100%"

        });

        $('#rdate').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format:"yyyy-mm-dd"
        });


        $('#exp').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format:"yyyy-mm-dd"
        });

    });



    function saveall(){

        if (mydb) {
            //Get all the cars from the database with a select statement, set outputCarList as the callback function for the executeSql command
            mydb.transaction(function (t) {
                t.executeSql("SELECT * FROM discard_items_temp", [], function(transaction, result){

                    if (result.rows.length == 0) {
                        alert("No items loaded!");
                    }else{




                        var dataSet = [];

                        for ( var i = 0; i < result.rows.length; i++) {
                            var row = result.rows.item(i);
                            dataSet.push(row);
                        }

                        var grncode = $('#grncode').val();
                        var ddate = $('#rdate').val();
                        var remarks = $('#remarks').val();




                        $.ajax({
                            type: "get",
                            url: 'insert_discard',
                            data: {
                                data: dataSet,
                                grncode:grncode,
                                ddate :ddate,
                                remarks : remarks

                            },

                            success : function(data){

                                console.log(data);
                                location.reload();


                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                console.log(thrownError);
                            }	 
                        }); 


                    }


                });
            });
        } else {
            alert("db not found, your browser does not support web sql!");
        }

        return false;

    }


    function enableStocks(){


        // $('#stockMain').find('input, textarea, button, select').attr('disabled','disabled');
        $('#stock1').find('input, textarea, button, select').removeAttr('disabled','disabled');

        $('#product').prop('disabled', false).trigger("chosen:updated");

        $('#dne').removeAttr('disabled','disabled');

    }


    function insert(){

        if (mydb) {
            //get the values of the make and model text inputs
            var productid = $('#product').val();
            var quantitiy =  $('#quantity').val();
            var name = $('#product').children('option:selected').data('name');
            console.log("started");
            //Insert the user entered details into the cars table, note the use of the ? placeholder, these will replaced by the data passed in as an array as the second parameter
            mydb.transaction(function (t) {
                t.executeSql("INSERT INTO discard_items_temp(product_id, quantity, product_name) VALUES (?,?,?)", [productid, quantitiy,name]);

                LoadItems();

            });

        } else {
            alert("db not found, your browser does not support web sql!");
        }



        return false; 


    }


    function LoadItems() {
        //check to ensure the mydb object has been created
        if (mydb) {
            //Get all the cars from the database with a select statement, set outputCarList as the callback function for the executeSql command
            mydb.transaction(function (t) {
                t.executeSql("SELECT * FROM discard_items_temp", [], dataLoad);
            });
        } else {
            alert("db not found, your browser does not support web sql!");
        }
    }

    function dataLoad(transaction, result){
        console.log(result);

        var dataSet = [];

        for ( var i = 0; i < result.rows.length; i++) {
            var row = result.rows.item(i);
            dataSet.push(row);
        }

        console.log(dataSet);

        var oTable = $('#dd').DataTable();
        oTable.destroy();

        $('#dd').DataTable( {
            "data" : dataSet,
            "columns": [

                { "data": "id" },
                { "data": "product_name" },
                { "data": "quantity" },

                {"data" : null,
                 "mRender": function(data, type, full) {


                     return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="del('+data.id+')" > Delete </button>';
                 }
                }
            ]
        } );  
    }


    function del(id){

        if (mydb) {
            //Get all the cars from the database with a select statement, set outputCarList as the callback function for the executeSql command
            mydb.transaction(function (t) {
                t.executeSql("DELETE FROM discard_items_temp WHERE id=?", [id]);
                LoadItems();

            });
        } else {
            alert("db not found, your browser does not support web sql!");
        }
    }

</script>
@endsection