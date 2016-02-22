@extends('master')





@section('heading')

Load Vehicle


@endsection
@section('breadcrumb')


<li>
    <a href="#">Loading/Unloading</a>
</li>
<li class="active">
    <strong>Load Vehicle</strong>
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

                <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                    <thead>
                        <tr>

                            <th>#</th>
                            <th>Model</th>
                            <th>Vehicle Number</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Remarks</th>
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

<div class="modal inmodal fade" id="add-load" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header" style="padding:2%">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               <h3> LOAD VEHICLE |
                        <span class="label label-success" id="model"> sd</span>
                        <span class="label label-primary" id="vnum"> asd</span>
                        <span class="label label-warning" id="vtype">Lorry</span> </h3>
            </div>
            <form class="form-horizontal" id="addR" onsubmit="return insert()">
                <div class="modal-body">


                      
                    
                    <div class="form-group">

                        <label class="col-lg-2 control-label"> Select Route</label>

                        <div class="col-lg-8"><input placeholder="Vehicle Model" class="form-control" type="text" required id="models" name="model" readonly>
                        </div>
                        <div class="col-lg-2"> 
                        
                        <button class="btn btn-block btn-primary"> Save</button>
                        </div>
                    </div>

 



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" disabled>Save changes</button>
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
        $('#loa').click();
        document.getElementById("load").setAttribute('class','active');
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
            "ajax": "getActive-vehicles",
            "columns": [
                { "data": "id" },
                { "data": "vehicle_model" },
                { "data": "vehicle_number" },
                { "data": "vehicle_type" },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<span class="label label-primary">'+data.status+' </span>';
                 }
                },
                { "data": "remarks" },
                {"data" : null,
                 "mRender": function(data, type, full) {

                     
                     return '<a class="btn btn-success  btn-animate btn-animate-side btn-block btn-sm" href="load-view?id='+data.id+'"> Load </a>' ;
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