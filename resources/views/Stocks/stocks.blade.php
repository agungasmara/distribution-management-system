@extends('master')





@section('heading')

Stocks


@endsection
@section('breadcrumb')


<li>
    <a href="#">Stocks</a>
</li>
<li class="active">
    <strong>Active Stocks</strong>
</li>


@endsection


@section('headerbuttons')<!--
<button class="btn btn-primary btn-rounded  " type="button" data-toggle="modal" data-target="#add-routes"><i class="fa fa-plus"></i>
    ADD NEW         </button> <b></b> -->
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

                            <th>Product Name</th>
                          <th> Available Quantity</th>
                              <th> Status</th>
                             
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
                <h4 class="modal-title">Add Stock </h4>

            </div>
            <form class="form-horizontal" id="addR" onsubmit="return insert()">
                <div class="modal-body">


                    <div class="form-group">

                        <label class="col-lg-2 control-label"> Product </label>

                        <div class="col-lg-10">

                            <select class="  chosen-select" style="width:350px;" tabindex="4" id="product" name="product">

                                @foreach($products as $p)

                                <option value="{{$p->id}}">{{$p->product_name}}-{{$p->sub_name}} </option>

                                @endforeach

                            </select>

                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-2 control-label">Stock Code</label>

                        <div class="col-lg-10"><input   class="form-control" type="text" required id="code" name="code">

                        </div>               
                    </div>

                    <div class="form-group">

                        <label class="col-lg-2 control-label">Quantitiy</label>

                        <div class="col-lg-4"><input   class="form-control" type="number" required id="qty" name="qty">


                        </div>

                        <label class="col-lg-2 control-label">Expiry Date</label>

                        <div class="col-lg-4"><input   class="form-control" type="text" required id="exp" name="exp">


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
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Edit Representative #<b id="route_id"></b></h4>

            </div>
            <form class="form-horizontal" id="addRE" onsubmit="return update()">
                <div class="modal-body">


                    <div class="form-group">

                        <label class="col-lg-3 control-label">Name</label>

                        <div class="col-lg-9"><input placeholder="Representative Name" class="form-control" type="text" required id="nameE" name="name">
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-3 control-label">NIC</label>

                        <div class="col-lg-9"><input placeholder="123456789V" class="form-control" type="text" required id="nicE" name="nic">

                        </div>               
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Phone</label>

                        <div class="col-lg-9"><input placeholder="Phone Number" class="form-control" type="text" required id="phoneE" name="phone">
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

        $('#sto').click();
        document.getElementById("stocks").setAttribute('class','active');
        dataLoad();


        $('#product').chosen({

            width:"100%"

        });

        $('#exp').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

    });


    function edit(id){

        document.getElementById("route_id").innerHTML = id;
        $.ajax({
            type: "get",
            url: 'get_rep_info',
            data: {id : id},

            success : function(data){

                console.log(data);
                document.getElementById("nameE").value =  data.rep_name;
                document.getElementById("nicE").value =  data.nic;
                document.getElementById("phoneE").value =  data.phone;
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
            url: 'edit_reps',
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
            "ajax": "get-activestocks",
            "columns": [
                { "data": "id" },
                 {"data" : null,
                 "mRender": function(data, type, full) {
                     return data.product_name + ' - '+ data.sub_name;
                 }
                 },
                 { "data": "count1" },
                 {"data" : null,
                 "mRender": function(data, type, full) {
                    
                     if(data.count1 > 500){
                         
                         return '<span class="label label-primary"> VERY GOOD </span>';
                     }else  if(data.count1 > 100){
                         
                         return '<span class="label label-warning"> AVERAGE </span>';
                     }else{
                          return '<span class="label label-danger"> LOW </span>';
                         
                     }
                     
                 }
                }
              
            ]
        } );


    }

    function insert(){


        $.ajax({
            type: "get",
            url: 'insert-stock',
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
            url: 'del_reps',
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