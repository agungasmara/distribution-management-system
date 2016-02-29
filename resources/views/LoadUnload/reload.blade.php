@extends('master')





@section('heading')


Reload Vehicle | <span class="label label-success">{{$vehicle->vehicle_model}}</span> <span class="label label-primary">{{$vehicle->vehicle_number}}</span> <span class="label label-info text-uppercase">{{$vehicle->vehicle_type}}</span> <span class="label label-danger text-uppercase"> Loaded Date : {{$loadMain->load_date}}</span>


@endsection
@section('breadcrumb')


<li>
    <a href="#">Loading/Unloading</a>
</li>

<li>
    <a href="active-vehicles">Reload Vehicles</a>
</li>

<li class="active">
    <strong>Unload Vehicle</strong>
</li>


@endsection


@section('headerbuttons') 

<button class="btn btn-primary btn-rounded  " type="button" data-toggle="modal" data-target="#add-routes"><i class="fa fa-plus"></i>
    ADD NEW         </button> 
@endsection






@section('content')

<br>
<form id="unloaded" onsubmit="return saveall()">


    <input type="hidden" value="{{$loadMain->id}}" name="loadMainId"  id="loadId">
    <input type="hidden" value="{{$vehicle->id}}" name="vehicleId">

    <div class="row" style="padding:0cm">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content">
                    <legend> Available in Vehicle</legend>
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="dd1" plugin="datatable" >
                        <thead>
                            <tr>

                                <th>#</th>

                                <th>Product Name</th>
                                <th>Quantity Loaded</th>
                                <th>Quantity Available</th>
                                <th>Reload Qunatity</th>


                            </tr>
                        </thead>
                        <tbody>

                            <?php $count = 0; ?>
                            @foreach($loadItems as $l)
                            <tr>
                                <td>{{$count + 1}}</td>
                                <td> {{ $l->pro_name }}</td>
                                <td> {{ $l->number }}</td>
                                <td> {{ $l->available_qty }}</td>
                                <td><input type="number"  placeholder="Reload Quantity" min = "0" max="{{$l->stock_count}}" class="form-control" name="reload{{$count}}" id="reload{{$count}}" value="0" required></td>


                                <input type="hidden" value="{{$l->stock_id}}" name="stock{{$count}}">
                                <input type="hidden" value="{{$l->id}}" name="loadItemId{{$count}}" id="loadItemId{{$count}}">
                            </tr>

                            <?php $count++; ?>

                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>


    <div class="row" style="padding:0cm">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content">
                    <legend> New Additions to the Vehicle  </legend>
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
    <input type="hidden" value="{{$count}}" id="countInfo" name="countInfo">

    <div class="col-md-offset-9 col-md-3">


        <button class="btn btn-primary btn-block"  type="submit"> Save</button>

    </div>
</form>


<div class="modal inmodal fade" id="add-routes" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add Products</h4>

            </div>
            <form class="form-horizontal" id="addPR" onsubmit="return insert()">
                <div class="modal-body">



                    <div class="form-group">

                        <label class=" col-md-1 control-label"> Product </label>

                        <div class="col-md-8" >

                            <select class="  chosen-select" style="width:350px;" tabindex="4" id="product" name="product" onchange="change(this)" required>


                                @foreach($products as $p)

                                <option value="{{$p->id}}" data-available="{{$p->available}}" data-name="{{$p->product_name}}-{{$p->sub_name}}"> {{$p->product_name}}-{{$p->sub_name}} ( <b> {{number_format($p->available)}} Stocks Available </b>)</option>


                                @endforeach

                            </select>



                        </div>

                        <div class="col-md-3">

                            <input name="quantity" id="quantity" type="number" placeholder="Qunatitiy" class="form-control" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>

            </form>
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

            t.executeSql("DROP TABLE IF  EXISTS reload_items_temp");

            t.executeSql("CREATE TABLE IF NOT EXISTS reload_items_temp (id INTEGER PRIMARY KEY ASC,  product_id INTEGER, quantity INTEGER , product_name TEXT)");
        });

    } else {
        alert("WebSQL is not supported by your browser!");
    }



    $('document').ready(function(){


        //document.getElementById("man").setAttribute('class','active');
        // document.getElementById("man").click();
        $('#loa').click();
        document.getElementById("act").setAttribute('class','active');

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


                     return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="del('+data.id+')" type="button" > Delete </button>';
                 }
                }
            ]
        } );  
    }

    function addLoad(id,model,type,number){

        $('#model').html(model);
        $('#vnum').html(number);
        $('#vtype').html(type);

        $('#add-load').modal('show');

    }






    function saveall(){

        if (mydb) {
            //Get all the cars from the database with a select statement, set outputCarList as the callback function for the executeSql command
            mydb.transaction(function (t) {
                t.executeSql("SELECT * FROM reload_items_temp", [], function(transaction, result){

                    if (result.rows.length == 0) {
                        alert("No items loaded!");
                    }else{




                        var dataSet = [];

                        for ( var i = 0; i < result.rows.length; i++) {
                            var row = result.rows.item(i);
                            dataSet.push(row);
                        }

                        var loadid = $('#loadId').val();
                        var count = $('#countInfo').val();



                        var updates = [];

                        for(var x = 0; x < count ; x++){

                            var  reload = $('#reload'+x).val();
                            var  loadItemId = $('#loadItemId'+x).val();

                            updates.push({
                                loadItemId:loadItemId,
                                qty: reload
                            });

                        }

                        console.log(updates);
                        console.log(dataSet);

                        $.ajax({
                            type: "get",
                            url: 'insert_reload',
                            data: {
                                data: dataSet,
                                load_id:loadid,
                                updates:updates

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

    function insert(){

        if (mydb) {
            //get the values of the make and model text inputs
            var productid = $('#product').val();
            var quantitiy =  $('#quantity').val();
            var name = $('#product').children('option:selected').data('name');
            console.log("started");
            //Insert the user entered details into the cars table, note the use of the ? placeholder, these will replaced by the data passed in as an array as the second parameter
            mydb.transaction(function (t) {
                t.executeSql("INSERT INTO reload_items_temp(product_id, quantity, product_name) VALUES (?,?,?)", [productid, quantitiy,name]);

                LoadItems();
                $('#add-routes').modal('hide');
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
                t.executeSql("SELECT * FROM reload_items_temp", [], dataLoad);
            });
        } else {
            alert("db not found, your browser does not support web sql!");
        }
    }

    function del(id){

        if (mydb) {
            //Get all the cars from the database with a select statement, set outputCarList as the callback function for the executeSql command
            mydb.transaction(function (t) {
                t.executeSql("DELETE FROM reload_items_temp WHERE id=?", [id]);
                LoadItems();

            });
        } else {
            alert("db not found, your browser does not support web sql!");
        }
    }
</script>
@endsection