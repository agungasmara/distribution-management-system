@extends('master')





@section('heading')

Load Vehicle | <span class="label label-success">{{$vehicle->vehicle_model}}</span> <span class="label label-primary">{{$vehicle->vehicle_number}}</span> <span class="label label-info text-uppercase">{{$vehicle->vehicle_type}}</span>


@endsection
@section('breadcrumb')


<li>
    <a href="#">Loading/Unloading</a>
</li>
<li>
    <a href="load">Load Vehicle</a>
</li>
<li class="active">
    <strong>Load</strong>
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

                <form class="form-horizontal" onsubmit="return insert()">

                    <legend> Main Info </legend>
                    <div class="form-group">

                        <label class=" col-md-2 control-label"> Route </label>

                        <div class="col-md-8" >

                            <select class="  chosen-select" style="width:350px;" tabindex="4" id="route" name="route">

                                @foreach($routes as $r)

                                <option value="{{$r->id}}">{{$r->route_name}} ({{$r->start}} - {{$r->end}}) </option>

                                @endforeach

                            </select>



                        </div>


                    </div> <br>

                    <legend> Add Products</legend>  
                    <div class="form-group">

                        <label class=" col-md-1 control-label"> Product </label>

                        <div class="col-md-7" >

                            <select class="  chosen-select" style="width:350px;" tabindex="4" id="product" name="product" onchange="change(this)" required>


                                @foreach($products as $p)

                                <option value="{{$p->id}}" data-available="{{$p->available}}" data-name="{{$p->product_name}}-{{$p->sub_name}}"> {{$p->product_name}}-{{$p->sub_name}} ( <b> {{number_format($p->available)}} Stocks Available </b>)</option>


                                @endforeach

                            </select>



                        </div>

                        <div class="col-md-2">

                            <input name="quantity" id="quantity" type="number" placeholder="Qunatitiy" class="form-control" required>
                        </div>

                        <div class="col-md-2">

                            <button class="btn btn-primary btn-block"  type="submit"> Add</button>
                        </div>
                    </div>



                    <input type="text" id="vid" name="vid" value="{{$vehicle->id}}" hidden="true">

                </form>

            </div>
        </div>
    </div>
</div>



<div class="row" style="padding:0cm">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">

            <div class="ibox-content">
                <legend> Loaded Products</legend>
                <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                    <thead>
                        <tr>

                            <th>#</th>
                            <th>Product Name</th>
                            <th>Quantity</th>

                            <th class="col-md-1"></th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>

<div class="col-md-offset-9 col-md-3">


    <button class="btn btn-primary btn-block" onclick="saveall()"> Save</button>

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

            t.executeSql("DROP TABLE IF  EXISTS load_items_temp");

            t.executeSql("CREATE TABLE IF NOT EXISTS load_items_temp (id INTEGER PRIMARY KEY ASC,  product_id INTEGER, quantity INTEGER , product_name TEXT)");
        });

    } else {
        alert("WebSQL is not supported by your browser!");
    }



    $('document').ready(function(){


        //document.getElementById("man").setAttribute('class','active');
        // document.getElementById("man").click();
        $('#loa').click();
        document.getElementById("load").setAttribute('class','active');
        LoadItems();
        $('#route').chosen({

            width:"100%"

        });

        $('#product').chosen({

            width:"100%"

        });

        change("0");
    });


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

    function edit(id){

        document.getElementById("route_id").innerHTML = id;
        $.ajax({
            type: "get",
            url: 'get_vehicle_info',
            data: {id : id},

            success : function(data){

                console.log(data);
                document.getElementById("modelE").value =  data.vehicle_model;
                document.getElementById("vehi_numE").value =  data.vehicle_number;
                document.getElementById("typeE").value =  data.vehicle_type;
                document.getElementById("remarksE").value =  data.remarks;
                document.getElementById("idE").value =  id;

                document.getElementById("button_edit").setAttribute('onClick','edit_final('+id+')');

                $('#edit-routes').modal('show');

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        });





    }

    function edit_final(id){

        $.ajax({
            type: "get",
            url: 'edit_vehicles',
            data: $('#addRE').serialize(),

            success : function(data){

                $('#edit-routes').modal('hide');
                dataLoad();

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        });





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



    function LoadItems() {
        //check to ensure the mydb object has been created
        if (mydb) {
            //Get all the cars from the database with a select statement, set outputCarList as the callback function for the executeSql command
            mydb.transaction(function (t) {
                t.executeSql("SELECT * FROM load_items_temp", [], dataLoad);
            });
        } else {
            alert("db not found, your browser does not support web sql!");
        }
    }

    function addLoad(id,model,type,number){

        $('#model').html(model);
        $('#vnum').html(number);
        $('#vtype').html(type);

        $('#add-load').modal('show');

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
                t.executeSql("INSERT INTO load_items_temp(product_id, quantity, product_name) VALUES (?,?,?)", [productid, quantitiy,name]);

                LoadItems();
            });

        } else {
            alert("db not found, your browser does not support web sql!");
        }



        return false; 


    }
    function del(id){

        if (mydb) {
            //Get all the cars from the database with a select statement, set outputCarList as the callback function for the executeSql command
            mydb.transaction(function (t) {
                t.executeSql("DELETE FROM load_items_temp WHERE id=?", [id]);
                LoadItems();

            });
        } else {
            alert("db not found, your browser does not support web sql!");
        }
    }

    function saveall(){

        if (mydb) {
            //Get all the cars from the database with a select statement, set outputCarList as the callback function for the executeSql command
            mydb.transaction(function (t) {
                t.executeSql("SELECT * FROM load_items_temp", [], function(transaction, result){

                    if (result.rows.length == 0) {
                        alert("No items loaded!");
                    }else{




                        var dataSet = [];

                        for ( var i = 0; i < result.rows.length; i++) {
                            var row = result.rows.item(i);
                            dataSet.push(row);
                        }

                        var route  = $('#route').val();
                        var vid   = $('#vid').val();
                        $.ajax({
                            type: "get",
                            url: 'insert_load',
                            data: {
                                data: dataSet,
                                vid : vid,
                                route : route
                            
                            },

                            success : function(data){

                               location.href="load";


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



    }
</script>
@endsection