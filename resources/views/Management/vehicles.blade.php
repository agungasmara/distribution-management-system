@extends('master')





@section('heading')

Vehicle Management


@endsection
@section('breadcrumb')


<li>
    <a href="#">Management</a>
</li>
<li class="active">
    <strong>Vehicles</strong>
</li>


@endsection


@section('headerbuttons')
<button class="btn btn-primary btn-rounded  " type="button" data-toggle="modal" data-target="#add-routes"><i class="fa fa-plus"></i>
    ADD NEW         </button> <b></b>
@endsection






@section('content')

<br>
<div class="row" style="padding:0cm">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">

            <div class="ibox-content">

                <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                    <thead>
                        <tr>
                            <th>#</th>
                            
                            <th>Model</th>
                            <th>Vehicle Number</th>
                            <th>Type</th>
                            
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

<div class="modal inmodal fade" id="add-routes" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add A Vehicle</h4>

            </div>
            <form class="form-horizontal" id="addR" onsubmit="return insert()">
                <div class="modal-body">


                    <div class="form-group">

                        <label class="col-lg-3 control-label"> Model</label>

                        <div class="col-lg-9"><input placeholder="Vehicle Model" class="form-control" type="text" required id="model" name="model">
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-3 control-label">Vehicle Number</label>

                        <div class="col-lg-9"><input placeholder="Vehicle Number" class="form-control" type="text" required id="vehi_num" name="vehi_num">

                        </div>               
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Type</label>

                        <div class="col-lg-9">
                            <select class="form-control" id="type" name="type">
                            <option value="Lorry">Lorry</option>
                            <option value="Van">Van</option>
                            <option value="Car">Car</option>
                            <option value="3-Wheel">3-Wheel</option> 
                            <option value="Bike">Bike</option>    
                            
                            </select>
                        </div>
                    </div>

                    

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Remarks</label>

                        <div class="col-lg-9"><textarea placeholder="Any special Comments?" class="form-control" type="text" required id="remarks" name="remarks"> </textarea>
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

        
        //document.getElementById("man").setAttribute('class','active');
       // document.getElementById("man").click();
        $('#man').click();
        document.getElementById("veh").setAttribute('class','active');
        dataLoad();


    });


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

    function dataLoad(){

        var oTable = $('#dd').DataTable();
        oTable.destroy();

        $('#dd').DataTable( {
            "ajax": "get-vehicles",
            "columns": [
                { "data": "id" },
                { "data": "vehicle_model" },
                { "data": "vehicle_number" },
                { "data": "vehicle_type" },
                { "data": "remarks" },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-info  btn-animate btn-animate-side btn-block btn-sm" onclick="edit('+data.id+')"> Edit </button>' ;
                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="del('+data.id+')"> Delete </button>' ;
                 }
                }
            ]
        } );


    }

    function insert(){


        $.ajax({
            type: "get",
            url: 'insert-vehicles',
            data: $('#addR').serialize(),

            success : function(data){
                $('#add-routes').modal('hide');
                dataLoad();

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        });



        return false; 


    }
    function del(id){
        
             $.ajax({
            type: "get",
            url: 'del_vehicles',
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