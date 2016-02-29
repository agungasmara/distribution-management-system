@extends('master')





@section('heading')

Enter Sales


@endsection
@section('breadcrumb')


<li>
    <a href="#">Loading/Unloading</a>
</li>
<li class="active">
    <strong>Active Vehicles</strong>
</li>


@endsection


@section('headerbuttons') 
<h3 id="tot">Total : Rs.0</h3>
@endsection






@section('content')

<br>
<div class="row" style="padding:0cm">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">

            <div class="ibox-content">
                <form class="form-horizontal" onsubmit="return save()"> 

                    <div class="form-group">

                        <label class=" col-md-1 control-label"> Customer </label>

                        <div class="col-md-7" >

                            <select class="  chosen-select" style="width:350px;" tabindex="4" id="customer" name="customer"  >


                                @foreach($customers  as $c)


                                <option value="{{$c->id}}"> {{$c->cus_name}} - {{$c->address3}} </option>

                                @endforeach

                            </select>



                        </div>

                        <div class="col-md-4">

                            <input name="sdate" id="sdate" type="text" placeholder="Sales Date" class="form-control" required>
                        </div>


                    </div>


                    <div class="form-group">

                        <label class=" col-md-1 control-label"> Product </label>

                        <div class="col-md-6" >

                            <select class="  chosen-select" style="width:350px;" tabindex="4" id="product" name="product" onchange="change(this)" required>


                                @foreach($products as $p)

                                <option value="{{$p->sub_product_id}}" data-available="{{$p->available_qty}}" data-name="{{$p->sub_name}}" data-price="{{number_format($p->price,2,'.','')}}" data-tblid="{{ $p->id }}"> {{$p->sub_name}} ( <b> {{number_format($p->available_qty)}}  Available </b>)
                                    Rs. {{number_format($p->price,2)}}                </option>


                                @endforeach

                            </select>



                        </div>

                        <div class="col-md-2">

                            <input name="quantity" id="quantity" type="number" placeholder="Qunatitiy" class="form-control" onchange="calPrice(this.value)" onkeypress="calPrice(this.value)" required>
                        </div>

                        <div class="col-md-2">

                            <input name="amount" id="amount" type="number" placeholder="Amount" class="form-control" required disabled>
                        </div>
                        <div class="col-md-1">

                            <button class="btn btn-primary btn-block"  type="submit"> Add </button>
                        </div>
                    </div>
                    <input type="hidden" name="total" id="total">
                    <legend>Added Sales</legend>
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                        <thead>
                            <tr>
                                <th>#</th>

                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>

                                <th class="col-md-1"></th>
                            </tr>
                        </thead>
                        <tbody id="tbl">

                        </tbody>

                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-md-offset-10">

    <button class="btn btn-primary btn-block"  onclick="saveDB()"> Save All</button>
</div>

<input type="hidden" id="loadid" value="{{$loadid}}">

@endsection



@section('js')


<script>

    var tempInfo = [];


    $('document').ready(function(){


        //document.getElementById("man").setAttribute('class','active');
        // document.getElementById("man").click();
        $('#loa').click();
        document.getElementById("act").setAttribute('class','active');
        //dataLoad();


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



    function calPrice(a){

        var unitPrice = $('#product').children('option:selected').data('price');

        document.getElementById("amount").value = ($('#quantity').val() * unitPrice);

    }

    function dataLoad(){

        var oTable = $('#dd').DataTable();
        oTable.destroy();

        $('#dd').DataTable( {
            "ajax": "getsalesload",
            "columns": [
                { "data": "id" },
                { "data": "vehicle_model" },
                { "data": "vehicle_number" },
                { "data": "vehicle_type" },
                { "data": "load_date" },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<span class="label label-success">'+data.status+' </span>';
                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {


                     return '<a class="btn btn-primary  btn-animate btn-animate-side btn-block btn-sm" href="reload-view?id='+data.id+'"> Reload </a>' ;
                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {


                     return '<a class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" href="unload-view?id='+data.id+'"> Unload </a>' ;
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
        //$("#product option[value='"+ product + "']").attr('disabled', true ).trigger("liszt:updated");; 
        //$("#product option[value='"+ product + "']").attr('disabled', true ).trigger("liszt:updated");; 

        // $(" #product .chzn-select").val(product).trigger("liszt:updated");
        tempInfo.push({
            amount: amount,
            qty: qty,
            product:product,
            name:name,
            tblid:tblid
        });
        console.log(tempInfo);

        loadTable(tempInfo);

        return false;
    }

    function loadTable(arr){

        var tot = 0;
        var body = "";
        for(var i = 0; i< arr.length; i++){
            tot = (tot + parseFloat(arr[i].amount));

            body+=   "<tr> <td> "+(i+1)+"</td> <td>"+arr[i].name+" </td> <td>"+arr[i].qty+" </td> <td>"+arr[i].amount+" </td> <td><button class='btn btn-sm btn-danger' onclick='del("+i+")'> Delete </button> </td> </tr>";

        } 

        document.getElementById("tbl").innerHTML = body;
        document.getElementById("tot").innerHTML ="Total : Rs."+tot;
        document.getElementById("total").value = tot;

    }

    function saveDB(){

        var customer = $('#customer').val();
        var sdate = $('#sdate').val();
        var loadid = $('#loadid').val();
        var total = $('#total').val()

        $.ajax({
            type: "get",
            url: 'insert_sales_all',
            data: {
                items : tempInfo,
                customer :customer,
                loadid : loadid,
                saledate : sdate,
                total : total

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