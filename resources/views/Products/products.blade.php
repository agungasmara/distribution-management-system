@extends('master')





@section('heading')

Products


@endsection
@section('breadcrumb')


<li>
    <a href="#">Products</a>
</li>
<li class="active">
    <strong>Categories/Products</strong>
</li>


@endsection


@section('headerbuttons')

<button class="btn btn-primary btn-rounded  " type="button" data-toggle="modal" data-target="#add-product"><i class="fa fa-plus"></i>
    ADD PRODUCT      </button> <b></b>

@endsection






@section('content')

<br>
<div class="row" style="padding:0cm">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">

            <div class="ibox-content">

                <div class="panel blank-panel">

                    <div class="panel-heading">

                        <div class="panel-options">

                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">Main Products</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">Sub Products</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                                    <thead>
                                        <tr>
                                            <th>#</th>


                                            <th>Product</th>
                                            <th>Brand</th>
                                            <th>Category</th>
                                            <th>Sub Products</th>
                                            <th>Remarks</th>
                                            <th class="col-md-1"></th>
                                            <th class="col-md-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>
                            </div>

                            <div id="tab-2" class="tab-pane">

                                <table class="table table-striped table-bordered table-hover dataTables-example" id="dd1" plugin="datatable" >
                                    <thead>
                                        <tr>
                                            <th>#</th>

                                            <th>Product Name</th>
                                            <th>Sub Product</th>
                                            <th>Buying Price</th>
                                            <th>Selling Price</th>
                                            <th>Remarks</th>
                                            <th class="col-md-1"></th>
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


            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="add-product" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">



                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>



                <h4 class="modal-title">Add A Product</h4>

            </div>




            <div class="modal-body">

                <div class="row">


                    <div class="col-md-6">  
                        <form class="form-horizontal" id="addP" onsubmit="return insertProduct()">

                            <div class="form-group">

                                <label class="col-lg-3 control-label"> Product</label>

                                <div class="col-lg-9"><input placeholder="Product Name" class="form-control" type="text" required id="pname" name="pname">
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="col-lg-3 control-label">Brand</label>

                                <div class="col-lg-9">
                                    <select class="form-control" id="pbrand" name="pbrand">

                                        <option value="0">None</option>
                                        @foreach($brand as $b)

                                        <option value="{{$b->id}}"> {{$b->brand_name}} </option>

                                        @endforeach

                                    </select>

                                </div>               
                            </div>


                            <div class="form-group">

                                <label class="col-lg-3 control-label">Category</label>

                                <div class="col-lg-9">
                                    <select class="form-control" id="pcat" name="pcat">

                                        <option value="0">None</option>
                                        @foreach($cat as $c)

                                        <option value="{{$c->id}}"> {{$c->cat_name}} </option>

                                        @endforeach

                                    </select>

                                </div>               
                            </div>



                            <div class="form-group">
                                <label class="col-lg-3 control-label">Remarks</label>

                                <div class="col-lg-9"><textarea placeholder="Any special Comments?" class="form-control" type="text" required id="premarks" name="premarks"></textarea>
                                </div>
                            </div>

                            <div class="form-group" id="btnid">
                                <div class="col-md-offset-8 col-md-4">

                                    <button type="submit" class="btn btn-block btn-success">Save</button>

                                </div>
                            </div>


                        </form>    

                    </div> 


                    <div class="col-md-6"> 


                        <form class="form-horizontal" id="addSP" onsubmit="return insertSP()">

                            <div class="form-group">

                                <label class="col-lg-3 control-label"> Sub Name</label>

                                <div class="col-lg-9"><input placeholder="eg: Packet 400g" class="form-control" type="text" required id="sname" name="sname" disabled>
                                </div>
                            </div>




                            <input type="text" hidden="true" id="pid" name="pid">
                            
                            
                               <div class="form-group">
                                <label class="col-lg-3 control-label">Buying Price</label>

                                <div class="col-lg-9"><input  placeholder="Buying Unit Price" class="form-control" type="text" required id="sbprice" name="sbprice" disabled> 
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Selling Price</label>

                                <div class="col-lg-9"><input  placeholder="Selling Unit Price" class="form-control" type="text" required id="sprice" name="sprice" disabled> 
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Remarks</label>

                                <div class="col-lg-9"><textarea placeholder="Any special Comments?" class="form-control" type="text" required id="sremarks" name="sremarks" disabled></textarea>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-offset-8 col-md-4">

                                    <button type="submit" id="spbutton" class="btn btn-block btn-primary" disabled>Save</button>

                                </div>
                            </div>
                        </form>    
                    </div>


                </div> 
                <hr style="margin-top:0cm">
                <div class="row" id="sptable" hidden="true">


                    <table class="table table-striped table-bordered table-hover dataTables-example" id="dd3" plugin="datatable" >
                        <thead>
                            <tr>
                                <th>#</th>

                                <th>Sub Product Name</th>
                                 <th>Buying Price (Rs.)</th>
                                <th>Selling Price (Rs.)</th>

                                <th>Remarks</th>

                                <th class="col-md-1"></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>


                </div>


            </div>



            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>


    </div>
