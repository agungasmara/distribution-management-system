@extends('master')





@section('heading')
Customer Sales Information


@endsection
@section('breadcrumb')


<li>
    <a href="#">Sales</a>
</li>

<li>
    <a href="#">Sales Log</a>
</li>
<li class="active">
    <strong>Customer Sales Information</strong>
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

                <legend>General Information</legend>

                <div class="row">

                    <div class="col-md-1">
                        <label class=" control-label pull-right">Bill #</label>
                    </div>
                    <div class="col-md-4">
                        <span class="label label-primary">  {{$sales->bill_num}} </span> 
                    </div>



                    <div class="col-md-1">
                        <label class=" control-label pull-right">Date</label>
                    </div>
                    <div class="col-md-2">
                        {{$sales->date}}
                    </div>
                </div>
                <br>
                <div class="row">

                    <div class="col-md-1">
                        <label class=" control-label pull-right">Customer</label>
                    </div>
                    <div class="col-md-4">
                        <span class="label label-success"  >   {{$customer->cus_name}} </span>
                    </div>

                    <div class="col-md-1">
                        <label class=" control-label pull-right">Address</label>
                    </div>
                    <div class="col-md-3">
                        {{$customer->address1}} <br>
                        {{$customer->address2}}, {{$customer->address3}}
                    </div>

                    <div class="col-md-1">
                        <label class=" control-label pull-right">Phone</label>
                    </div>
                    <div class="col-md-2">
                        {{$customer->phone}}  
                    </div>


                </div>
                <br>




            </div>
        </div>
    </div>
</div>

<div class="row" style="padding:0cm">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">

                <legend>Payment Information</legend>
                <div class="row">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Payment Type</th>
                                <th>Amount</th>
                                <th>Cheque Number</th>    
                                <th>Cheque Date</th>
                                <th>Cheque Bank</th>
                                <th>Status</th>



                            </tr>
                        </thead>
                        <tbody id="tbl">
                            <?php $id=1; ?>
                            @foreach($payments as $p)


                            <tr>
                                <td> {{$id}}</td>
                                <td> {{$p->type}}</td>
                                <td> {{number_format($p->amount,2,'.',',')}}</td>
                                <td> {{$p->chqnum}}</td>
                                <td> {{$p->chqdate}}</td>
                                <td> {{$p->chqbank}}</td>
                                <td> 
                                    @if($p->type == 'CASH')

                                    <span class="label label-primary">CASHED</span>
                                    @elseif($p->status == 'PENDING')
                                    <span class="label label-danger">{{$p->status}}</span>
                                    @else
                                    <span class="label label-primary">{{$p->status}}</span>
                                    @endif

                                </td>



                            </tr>

                            <?php $id++; ?>
                            @endforeach
                        </tbody>

                    </table>
                </div>


            </div>
        </div>
    </div>
</div>

<div class="col-lg-12 animated fadeInRight">

    <legend> Documents</legend>
    <?php $count = 0; ?>
    @foreach($docs as $d)
    <div class="file-box">
        <div class="file">
            <a href="{{$d->doc_path}}">
                <span class="corner"></span>

               <div class="icon">
                                            <i class="fa fa-file"></i>
                                        </div>
                <div class="file-name">
                    Document-{{$count}}
                    <br>
                    <small>Added: {{$d->created_at}}</small>
                </div>
            </a>
        </div>
    </div>
    
   
    <?php $count++; ?>
    @endforeach
</div>






@endsection



@section('js')


<script>

    var tempInfo = [];


    $('document').ready(function(){


        //document.getElementById("man").setAttribute('class','active');
        // document.getElementById("man").click();
        $('#sal').click();
        document.getElementById("daily").setAttribute('class','active');
        // dataLoad();


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

    function saveDB(){

        var customer = $('#customer').val();
        var sdate = $('#sdate').val();
        var total = $('#total').val();
        var paid = $('#paid').val();
        var due = $('#due').val();
        var bill = $('#bill').val();

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
                bill : bill


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


        if(a == 'CASH'){

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

    }

</script>
@endsection