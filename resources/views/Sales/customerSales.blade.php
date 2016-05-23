@extends('master')





@section('heading')
Customer Sales


@endsection
@section('breadcrumb')


<li>
    <a href="#">Sales</a>
</li>

<li class="active">
    <strong>Customer Sales</strong>
</li>


@endsection


@section('headerbuttons') 




@endsection






@section('content')

<br>



<form class="form-horizontal" onsubmit="return save()"> 




    <div class="row" style="padding:0cm">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content">

                    <legend>Main Information</legend>
                    <div class="form-group">

                        <label class=" col-md-1 control-label"> Bill No.</label>
                        <div class="col-md-5">

                            <input name="bill" id="bill" type="text" placeholder="Bill Number" class="form-control" required>
                        </div>
                        <label class=" col-md-3 control-label">Date </label>

                        <div class="col-md-3">

                            <input name="sdate" id="sdate" type="text" placeholder="Sales Date" class="form-control" required value="{{date('Y-m-d')}}">
                        </div>

                    </div>

                    <div class="form-group">

                        <label class=" col-md-1 control-label"> Customer </label>

                        <div class="col-md-11" >

                            <select class="  chosen-select" style="width:350px;" tabindex="4" id="customer" name="customer" onchange="change(this)" required>


                                @foreach($customers as $c)

                                <option value="{{$c->id}}"> {{$c->cus_name }} ({{$c->address3}}) </option>


                                @endforeach

                            </select>



                        </div>



                    </div>


                    <div class="form-group">

                        <label class=" col-md-1 control-label"> Vehicle </label>

                        <div class="col-md-11" >

                            <select class="  chosen-select" style="width:350px;" tabindex="4" id="vehicle" name="vehicle"  required>


                                @foreach($vehicles as $v)

                                <option value="{{$v->id}}"> {{$v->vehicle_number }} - {{$v->vehicle_type}} ({{$v->vehicle_model }}) </option>


                                @endforeach

                            </select>



                        </div>



                    </div>
                    <hr>
                    <div class="form-group" hidden="true">

                        <label class=" col-md-1 control-label">  Gross Sales </label>

                        <div class="col-md-3">

                            <input name="gsale" id="gsale" type="text" placeholder="Gross Sales" class="form-control"  readonly    required>
                        </div>

                        <label class=" col-md-1 control-label"> Free Amount </label>

                        <div class="col-md-3">

                            <input name="free_amt" id="free_amt" type="text" placeholder="Free Amount" class="form-control"     value="0"  required>
                        </div>

                        <label class=" col-md-1 control-label"> Exchange Amount </label>

                        <div class="col-md-3">

                            <input name="exchange_amt" id="exchange_amt" type="text" placeholder="Exchange Amount" class="form-control"    value="0"    required>
                        </div>





                    </div>

                    <div class="form-group" hidden="true">

                        <label class=" col-md-1 control-label"> Market Return </label>

                        <div class="col-md-3">

                            <input name="mreturn" id="mreturn" type="text" placeholder="Market Return" class="form-control"   onkeyup="calcGross()" value="0"  required>
                        </div>

                        <label class=" col-md-1 control-label"> Good Return </label>

                        <div class="col-md-3">

                            <input name="greturn" id="greturn" type="text" placeholder="Gross Return" class="form-control"   onkeyup="calcGross()"  value="0" required>
                        </div>

                        <label class=" col-md-1 control-label"> Sales Discount </label>

                        <div class="col-md-3">

                            <input name="discount" id="discount" type="text" placeholder="Sales Discount" class="form-control"    onkeyup="calcGross()" value="0" required>
                        </div>





                    </div>
                    <hr>

                    <div class="form-group">

                        <label class=" col-md-1 control-label"> Net Total </label>

                        <div class="col-md-3">

                            <input name="total" id="total" type="text" placeholder="Total bill amount" class="form-control"    onkeyup="totalChange(this.value)"  required>
                        </div>


                        <label class=" col-md-1 control-label"> Paid </label>

                        <div class="col-md-3">

                            <input name="paid" id="paid" type="text" placeholder="Paid amount" class="form-control"  readonly  required>
                        </div>

                        <label class=" col-md-1 control-label"> Due </label>

                        <div class="col-md-3">

                            <input name="due" id="due" type="text" placeholder="Due amount" class="form-control"  readonly  required>
                        </div>

                    </div>



                </div>
            </div>
        </div>
    </div>





    <div class="row" style="padding:0cm">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content">



                    <div class="col-md-10">
                        <legend>
                            Payment Information  </legend>  </div><div class="col-md-2">
                    <button class="btn btn-primary btn-rounded  pull-right" type="button" data-toggle="modal" data-target="#add-payment"><i class="fa fa-plus"></i>
                        PAYMENTS         </button>

                    </div> 





                    <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Payment Type</th>
                                <th>Amount</th>
                                <th>Cheque Number</th>    
                                <th>Cheque Date</th>
                                <th>Cheque Bank</th>


                                <th class="col-md-1"></th>
                            </tr>
                        </thead>
                        <tbody id="tbl">

                        </tbody>

                    </table>


                </div>
            </div>
        </div>

    </div>

    <div class="row" style="padding:0cm">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content">




                    <legend>
                        Products  </legend>   


                    <div class="form-group">

                        <label class="col-md-2 control-label">Product</label>
                        <div class="col-md-8">

                            <select class="form-control" id="product" name="product" onchange="proChange()">

                                @foreach($products as $p)
                                <option  value="{{$p->id}}" data-product="{{$p->sub_name}}" data-buy="{{$p->buying_price}}" data-sell="{{$p->price}}"> {{$p->sub_name}} (Unit Price - Rs.{{$p->price}}) </option>

                                @endforeach

                            </select>
                        </div>    

                    </div>


                    <div class="form-group">

                        <label class="col-md-2 control-label">Quantity</label>
                        <div class="col-md-2">

                            <input type="number" class="form-control" id="qty1" name="qty1"  onkeyup="qtyChange()">
                        </div>    


                        <label class="col-md-1 control-label">Selling Price</label>
                        <div class="col-md-2">

                            <input type="number" class="form-control" id="sp1" name="sp1" onkeyup="qtyChange()">
                        </div>  

                        <label class="col-md-1 control-label">Total</label>
                        <div class="col-md-2">

                            <input type="number" class="form-control" id="tot1" name="tot1" readonly>
                        </div>  
                        <div class="col-md-2">

                            <button  type="button" onclick="savePro()" class="btn btn-block btn-success">Add</button>
                        </div>

                    </div>
                    <hr>

                    <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Original Price</th>    
                                <th>Sold Price</th>
                                <th>Total</th>
                                <th>Profit Difference</th>

                                <th class="col-md-1"></th>
                            </tr>
                        </thead>
                        <tbody id="tbl1">

                        </tbody>

                    </table>


                </div>
            </div>
        </div>

    </div>




