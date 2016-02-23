@extends('master')





@section('heading')


Load Unload Log


@endsection
@section('breadcrumb')


<li>
    <a href="#">Loading/Unloading</a>
</li>

<li>
    <a href="active-vehicles">Loading History</a>
</li>

<li class="active">
    <strong>Load Unload Log</strong>
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

    <legend>Main Information</legend>
               
                <form class="form-horizontal">
                
                <div class="form-group row">
                    
                    
                    
                    <label class="col-md-2 control-label"> Status</label>
                    
                    <label class="col-md-2 pull-left" style="font-weight:400;padding-top:0.7%">
                        @if($loadMain->status=='ACTIVE')
                          <span class="label label-primary">
                        {{$loadMain->status}}
                        </span> 
                        @else
                        <span class="label label-success">
                        {{$loadMain->status}}
                        </span> 
                    
                    @endif</label>
                    
                    
                    
                    <label class="col-md-2 control-label"> Load Date</label>
                    
                    <label class="col-md-2 " style="font-weight:400;padding-top:0.7%"> {{$loadMain->load_date}}</label>
                    
                    
                    
                    <label class="col-md-2 control-label"> Unload Date</label>
                    
                    <label class="col-md-2 " style="font-weight:400;padding-top:0.7%"> {{$loadMain->unload_date}}</label>
                    
                    
                    
                    </div>
                
           
                     
                
                 
                </form>
                

            </div>
        </div>
    </div>
</div>
    
     
    
    <div class="row" style="padding:0cm">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">

            <div class="ibox-content">

    <legend>Vehicle Information</legend>
               
                <form class="form-horizontal">
                
                <div class="form-group row">
                    
                    
                    
                    <label class="col-md-2 control-label"> Type </label>
                    
                    <label class="col-md-2 pull-left text-uppercase" style="font-weight:400;padding-top:0.7%">
                        {{$vehicle->vehicle_type}}
                        
                       </label>
                    
                    
                    
                    <label class="col-md-2 control-label"> Vehicle Model</label>
                    
                    <label class="col-md-2 " style="font-weight:400;padding-top:0.7%"> {{$vehicle->vehicle_model}}</label>
                    
                    
                    
                    <label class="col-md-2 control-label"> Vehicle Number</label>
                    
                    <label class="col-md-2 " style="font-weight:400;padding-top:0.7%"> {{$vehicle->vehicle_number}}</label>
                    
                    
                    
                    </div>
                
           
                     
                
                 
                </form>
                

            </div>
        </div>
    </div>
</div>
    
    
<div class="row" style="padding:0cm">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">

            <div class="ibox-content">
<legend> Load Items Summary </legend>
                <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                    <thead>
                        <tr>

                            <th>#</th>
                            
                            <th>Product Name</th>
                            <th><center> Quantity Loaded </center></th>
                           <th><center> Quantity Unloaded </center></th>
                            <th>Remarks</th>

                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php $count = 0; ?>
                        @foreach($loadItems as $l)
                        <tr>
                            <td>{{$count + 1}}</td>
                        <td> {{ $l->pro_name }}</td>
                             <td>   <center> {{ $l->number }} </center></td>
                        <td>    <center> {{ $l->unload_qty }} </center> </td>
                            <td>{{ $l->unload_remarks }}</td>
                         
                        </tr>
                        
                         <?php $count++; ?>
                        
                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>
 
 


@endsection



@section('js')


<script>


    $('document').ready(function(){


        //document.getElementById("man").setAttribute('class','active');
        // document.getElementById("man").click();
        $('#loa').click();
        document.getElementById("lhis").setAttribute('class','active');
        


    });


  
    function dataLoad(){

        var oTable = $('#dd').DataTable();
        oTable.destroy();

        $('#dd').DataTable( {
            "ajax": "getLoaded-vehicles",
            "columns": [
                { "data": "id" },
                { "data": "vehicle_model" },
                { "data": "vehicle_number" },
                { "data": "vehicle_type" },
                { "data": "load_date" },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<span class="label label-primary">'+data.status+' </span>';
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

    function insert(){


        $.ajax({
            type: "get",
            url: 'insert-vehicles',
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
    function saveall(){

        $.ajax({
            type: "get",
            url: 'unloadall',
            data: $('#unloaded').serialize(),

            success : function(data){

                location.href="active-vehicles";


            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        });
        return false;
    }


</script>
@endsection