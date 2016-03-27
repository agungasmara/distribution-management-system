@extends('master')





@section('heading')

Pending Stocks


@endsection
@section('breadcrumb')


<li>
    <a href="#">Stocks</a>
</li>
<li class="active">
    <strong>Pending Stocks</strong>
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
                               <th>GRN</th>
                            <th>Product </th>
                            <th> Total </th>
                            <th> Recieved</th>
                            <th> Pending </th>
                            <th> Available</th>
                            <th> Expiry Date</th>
                            <th> Remarks</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>




<div class="modal inmodal fade" id="stockview" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <div class="modal-header" style="padding:2%">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h5 class="modal-title">Update Stock</h5>

            </div>

            <form class="form-horizontal" onsubmit="return savePending()" id="s1">
            <div class="ibox-content">
                
                <div class="form-group">
                
                <input type="hidden" id="stock_id" name="stock_id">
                    
                 <label class="col-lg-4 control-label">Recieve Date</label>

                        <div class="col-lg-8"><input   class="form-control" type="text" required id="rdate" name="rdate" value="{{date('Y-m-d')}}" >


                        </div> 
                </div>
                    
  <div class="form-group">
                
                <input type="hidden" id="stock_id">
                    
                 <label class="col-lg-4 control-label">Quantity</label>

                        <div class="col-lg-8">
                            
                            <input   min="1" class="form-control" type="number" required id="qty" name="qty"  >


                        </div> 
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" onclick="savePending()" class="btn btn-primary"   >Save changes</button>
            </div>
            </form>
            
        </div>


    </div>
</div>

@endsection



@section('js')


<script>


    $('document').ready(function(){

        $('#sto').click();
        document.getElementById("pstocks").setAttribute('class','active');
        dataLoad();

 $('#rdate').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
             format:"yyyy-mm-dd"
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
            "ajax": "get-pending-list",
            "columns": [
           
                { "data": "grn" },
                { "data": "product_name" },
                { "data": "initial" },
                { "data": "recieved" },
                { "data": "pending" },
                { "data": "available" },
                { "data": "expiry_date" },
                { "data": "remarks" },
                {"data" : null,
                 "mRender": function(data, type, full) {

                     return '<button class ="btn btn-info btn-block btn-sm" onclick="view('+data.id+','+data.pending+')"> Add </button>';

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

    function view(id,pending){
         $('#stock_id').val(id);
        
        $('#qty').attr('max',pending);
        
        $('#qty').val(pending);
        $('#stockview').modal('show');

     



    }
    
    function savePending(){
        
        
        $.ajax({
            
            url:"save-pending",
            type:"get",
            data:$('#s1').serialize(),
            success:function(data){
               
                 $('#stockview').modal('hide');
                dataLoad();
                console.log("success");
                
            },
            error:function(err){
                
                
                console.log(err);
            }
            
        });
        
        return false;
    }

</script>
@endsection