@extends('master')





@section('heading')

Stock History


@endsection
@section('breadcrumb')


<li>
    <a href="#">Stocks</a>
</li>
<li class="active">
    <strong>Stock History</strong>
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

                            <th>GRN Code</th>
                            <th> Recieved Date</th>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding:2%">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Stock Information</h4>

            </div>

            <div class="ibox-content">


                <table class="table table-striped table-bordered table-hover dataTables-example" id="dd1" plugin="datatable" >
                    <thead>
                        <tr>
                         

                            <th>Product Name</th>
                            <th> Initial Qty</th>
                            <th> Available Qty</th>
                            <th> Expiry Date</th>

                            <th> Status</th>
                            <th> Remarks</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="button_edit">Save changes</button>
            </div>
        </div>


    </div>
</div>

@endsection



@section('js')


<script>


    $('document').ready(function(){

        $('#sto').click();
        document.getElementById("log").setAttribute('class','active');
        dataLoad();



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
            "ajax": "get-stock-history",
            "columns": [
                { "data": "id" },
                { "data": "stock_code" },

                { "data": "recieved_date" },
                { "data": "remarks" },
                {"data" : null,
                 "mRender": function(data, type, full) {

                     return '<button class ="btn btn-primary btn-block btn-sm" onclick="view('+data.id+')"> View  </button>';

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

    function view(id){
        $('#stockview').modal('show');

        var oTable = $('#dd1').DataTable();
        oTable.destroy();

        $('#dd1').DataTable( {
            "ajax": "get-stock-info?id="+id,
            "columns": [
                
                { "data": "pro_name" },

                { "data": "initial" },
                { "data": "available" },
                { "data": "expiry_date" },
                {"data" : null,
                 "mRender": function(data, type, full) {

                     if(data.status == 'ACTIVE'){

                         return '<span class="label label-primary">'+data.status+'</span>';
                     }else{

                         return '<span class="label label-danger">'+data.status+'</span>';
                     }

                 }
                },
                { "data": "remarks" }


            ]
        } );



    }

</script>
@endsection