@extends('master')





@section('heading')


Unload Vehicle | <span class="label label-success">{{$vehicle->vehicle_model}}</span> <span class="label label-primary">{{$vehicle->vehicle_number}}</span> <span class="label label-info text-uppercase">{{$vehicle->vehicle_type}}</span> <span class="label label-danger text-uppercase"> Loaded Date : {{$loadMain->load_date}}</span>


@endsection
@section('breadcrumb')


<li>
    <a href="#">Loading/Unloading</a>
</li>

<li>
    <a href="active-vehicles">Active Vehicles</a>
</li>

<li class="active">
    <strong>Unload Vehicle</strong>
</li>


@endsection


@section('headerbuttons') 
@endsection






@section('content')

<br>
<form id="unloaded" onsubmit="return saveall()">
    
    
    <input type="hidden" value="{{$loadMain->id}}" name="loadMainId">
    <input type="hidden" value="{{$vehicle->id}}" name="vehicleId">
    
<div class="row" style="padding:0cm">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">

            <div class="ibox-content">

               
                
                           <div class="form-group" >

                 
                               <div class="col-md-2">
                        <label class="control-label pull-right" style="margin-top:5%">Unload Date </label>
                                   
                                   </div>

                        <div class="col-md-3">

                            <input name="uDate" id="uDate" type="text" placeholder="Sales Date" class="form-control" required value="{{date('Y-m-d')}}">
                        </div>
                               <br>

                    </div>
                
                
                
                
                
                <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" style="margin-top:3%" >
                    <thead>
                        <tr>

                            <th>#</th>
                            
                            <th>Product Name</th>
                            <th>Quantity Loaded</th>
                            <th>Unload Qunatity</th>
                            <th>Remarks</th>

                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php $count = 0; ?>
                        @foreach($loadItems as $l)
                        <tr>
                            <td>{{$count + 1}}</td>
                        <td> {{ $l->pro_name }}</td>
                             <td> {{ $l->number }}</td>
                        <td><input type="number"  placeholder="Unload Quantity" min = "0" class="form-control" name="unload{{$count}}" required   value=" "></td><!--{{ $l->number }} -->
                        
                        <td><input type="text" placeholder="Any Remarks?"  class="form-control" name="remarks{{$count}}"></td>
                        <input type="hidden" value="{{$l->stock_id}}" name="stock{{$count}}">
                        <input type="hidden" value="{{$l->id}}" name="loadItemId{{$count}}">
                        </tr>
                        
                         <?php $count++; ?>
                        
                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>
 <input type="hidden" value="{{$count}}" name="countInfo">
    
<div class="col-md-offset-9 col-md-3">


    <button class="btn btn-primary btn-block"  type="submit"> Save</button>

</div>
</form>
 


@endsection



@section('js')


<script>


    $('document').ready(function(){


        //document.getElementById("man").setAttribute('class','active');
        // document.getElementById("man").click();
        $('#loa').click();
        document.getElementById("act").setAttribute('class','active');
        
          $('#uDate').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format:"yyyy-mm-dd"
        });

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