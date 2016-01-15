@extends('master')





@section('heading')

Route Management


@endsection
@section('breadcrumb')


<li>
    <a href="#">Management</a>
</li>
<li class="active">
    <strong>Routes</strong>
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
                            <th>Name</th>
                            <th>Start Point</th>
                            <th>End Point</th>
                            <th>Representative</th>
                            <th>Remarks</th>
                            <th class="col-md-1"></th>
                            <th class="col-md-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($routes as $r)

                        <tr>
                            <td> {{$r->id}}</td>
                            <td> {{$r->route_name}}</td>
                            <td> {{$r->start}}</td>
                            <td> {{$r->end}}</td>

                            <td> 

                                @if( $r->rep_name != '0')
                                {{$r->rep_name}}
                                @else
                                <i>Not Assigned Yet.</i>
                                @endif
                            </td>
                            <td> {{$r->remarks}}</td>
                            <td> <button class="btn btn-info btn-block btn-sm">Edit</button></td>
                            <td> <button class="btn btn-danger btn-block btn-sm">Delete</button></td>
                        </tr>

                        @endforeach
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
                <h4 class="modal-title">Add A Route</h4>

            </div>
            <form class="form-horizontal" id="addR" onsubmit="return insert()">
                <div class="modal-body">


                    <div class="form-group">

                        <label class="col-lg-3 control-label">Route Name</label>

                        <div class="col-lg-9"><input placeholder="Route Name" class="form-control" type="text" required id="name" name="name">
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-3 control-label">Start Point</label>

                        <div class="col-lg-9"><input placeholder="Where the route begins" class="form-control" type="text" required id="start" name="start">

                        </div>               
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">End Point</label>

                        <div class="col-lg-9"><input placeholder="Where the route ends" class="form-control" type="text" required id="end" name="end">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Representative</label>

                        <div class="col-lg-9"> <select class="form-control" id="rep" name="rep">
                            <option value="0">Add Later</option>

                            @foreach ($reps as $r)
                            <option value="{{$r->id}}"> {{$r->rep_name}}</option>

                            @endforeach

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
                <h4 class="modal-title">Edit Route #<b id="route_id"></b></h4>

            </div>
            <form class="form-horizontal" id="addRE" onsubmit="return update()">
                <div class="modal-body">


                    <div class="form-group">

                        <label class="col-lg-3 control-label">Route Name</label>

                        <div class="col-lg-9"><input placeholder="Route Name" class="form-control" type="text" required id="nameE" name="name">
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-3 control-label">Start Point</label>

                        <div class="col-lg-9"><input placeholder="Where the route begins" class="form-control" type="text" required id="startE" name="start">

                        </div>               
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">End Point</label>

                        <div class="col-lg-9"><input placeholder="Where the route ends" class="form-control" type="text" required id="endE" name="end">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Representative</label>

                        <div class="col-lg-9"> <select class="form-control" id="repE" name="rep">
                            <option value="0">Add Later</option>

                            @foreach ($reps as $r)
                            <option value="{{$r->id}}"> {{$r->rep_name}}</option>

                            @endforeach

                            </select>
                        </div>
                    </div>
                    <input type="text" hidden="true" name="id" id="idE">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Remarks</label>

                        <div class="col-lg-9"><textarea placeholder="Any special Comments?" class="form-control" type="text" required id="remarksE" name="remarks"> </textarea>
                        </div>
                    </div>



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="button_edit">Save changes</button>
                </div>
                </div>

            </form>
    </div>
</div>

@endsection



@section('js')


<script>


    $('document').ready(function(){


        dataLoad();


    });


     function edit(id){
        
         $.ajax({
            type: "get",
            url: 'get_route_info',
            data: {id : id},

            success : function(data){
                
                    console.log(data);
                    document.getElementById("nameE").value =  data.route_name;
                    document.getElementById("startE").value =  data.start;
                    document.getElementById("endE").value =  data.end;
                    document.getElementById("repE").value =  data.rep_id;
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
            url: 'edit_routes',
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
            "ajax": "get-routes",
            "columns": [
                { "data": "id" },
                { "data": "route_name" },
                { "data": "start" },
                { "data": "end" },
                 {"data" : null,
                 "mRender": function(data, type, full) {
                     
                     if(data.rep_name == '0'){
                        
                         return "<span class='label label-warning'> Not Assigned </span>";
                         
                     }else{
                         
                         return data.rep_name;
                         
                     }
                     
                 }
                },
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
            url: 'insert-routes',
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

</script>
@endsection