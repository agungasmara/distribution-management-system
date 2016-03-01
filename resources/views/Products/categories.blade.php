@extends('master')





@section('heading')

Categories / Brands


@endsection
@section('breadcrumb')


<li>
    <a href="#">Products</a>
</li>
<li class="active">
    <strong>Categories/Brands</strong>
</li>


@endsection


@section('headerbuttons')

<button class="btn btn-primary btn-rounded  " type="button" data-toggle="modal" data-target="#add-cat"><i class="fa fa-plus"></i>
    ADD CATEGORY       </button> <b></b>
<button class="btn btn-success btn-rounded  " type="button" data-toggle="modal" data-target="#add-brands"><i class="fa fa-plus"></i>
    ADD BRAND       </button> <b></b>
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
                                    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">Categories</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">Brands</a></li>
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
                            
                            
                            <th> Category Name</th>
                            <th>Count</th>
                            
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
                            
                            <th>Brand Name</th>
                            <th>Manufacturer</th>
                            <th>Count</th>
                            
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

<div class="modal inmodal fade" id="add-brands" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add A Brand</h4>

            </div>
            <form class="form-horizontal" id="addB" onsubmit="return insertBrand()">
                <div class="modal-body">


                    <div class="form-group">

                        <label class="col-lg-3 control-label"> Brand Name</label>

                        <div class="col-lg-9"><input placeholder="Brand Name" class="form-control" type="text" required id="bname" name="bname">
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-3 control-label">Manufacturer</label>

                        <div class="col-lg-9"><input placeholder="Manufacturer Name" class="form-control" type="text" required id="manu" name="manu">

                        </div>               
                    </div>
                   

                    

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Remarks</label>

                        <div class="col-lg-9"><textarea placeholder="Any special Comments?" class="form-control" type="text" required id="bremarks" name="remarks"></textarea>
                        </div>
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
<div class="modal inmodal fade" id="add-cat" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add A Category</h4>

            </div>
            <form class="form-horizontal" id="addC" onsubmit="return insertCat()">
                <div class="modal-body">


                    <div class="form-group">

                        <label class="col-lg-3 control-label"> Category Name</label>

                        <div class="col-lg-9"><input placeholder=" Category Name" class="form-control" type="text" required id="cname" name="cname">
                        </div>
                    </div>

                 

                    

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Remarks</label>

                        <div class="col-lg-9"><textarea placeholder="Any special Comments?" class="form-control" type="text" required id="cremarks" name="remarks"></textarea>
                        </div>
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
        document.getElementById("cat").setAttribute('class','active');
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
            "ajax": "get-category",
            "columns": [
                { "data": "id" },
                { "data": "cat_name" },
                { "data": "count1" },
                { "data": "remarks" },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-info  btn-animate btn-animate-side btn-block btn-sm" onclick="edit('+data.id+')"> Edit </button>' ;
                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="delC('+data.id+')"> Delete </button>' ;
                 }
                }
            ]
        } );


        
         var oTable1 = $('#dd1').DataTable();
        oTable1.destroy();

        $('#dd1').DataTable( {
            "ajax": "get-brand",
            "columns": [
                { "data": "id" },
                { "data": "brand_name" },
                { "data": "manufacturer" },
                { "data": "count1" },
                { "data": "remarks" },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-info  btn-animate btn-animate-side btn-block btn-sm" onclick="edit('+data.id+')"> Edit </button>' ;
                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="delB('+data.id+')"> Delete </button>' ;
                 }
                }
            ]
        } );


        
        
    }

    function insertBrand(){


        $.ajax({
            type: "get",
            url: 'insert-brand',
            data: $('#addB').serialize(),

            success : function(data){
                $('#add-brands').modal('hide');
                dataLoad();

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        });



        return false; 


    }
        function insertCat(){


        $.ajax({
            type: "get",
            url: 'insert-category',
            data: $('#addC').serialize(),

            success : function(data){
                $('#add-cat').modal('hide');
                
                dataLoad();

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        });



        return false; 


    }
    function delB(id){
        
             $.ajax({
            type: "get",
            url: 'del_brand',
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
        function delC(id){
        
             $.ajax({
            type: "get",
            url: 'del_category',
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