</div>



<div class="modal inmodal fade" id="edit-routes" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Edit Vehicle #<b id="route_id"></b></h4>

            </div>
            <form class="form-horizontal" id="addRE" onsubmit="return update()">
                <div class="modal-body">


                    <div class="form-group">

                        <label class="col-lg-3 control-label"> Model</label>

                        <div class="col-lg-9"><input placeholder="Vehicle Model" class="form-control" type="text" required id="modelE" name="model">
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-3 control-label">Vehicle Number</label>

                        <div class="col-lg-9"><input placeholder="Vehicle Number" class="form-control" type="text" required id="vehi_numE" name="vehi_num">

                        </div>               
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Type</label>

                        <div class="col-lg-9">
                            <select class="form-control" id="typeE" name="type">
                                <option value="Lorry">Lorry</option>
                                <option value="Van">Van</option>
                                <option value="Car">Car</option>
                                <option value="3-Wheel">3-Wheel</option> 
                                <option value="Bike">Bike</option>    

                            </select>
                        </div>
                    </div>

                    <input  type="text" id="idE" name="id" hidden="true">

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Remarks</label>

                        <div class="col-lg-9"><textarea placeholder="Any special Comments?" class="form-control" type="text" required id="remarksE" name="remarks"> </textarea>
                        </div>
                    </div>



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="button_edit">Save changes</button>
                </div>
                </div>

            </form>
    </div>
</div>



@endsection



@section('js')


<script>


    $('document').ready(function(){

        $('#pro').click();
        document.getElementById("prod").setAttribute('class','active');
        dataLoad();


    });


    function edit(id){

        document.getElementById("route_id").innerHTML = id;
        $.ajax({
            type: "get",
            url: 'get_category_info',
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
            url: 'edit_category',
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

    function dataLoad(){

        var oTable = $('#dd').DataTable();
        oTable.destroy();

        $('#dd').DataTable( {
            "ajax": "get-products",
            "columns": [
                { "data": "id" },
                { "data": "product_name" },
                { "data": "brand_name" },
                { "data": "cat_name" },
                { "data": "subcount" },
                { "data": "remarks" },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-info  btn-animate btn-animate-side btn-block btn-sm" onclick="edit('+data.id+')"> Edit </button>' ;
                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     
                     if(data.subcount > 0){
                             return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="delP('+data.id+')" disabled> Delete </button>' ; 
                         
                     }else{
                     
                     return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="delP('+data.id+')" > Delete </button>' ;
                 }
                 }
                }
            ]
        } );



        var oTable1 = $('#dd1').DataTable();
        oTable1.destroy();

        $('#dd1').DataTable( {
            "ajax": "get-subproducts",
            "columns": [
                { "data": "id" },
                { "data": "product_name" },
                { "data": "sub_name" },
                { "data": "buying_price" },
                { "data": "price" },
                { "data": "remarks" },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-info  btn-animate btn-animate-side btn-block btn-sm" onclick="edit('+data.id+')"> Edit </button>' ;
                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="delSP('+data.id+')"> Delete </button>' ;
                 }
                }
            ]
        } );




    }


    function enableSP(){


        $('#addP').find('input, textarea, button, select').attr('disabled','disabled');
        $('#addSP').find('input, textarea, button, select').removeAttr('disabled','disabled');
        $('#btnid').hide();
        $('#sptable').show();

    }

    function insertProduct(){


        $.ajax({
            type: "get",
            url: 'insert-product',
            data: $('#addP').serialize(),

            success : function(data){
                //$('#add-brands').modal('hide');
                dataLoad();
                console.log(data);
                document.getElementById("pid").value = data;
                enableSP();
                dataloadP(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        });



        return false; 


    }
    function insertSP(){


        $.ajax({
            type: "get",
            url: 'insert-sproduct',
            data: $('#addSP').serialize(),

            success : function(data){
                // $('#add-cat').modal('hide');

                dataLoad();

                var id =  document.getElementById("pid").value;
                dataloadP(id);
                $('#addSP').find("input[type=text], textarea").val("");
                                
                document.getElementById("pid").value = id;
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        });



        return false; 


    }



    function dataloadP(id){


        var oTable = $('#dd3').DataTable();
        oTable.destroy();


        $('#dd3').DataTable( {
            "ajax": "get-subproduct?id="+id,
            "columns": [
                { "data": "id" },
                { "data": "sub_name" },
                { "data": "buying_price" },
                { "data": "price" },
                { "data": "remarks" },

                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="delSP('+data.id+')"> Delete </button>' ;
                 }
                }
            ]
        } );



    }
    function delSP(id){

        $.ajax({
            type: "get",
            url: 'del_sp',
            data: {id : id},

            success : function(data){

                var id1 =  document.getElementById("pid").value;
                dataloadP(id1);
                dataLoad();



            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        }); 
    }



    function delP(id){

        $.ajax({
            type: "get",
            url: 'del_product',
            data: {id : id},

            success : function(data){

                console.log(data);
                dataLoad();


            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        }); 
    }


</script>
@endsection