</form>


<div class="row" style="padding:0cm">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">

            <div class="ibox-content">


                <legend>Documents</legend>


                <form action="post_upload" class="dropzone" id="my-awesome-dropzone">

                    <input name="_token" value="{{csrf_token()}}" hidden="">
                </form>



            </div>
        </div>
    </div>

</div>
<div class="col-md-offset-10">


    <button class="btn btn-primary btn-block"  onclick="saveDB()"> Save All</button>
</div>








<div class="modal inmodal fade" id="add-payment" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add Payment</h4>

            </div>
            <form class="form-horizontal" id="addR" onsubmit="return savePayment()">
                <div class="modal-body">


                    <div class="form-group">

                        <label class="col-lg-3 control-label"> Payment Type </label>

                        <div class="col-lg-9"> <select  onchange="hideOpts(this.value)"class="form-control" required id="payment_type">

                            <option value="CASH">CASH</option>
                            <option value="CHEQUE">CHEQUE</option>
                            <option value="CREDIT">CREDIT</option>

                            </select>
                        </div>


                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"> Amount</label>

                        <div class="col-lg-9"><input placeholder="Total Amount Paid" class="form-control" type="text" required id="pAmount" >
                        </div>
                    </div>

                    <div id="payment_method" hidden="true">
                        <div class="form-group">
                            <label class="col-lg-3 control-label"> Cheque Date</label>

                            <div class="col-lg-9"><input placeholder=" Cheque Date" class="form-control" type="text"  id="pDate" >
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-3 control-label"> Cheque No.</label>

                            <div class="col-lg-9"><input placeholder="Cheque Number" class="form-control" type="text"  id="pNum" >
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-3 control-label"> Cheque Bank</label>

                            <div class="col-lg-9"><input placeholder="Cheque Bank" class="form-control" type="text"  id="pBank" >
                            </div>
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


@endsection



@section('js')


