@extends('master')





@section('heading')

Loading History


@endsection
@section('breadcrumb')


<li>
    <a href="#">Loading/Unloading</a>
</li>
<li class="active">
    <strong>Loading History</strong>
</li>


@endsection


@section('headerbuttons') 

<div class="col-md-6" hidden="true">
<input class="form-control" id="month" placeholder="YYYY/MM" value="{{date('Y-m')}}">
    </div>
<div class="col-md-6" hidden="true">

<button class="btn btn-block btn-primary"> Search </button>
</div>
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
                            <th>Vehicle Number</th>
                            <th>Load Date</th>
                            <th>Status</th>
                        
                            <th>Unloaded Date</th>
                          
                            <th class="col-md-2"></th>

                        </tr>
                    </thead>
                    <tbody>

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
        dataLoad();

        $('#month').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format:"yyyy-mm",
            minViewMode:1
        });

    });


  
    function dataLoad(){

        var oTable = $('#dd').DataTable();
        oTable.destroy();

        var month =  $('#month').val();
        
        $('#dd').DataTable( {
            "ajax": "search_load?date="+month,
            "columns": [
                { "data": "id" },
                { "data": "vnum" },
                { "data": "load_date" },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     if (data.status == 'ACTIVE'){
                       
                         
                          return '<span class="label label-success">'+data.status+' </span>';
                     }else{
                      return '<span class="label label-primary">'+data.status+' </span>';
                     }
                 }
                },
              { "data": "unload_date" },
                {"data" : null,
                 "mRender": function(data, type, full) {

                     
                     return '<a class="btn btn-primary  btn-animate btn-animate-side btn-block btn-sm" href="history-view?id='+data.id+'"> View </a>' ;
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
    function del(id){

        $.ajax({
            type: "get",
            url: 'del_vehicles',
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