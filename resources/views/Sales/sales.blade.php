@extends('master')





@section('heading')

Sales Information


@endsection
@section('breadcrumb')


<li>
    <a href="#">Loading/Unloading</a>
</li>
<li>
    <a href="active-vehicles">Active Vehicles</a>
</li>
<li class="active">
    <strong>Sales Information</strong>
</li>


@endsection


@section('headerbuttons') 

@endsection






@section('content')

<br>
<div class="row" style="padding:0cm">
    <div class=" ">
        <div class="ibox float-e-margins">

            <div class="ibox-content">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">ADD SALES</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">SALES HISOTRY</a></li>
                </ul>

            </div>
        </div>
    </div>
</div>
<div class="tab-content">
    <div id="tab-1" class="tab-pane active">

        <form class="form-horizontal" onsubmit="return save()"> 

            <div class="row" style="padding:0cm">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">

                        <div class="ibox-content">

                            <legend>Main Information</legend>

                                  <div class="form-group">
 

                                <label class=" col-md-2 control-label"> Sales Date </label>

                                <div class="col-md-3">

                                    <input name="sdate" id="sdate" type="text" placeholder="Sales Date" class="form-control" required value="{{date('Y-m-d')}}">
                                </div>

                                      
                                        <label class=" col-md-2 control-label">  Remarks </label>
                                <div class="col-md-5">

                                    <textarea class="form-control" id="remarks"  placeholder="Any special comments?"></textarea>
                                </div>
                            
                            </div>

                            <div class="form-group" hidden="true">

                                          <label class=" col-md-1 control-label"> Discount </label>

                                <div class="col-md-2">

                                    <input   onkeyup="changeFull()"  type="text" placeholder="Full Discount"  id="fdiscount" class="form-control" value="0" readonly>
                                </div>

                                <label class=" col-md-1 control-label">   Total </label>

                                <div class="col-md-3">

                                    <input  id="total" value="0" type="text" placeholder="Sales Date" class="form-control" required readonly>
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

                            <legend>Add Products</legend>
                            <div class="form-group">

                                <label class=" col-md-1 control-label"> Product </label>

                                <div class="col-md-11" >

                                    <select class="  chosen-select" style="width:350px;" tabindex="4" id="product" name="product" onchange="change(this)" required>


                                        @foreach($products as $p)

                                        <option value="{{$p->sub_product_id}}" data-available="{{$p->available_qty}}" data-name="{{$p->sub_name}}" data-price="{{number_format($p->price,2,'.','')}}" data-tblid="{{ $p->id }}"> {{$p->sub_name}} ( <b> {{number_format($p->available_qty)}}  Available </b>)
                                            Rs. {{number_format($p->price,2)}}                </option>


                                        @endforeach

                                    </select>



                                </div>
                            </div>

                            <div class="form-group">

                            

                                <label class=" col-md-1 control-label"> Free </label>

                                <div class="col-md-2">

                                    <input name="free" id="free" type="number" placeholder="Free Items" class="form-control" value="0" min="0"  onkeyup=" calcQty(this)" required>
                                </div>

                                  <label class=" col-md-2 control-label"> Market Return </label>

                                <div class="col-md-2">

                                    <input name="mreturn" id="mreturn" type="number" placeholder="Market Return" class="form-control" value="0" min="0" onkeyup=" calcQty(this)"  required>
                                </div>
                   
                                  <label class=" col-md-2 control-label"> Good Return </label>

                                <div class="col-md-2">

                                    <input name="greturn" id="greturn" type="number" placeholder="Good Return" class="form-control" value="0" min="0"  onkeyup=" calcQty(this)" required>
                                </div>
                   

                            </div>
                            
                            <hr>
                            <div class="form-group">
                            
                                <label class=" col-md-1 control-label"> Quantity </label>

                                <div class="col-md-2">

                                    <input name="quantity" id="quantity" type="number" placeholder="Qunatitiy" class="form-control" readonly onkeyup=" calcQty(this)" required>
                                </div>
                                
                                
                                   <label class=" col-md-2 control-label"> Exchange Quantity </label>

                                <div class="col-md-2">

                                    <input name="exchange" id="exchange" type="number" placeholder="Exchange Quantity" class="form-control" onkeyup=" calcQty(this)"  value="0"  required>
                                </div>
                            
                                
                                
                                   <label class=" col-md-2 control-label"> Sold Quantity</label>

                                <div class="col-md-2">

                                    <input name="sold" id="sold" type="number" placeholder="Sold Quantity" class="form-control" onkeyup=" calcQty(this)"  value="0"  required>
                                </div>
                                
                            </div>
                            
                            <div hidden="true">
                                         <label class=" col-md-1 control-label"> Price </label>

                                <div class="col-md-2">

                                    <input name="amount" id="amount" type="number" placeholder="Amount" class="form-control" required disabled>
                                </div>

                                <label class=" col-md-1 control-label"> Discount </label>

                                <div class="col-md-2">

                                    <input name="discount" id="discount" type="text" placeholder="Discount" class="form-control" required  value="0" onkeyup="calPrice(this.value)" onchange="calPrice(this.value)"  >
                                </div>

                            
                            </div>
                            <div class="form-group">

                                <div class=" col-md-offset-9 col-md-3">

                                    <button class="btn btn-success btn-block"  type="submit"> Add </button>
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


                            <legend>Added Product Sales</legend>
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                                <thead>
                                    <tr>
                                        <th>#</th>

                                        <th>Product Name</th>
                                        <th>Net Qty</th>
                                        <th>Free</th>
                                        <th>Sold</th>
                                        <th>Market Return</th>
                                        <th>Good Return</th>
                                        <th>Exchange</th>
                                        
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


        </form>
        <div class="col-md-offset-10">

            <button class="btn btn-primary btn-block"  onclick="saveDB()"> Save All</button>
        </div>




        <input type="hidden" id="loadid" value="{{$loadid}}">
    </div>
    <div id="tab-2" class="tab-pane ">

        <div class="row" style="padding:0cm">
            <div class=" ">
                <div class="ibox float-e-margins">

                    <div class="ibox-content">

                        <table class="table table-striped table-bordered table-hover dataTables-example" id="dd1" plugin="datatable" >
                            <thead>
                                <tr>
                                    <th>#</th>

                                    
                                    
                                    <th>Batch Date</th>
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


    </div>