<script>

    var tempInfo = [];
    var products = [];


    $('document').ready(function(){


        //document.getElementById("man").setAttribute('class','active');
        // document.getElementById("man").click();
        $('#sal').click();
        document.getElementById("cSales").setAttribute('class','active');
        // dataLoad();


        proChange();
        $('#product').chosen({

            width:"100%"

        });

        $('#customer').chosen({

            width:"100%"

        });


        $('#vehicle').chosen({

            width:"100%"

        });

        $('#sdate').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format:"yyyy-mm-dd"
        });

        $('#pDate').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format:"yyyy-mm-dd"
        });


        Dropzone.options.myAwesomeDropzone = {
            url: "post_upload" ,       
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            accept: function(file, done) {
                //console.log(done);

                done();
            },
            success:function(file,response){

                //alert(response);
                console.log(file);

                var self = this;
                //alert(response);

                file.previewElement.addEventListener("click", function() { 

                    delDoc(response,self,file);

                });
                //file.lastElementChild.innerHTML = "LOL";

            } 

        };


    });

    
    function qtyChange(){
    
        var original = $('#product').children('option:selected').data('sell');
        var sell =    $('#sp1').val();
        var qty =    $('#qty1').val();
      
    
        $('#tot1').val((sell*qty));
    
    }
    function proChange(){
    
     var original = $('#product').children('option:selected').data('sell');
        
        $('#sp1').val(original);
        $('#qty1').val('0');
        $('#tot1').val('0');
        
    }
    function savePro(){




        var sellamount = $('#sp1').val();
        var qty = $('#qty1').val();
        var productid = $('#product').val();
        var name = $('#product').children('option:selected').data('product');
        var original = $('#product').children('option:selected').data('sell');

        var tot = sellamount*qty;
        
        var or = original*qty;

        var diff =  tot - (original*qty) ;

        //$("#product option[value='"+ product + "']").attr('disabled', true ).trigger("liszt:updated");; 
        //$("#product option[value='"+ product + "']").attr('disabled', true ).trigger("liszt:updated");; 

        // $(" #product .chzn-select").val(product).trigger("liszt:updated");
        products.push({
            id:productid,
            sell : sellamount,
            name:name,
            original:or,
            tot : tot,
            diff:diff,
            qty:qty
        });
        

        loadTable1(products);

        return false;




    }

    function delDoc(id,dropzone,file){



        $.ajax({

            url:'docDelete' ,
            type:'get',
            data : {id:id},
            success:function(data){
                dropzone.removeFile(file);

            },
            error: function(err){

                console.log(err);
            }

        });



    }


    function calcGross(){

        var net  = parseFloat($('#total').val());
        var mreturn  =parseFloat( $('#mreturn').val());
        var greturn = parseFloat($('#greturn').val());
        var discount =parseFloat( $('#discount').val());


        $('#gsale').val((net+mreturn+greturn+discount));

    }

    function changeFull(){

        var dis = $('#fdiscount').val();
        var total = $('#total').val();

        if((total-dis) >= 0){

            document.getElementById("total").value = (total-dis);

        }else{
            document.getElementById("fdiscount").value = 0;
            alert("total cannot be negative");
        }

    }

    function changeFree(){


        var unitPrice = $('#product').children('option:selected').data('price');

        var free = $("#free").val();

        var price = $("#amount").val();

        var result = price - (free*unitPrice);

        if(result >= 0){

            document.getElementById("discount").value = (free*unitPrice);
            document.getElementById("amount").value = price - (free*unitPrice);
        }else{
            document.getElementById("free").value = 0;
            alert("amount cannot be negative");
        }

    }

    function calPrice(a){

        var unitPrice = $('#product').children('option:selected').data('price');
        var discount = $('#discount').val();

        var val = ($('#quantity').val() * unitPrice) - discount;
        if(val > 0){
            document.getElementById("amount").value = ($('#quantity').val() * unitPrice) - discount;
        }else{

            document.getElementById("discount").value = 0;
            alert("Price cannot be negative");
        }

    }

    function dataLoad(){

        var oTable = $('#dd1').DataTable();
        oTable.destroy();

        var loadid = $('#loadid').val();
        $('#dd1').DataTable( {
            "ajax": "getsaleshisotry?id="+loadid,
            "columns": [
                { "data": "id" },
                { "data": null,
                 "mRender" : function(data){


                     return "Rs."+parseFloat(data.total).toFixed(2);

                 }},
                { "data": null,
                 "mRender" : function(data){


                     return "Rs."+parseFloat(data.discount).toFixed(2);

                 }},
                { "data": "sale_date" },
                { "data": "remarks" },

                {"data" : null,
                 "mRender": function(data, type, full) {


                     return '<a class="btn btn-primary  btn-animate btn-animate-side btn-block btn-sm" href="sales_view?id='+data.id+'"> View Details</a>' ;
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


    function del(id){

        tempInfo.splice(id,1);
        loadTable(tempInfo);

    }

    
    function del1(id){
        

        var tot =  $('#total').val();
        console.log(products[id]);
        
        tot = tot-products[id].tot;
        
         $('#total').val(tot);
        
        products.splice(id,1);
        loadTable1(products);

    }

    function change(a){

        var max = $('#product').children('option:selected').data('available');

        if(max == null || max == ""){
            $('#quantity').attr({
                "max" : 0,        // substitute your own
                "min" : 0  

            });

        }else{
            $('#quantity').attr({
                "max" : max,        // substitute your own
                "min" : 1  

            });
        }

    }

    function savePayment(){

        var amount = $('#pAmount').val();
        var type = $('#payment_type').val();

        if(type == "CASH"){

            var chknum = "N/A";
            var bank =  "N/A";
            var chkdate =  "N/A";

        }else{
            var chknum = $('#pNum').val();
            var bank = $('#pBank').val();
            var chkdate = $('#pDate').val();

        }
        //$("#product option[value='"+ product + "']").attr('disabled', true ).trigger("liszt:updated");; 
        //$("#product option[value='"+ product + "']").attr('disabled', true ).trigger("liszt:updated");; 

        // $(" #product .chzn-select").val(product).trigger("liszt:updated");


        tempInfo.push({

            type: type,
            amount : amount,
            chknum: chknum,
            bank : bank,
            chkdate : chkdate

        });


        console.log(tempInfo);

        loadTable(tempInfo);

        $('#add-payment').modal('hide');
        return false;
    }

    function loadTable(arr){

        var fullTot = $('#total').val();

        var tot = 0;
        var body = "";
        for(var i = 0; i< arr.length; i++){
            tot = (tot + parseFloat(arr[i].amount));


            body+=   "<tr> <td> "+(i+1)+"</td> <td>"+arr[i].type+" </td> <td> Rs."+parseFloat(arr[i].amount).toFixed(2)+" </td> <td>"+arr[i].chknum+" </td> <td>"+arr[i].chkdate+" </td> <td>"+arr[i].bank+" </td><td><button class='btn btn-sm btn-danger' onclick='del("+i+")'> Delete </button> </td> </tr>";

        } 

        document.getElementById("tbl").innerHTML = body;

        $('#paid').val(tot);

        if((fullTot -tot) > 0){

            $('#due').val((fullTot -tot));

        }else{

            $('#due').val('0');

        }



        // document.getElementById("total").value = (tot);
        // document.getElementById("fdiscount").value = discount;



    }
    
    
    function loadTable1(arr){

        //var fullTot = $('#total').val();

        var tot = 0;
        var body = "";
        for(var i = 0; i< arr.length; i++){
            tot = (tot + parseFloat(arr[i].tot));
            body+=   "<tr> <td> "+(i+1)+"</td> <td>"+arr[i].name+" </td> <td> "+ arr[i].qty+" </td> <td>"+arr[i].original+" </td> <td>"+arr[i].sell+" </td> <td>"+arr[i].tot+" </td> <td>"+arr[i].diff+" </td><td><button type='button' class='btn btn-sm btn-danger' onclick='del1("+i+")'> Delete </button> </td> </tr>";

        } 

        document.getElementById("tbl1").innerHTML = body;

        $('#total').val(tot);
 
        // document.getElementById("total").value = (tot);
        // document.getElementById("fdiscount").value = discount;



    }

    function saveDB(){

        var customer = $('#customer').val();
        var sdate = $('#sdate').val();
        var total = $('#total').val();
        var paid = $('#paid').val();
        var due = $('#due').val();
        var bill = $('#bill').val();


        var mreturn  =parseFloat( $('#mreturn').val());
        var greturn = parseFloat($('#greturn').val());
        var discount =parseFloat( $('#discount').val());


        var gsale=  $('#gsale').val();


        $.ajax({
            type: "get",
            url: 'insert_customer_sales',
            data: {

                payments : tempInfo,
                customer :customer,
                paid : paid,
                saledate : sdate,
                total : total,
                due: due,
                bill : bill,
                mreturn : mreturn,
                greturn: greturn,
                discount: discount,
                gsale:gsale,
                products:products


            },

            success : function(data){
                location.reload();

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        });  

    }

    function hideOpts(a){


        if(a == 'CASH' || a == 'CREDIT'){

            document.getElementById("payment_method").setAttribute("hidden",true);

        }else{

            document.getElementById("payment_method").removeAttribute("hidden",false);

            $('#pNum').val("");
            $('#pBank').val("");
            $('#pDate').val("");
        }

    }
    function totalChange(a){

        var paid = $('#paid').val();
        if((a-paid )> 0){


            $('#due').val((a-paid ));
        }else{
            $('#due').val('0');


        }
        calcGross();
    }

</script>
@endsection