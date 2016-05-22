@extends('master')





@section('heading')

Good Recieve Note


@endsection
@section('breadcrumb')


<li>
    <a href="#">Stocks</a>
</li>
<li class="active">
    <strong>Good Recieve Note</strong>
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
                <legend> Main Info</legend>
                <form class="form-horizontal" id="stockMain" onsubmit="return insertSM()">



                    <div class="form-group">

                        <label class="col-lg-2 control-label">Vendor </label>

                        <div class="col-lg-6">

                            <select class="  chosen-select" style="width:350px;" tabindex="4" id="vendor" name="vendor">

                                @foreach($vendors as $v)

                                <option value="{{$v->id}}">{{$v->vendor_name}} </option>

                                @endforeach

                            </select>

                        </div>
                    </div>


                    <div class="form-group">

                        <label class="col-lg-2 control-label">GRN Code</label>

                        <div class="col-lg-4"><input   class="form-control" type="text" required id="grncode" name="grncode">

                        </div> 

                        <label class="col-lg-2 control-label">Recieve Date</label>

                        <div class="col-lg-4"><input   class="form-control" type="text" required id="rdate" name="rdate" value="{{date('Y-m-d')}}">


                        </div> 
                    </div>




                    <div class="form-group">
                        <label class="col-lg-2 control-label">Remarks</label>

                        <div class="col-lg-6"><textarea placeholder="Any special Comments?" class="form-control" type="text" required id="remarks" name="remarks"> </textarea>
                        </div>

                        <div class="col-lg-offset-2 col-lg-2">

                            <br>
                            <button class="btn btn-primary btn-block">Save</button>
                        </div>
                    </div>







                </form>




            </div>
        </div>

        <div class="ibox float-e-margins">

            <div class="ibox-content">
                <legend> Stock Info </legend>
                <form class="form-horizontal" id="stock1" onsubmit="return insertS()">



                    <div class="form-group">

                        <label class="col-lg-2 control-label"> Product </label>

                        <div class="col-lg-6">

                            <select class="  chosen-select" style="width:350px;" tabindex="4" id="product" name="product">

                                @foreach($products as $p)

                                <option value="{{$p->id}}">{{$p->product_name}}-{{$p->sub_name}} </option>

                                @endforeach

                            </select>

                        </div>

                        <label class="col-lg-2 control-label">Total Qty.</label>

                        <div class="col-lg-2"><input   class="form-control" type="number" required id="tqty" name="tqty" onkeyup="enterQty(this.value)">

                        </div>
                    </div>
                    <input type="text" id="sid" name="sid" hidden="true">
                    <div class="form-group">

                        <label class="col-lg-2 control-label">Recieved</label>

                        <div class="col-lg-2"><input  onkeyup="recieved(this.value)"  class="form-control" type="number" required id="qty" name="qty">

                        </div>

                        <label class="col-lg-2 control-label">Pending</label>

                        <div class="col-lg-2">
                            <input   class="form-control" type="number"   readonly required id="pqty" name="pqty">

                        </div>

                        <label class="col-lg-2 control-label">Expiry Date</label>

                        <div class="col-lg-2"><input   class="form-control" type="text" required id="exp" name="exp" >


                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-2 control-label">Remarks</label>

                        <div class="col-lg-6"><textarea placeholder="Any special Comments?" class="form-control" type="text" required id="remarks" name="remarks"> </textarea>
                        </div>

                        <div class="col-lg-offset-2 col-lg-2">

                            <br>
                            <button class="btn btn-primary btn-block">Save</button>
                        </div>
                    </div>








                </form>




            </div>
        </div>



        <div class="ibox float-e-margins">

            <div class="ibox-content">
                <legend>Stock List</legend>
                <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>Product</th>
                            <th>Total</th>
                            <th>Recieved</th>
                            <th>Pending</th>
                            <th>Expiry Date</th>
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

        <div class="col-lg-offset-10 col-lg-2">


            <a href="grn" class="btn btn-primary btn-block" id="dne" disabled>Done</a>
        </div>


    </div>
</div>

@endsection



@section('js')


<script>


    $('document').ready(function(){

        $('#sto').click();
        document.getElementById("grn").setAttribute('class','active');



        $('#stock1').find('input, textarea, button, select').attr('disabled','disabled');



        $('#product').chosen({

            width:"100%"

        });
        
          $('#vendor').chosen({

            width:"100%"

        });

        $('#rdate').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format:"yyyy-mm-dd"
        });


        $('#exp').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format:"yyyy-mm-dd"
        });

    });



    function enterQty(a){

        $('#qty').val(a);
        $('#pqty').val('0');


    }
    function recieved(a){

        var tot = $('#tqty').val();

        if(tot - a >= 0){

            $('#pqty').val((tot-a));

        }else{

            $('#qty').val(tot);
            $('#pqty').val('0');

        }

    }
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

        var sid = $('#sid').val();

        $('#dd').DataTable( {
            "ajax": "get-grn?id="+sid,
            "columns": [
                { "data": "id" },
                { "data": "pro_name" },
                { "data": "initial" },
                { "data": "recieved" },
                { "data": "pending" },
                { "data": "expiry_date" },
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


    function enableStocks(){


        $('#stockMain').find('input, textarea, button, select').attr('disabled','disabled');
        $('#stock1').find('input, textarea, button, select').removeAttr('disabled','disabled');

        $('#product').prop('disabled', false).trigger("chosen:updated");

        $('#dne').removeAttr('disabled','disabled');

    }

    function insertSM(){


        $.ajax({
            type: "get",
            url: 'insert-stock_main',
            data: $('#stockMain').serialize(),

            success : function(data){


                $('#sid').val(data);
                enableStocks();

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        });



        return false; 


    }


    function insertS(){


        $.ajax({
            type: "get",
            url: 'insert-stock',
            data: $('#stock1').serialize(),

            success : function(data){

                $('#dne').removeAttr('disabled','disabled');

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
            url: 'del_grns',
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