</div>


@endsection



@section('js')


<script>

    var tempInfo = [];


    $('document').ready(function(){


        //document.getElementById("man").setAttribute('class','active');
        // document.getElementById("man").click();
        $('#loa').click();
        document.getElementById("act").setAttribute('class','active');
        dataLoad();


        $('#product').chosen({

            width:"100%"

        });

        $('#customer').chosen({

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

    });


    function calcQty(a){
        
        var free = parseFloat($('#free').val());
        var mreturn = parseFloat($('#mreturn').val());
        var greturn = parseFloat($('#greturn').val());
         
        var exchange = parseFloat($('#exchange').val());
        var sold = parseFloat($('#sold').val());
        
        var val = ((sold+free+exchange)-greturn);
        
        var available = $('#product').children('option:selected').data('available');
        
        if(val>available){
        
            a.value=0;
           calcQty(a); 
            alert("cannot exceed available quantity");
            
        }else{
            
           $('#quantity').val(val); 
        }
        //calPrice(val);
        
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

    function save(){

        var amount = $('#amount').val();
        var qty = $('#quantity').val();
        var product = $('#product').val();
        var name = $('#product').children('option:selected').data('name');
        var tblid = $('#product').children('option:selected').data('tblid');
        var discount = $('#discount').val();
        var free = $('#free').val();
        
        
           
        var mreturn = parseFloat($('#mreturn').val());
        var greturn = parseFloat($('#greturn').val());
         
        var exchange = parseFloat($('#exchange').val());
        var sold = parseFloat($('#sold').val());
        

        //$("#product option[value='"+ product + "']").attr('disabled', true ).trigger("liszt:updated");; 
        //$("#product option[value='"+ product + "']").attr('disabled', true ).trigger("liszt:updated");; 

        // $(" #product .chzn-select").val(product).trigger("liszt:updated");
        tempInfo.push({
            amount: amount,
            qty: qty,
            product:product,
            name:name,
            tblid:tblid,
            free:free,
            discount:discount,
            mreturn:mreturn,
            greturn:greturn,
            exchange:exchange,
            sold:sold
        });
        console.log(tempInfo);

        loadTable(tempInfo);

        return false;
    }

    function loadTable(arr){

        var discount = 0;
        var tot = 0;
        var body = "";
        for(var i = 0; i< arr.length; i++){
            tot = (tot + parseFloat(arr[i].amount));
            discount = (discount + parseFloat(arr[i].discount));
            //alert(parseFloat(arr[i].discount));
            body+=   "<tr> <td> "+(i+1)+"</td> <td>"+arr[i].name+" </td> <td>"+arr[i].qty+" </td> <td>"+arr[i].free+" </td> <td>"+arr[i].sold+" </td>  <td>"+arr[i].mreturn+" </td> <td>"+arr[i].greturn+" </td> <td>"+arr[i].exchange+" </td><td><button class='btn btn-sm btn-danger' onclick='del("+i+")'> Delete </button> </td> </tr>";

        } 

        document.getElementById("tbl").innerHTML = body;

      
        document.getElementById("total").value = (tot);
        document.getElementById("fdiscount").value = discount;
        
        console.log(discount);

    }

    function saveDB(){

        var customer = $('#customer').val();
        var sdate = $('#sdate').val();
        var loadid = $('#loadid').val();
        var total = $('#total').val();
        var fdiscount = $('#fdiscount').val();
        var remarks = $('#remarks').val();

        $.ajax({
            type: "get",
            url: 'insert_sales_all',
            data: {
                items : tempInfo,
                customer :customer,
                loadid : loadid,
                saledate : sdate,
                total : total,
                fdiscount : fdiscount,
                remarks : remarks

            },

            success : function(data){
                location.reload();

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        });  

    }

</script>
@endsection