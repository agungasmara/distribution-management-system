@extends('master')





@section('heading')

Customer Management


@endsection
@section('breadcrumb')


<li>
    <a href="#">Management</a>
</li>
<li class="active">
    <strong>Customers</strong>
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
                            <th>NIC</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>City</th>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add A Customer</h4>

            </div>
            <form class="form-horizontal" id="addR" onsubmit="return insert()">
                <div class="modal-body">


                    <div class="form-group">

                        <label class="col-lg-2 control-label"> Name</label>

                        <div class="col-lg-5"><input placeholder="Customer Name" class="form-control" type="text" required id="name" name="name">
                        </div>
                        
                        <label class="col-lg-1 control-label"> NIC</label>

                        <div class="col-lg-4"><input placeholder="NIC Number" class="form-control" type="text" required id="nic" name="nic">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label class="col-lg-2 control-label">Address Line 1</label>

                        <div class="col-lg-10"><input placeholder="Customer Address Line 1..." class="form-control" type="text" required id="add1" name="add1">
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-2 control-label">Address Line 2</label>

                        <div class="col-lg-4"><input placeholder="Customer Address Line 2... " class="form-control" type="text" required id="add2" name="add2">

                        </div> 
                           <label class="col-lg-2 control-label">Address Line 3</label>

                        <div class="col-lg-4"><input placeholder="Customer Address Line 3... " class="form-control" type="text" required id="add3" name="add3">

                        </div> 
                    </div>
                   
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Phone</label>

                        <div class="col-lg-4"><input placeholder="Phone Number" class="form-control" type="text" required id="phone" name="phone">
                        </div>
                        
                          <label class="col-lg-2 control-label">Home</label>

                        <div class="col-lg-4"><input placeholder="Home Number" class="form-control" type="text" required id="home" name="home">
                        </div>
                    </div>
                    
                      <div class="form-group">
                        <label class="col-lg-2 control-label">Email</label>

                        <div class="col-lg-10"><input placeholder="someone@someplace.com" class="form-control" type="text" required id="email" name="email">
                        </div>
                    </div>


                    

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Remarks</label>

                        <div class="col-lg-10"><textarea placeholder="Any special Comments?" class="form-control" type="text" required id="remarks" name="remarks"> </textarea>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Edit Customer #<b id="route_id"></b></h4>

            </div>
            <form class="form-horizontal" id="addRE" onsubmit="return update()">
                 <div class="modal-body">


                    <div class="form-group">

                        <label class="col-lg-2 control-label"> Name</label>

                        <div class="col-lg-5"><input placeholder="Customer Name" class="form-control" type="text" required id="nameE" name="name">
                        </div>
                        
                        <label class="col-lg-1 control-label"> NIC</label>

                        <div class="col-lg-4"><input placeholder="NIC Number" class="form-control" type="text" required id="nicE" name="nic">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label class="col-lg-2 control-label">Address Line 1</label>

                        <div class="col-lg-10"><input placeholder="Customer Address Line 1..." class="form-control" type="text" required id="add1E" name="add1">
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-2 control-label">Address Line 2</label>

                        <div class="col-lg-4"><input placeholder="Customer Address Line 2... " class="form-control" type="text" required id="add2E" name="add2">

                        </div> 
                           <label class="col-lg-2 control-label">Address Line 3</label>

                        <div class="col-lg-4"><input placeholder="Customer Address Line 3... " class="form-control" type="text" required id="add3E" name="add3">

                        </div> 
                    </div>
                   
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Phone</label>

                        <div class="col-lg-4"><input placeholder="Phone Number" class="form-control" type="text" required id="phoneE" name="phone">
                        </div>
                        
                          <label class="col-lg-2 control-label">Home</label>

                        <div class="col-lg-4"><input placeholder="Home Number" class="form-control" type="text" required id="homeE" name="home">
                        </div>
                    </div>
                    
                      <div class="form-group">
                        <label class="col-lg-2 control-label">Email</label>

                        <div class="col-lg-10"><input placeholder="someone@someplace.com" class="form-control" type="text" required id="emailE" name="email">
                        </div>
                    </div>

<input id="idE" name="id" hidden="true">
                    

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Remarks</label>

                        <div class="col-lg-10"><textarea placeholder="Any special Comments?" class="form-control" type="text" required id="remarksE" name="remarks"> </textarea>
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

        $('#man').click();
        document.getElementById("cus").setAttribute('class','active');
        dataLoad();


    });


     function edit(id){
        
         document.getElementById("route_id").innerHTML = id;
         $.ajax({
            type: "get",
            url: 'get_customer_info',
            data: {id : id},

            success : function(data){
                
                    console.log(data);
                    document.getElementById("nameE").value =  data.cus_name;
                    document.getElementById("nicE").value =  data.nic;
                    document.getElementById("phoneE").value =  data.phone;
                    document.getElementById("homeE").value =  data.home;
                    document.getElementById("add1E").value =  data.address1;
                    document.getElementById("add2E").value =  data.address2;
                    document.getElementById("add3E").value =  data.address3;
                    document.getElementById("emailE").value =  data.email;
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
            url: 'edit_customer',
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
            "ajax": "get-customer",
            "columns": [
                { "data": "id" },
                { "data": "cus_name" },
                { "data": "nic" },
                { "data": "phone" },
                { "data": "email" },
                { "data": "address3" },
                { "data": "remarks" },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-info  btn-animate btn-animate-side btn-block btn-sm" onclick="edit('+data.id+')"> View </button>' ;
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
            url: 'insert-customer',
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
            url: 'del_customer',
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