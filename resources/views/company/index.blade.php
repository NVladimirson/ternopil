@extends('layouts.main')
@section('content')
<div id="layoutSidenav_content">
   <main>
      <div class="container-fluid">
         <div class="card mb-4">
            <div class="card-header">
               <i class="fas fa-table mr-1"></i>
               Компании
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
               <p>{{ $message }}</p>
            </div>
            @endif
            @if ($errors->any())
        <div class="alert alert-danger">
            <!-- <strong>Whoops!</strong> There were some problems with your input.<br><br> -->
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
            <div class="card-body">
               <div class="row">
               
                  <div class="col-xs-6 col-sm-6 col-md-6">
                     <a href="{{route('companies.create')}}" class="btn btn-primary">Создать компанию</a>
                  </div>
                  
                  
                  
                  <div class="col-xs-6 col-sm-6 col-md-6 text-right">

                  </div>
                 
               </div>
               <div class="table-responsive">
                  <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th>Навание компании</th>
                           <th>Email</th>
                           <th>Логотип</th>
                           <th>Дата создания</th>
                           <th>Дата изменения</th>
                           <th>Действия</th>                         
                        </tr>
                     </thead>
                     <tfoot>
                        <tr>
                           <th>Навание компании</th>
                           <th>Email</th>
                           <th>Логотип</th>
                           <th>Дата создания</th>
                           <th>Дата изменения</th>
                           <th>Действия</th>   
                        </tr>
                     </tfoot>
                     <tbody>

                     </tbody>
                  </table>
               </div>
               <div>
                  <div class="row">
                     <div class="col-md-6">

                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </main>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/js/bootstrap-datetimepicker.min.js"></script>
<script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
  <script src="/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="/assets/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
  <script src="/assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js"></script>
  <script src="/assets/plugins/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="/assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="/assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
<script>
   jQuery(function($) {
      window.table = $('#datatable').DataTable( {
      "ajax": {
         "url" : "{!! route('companies.datatable') !!}",
      },
      "serverSide": true,
      "columns": [
         { "data": "title" },
         { "data": "email" },
         { "data": "logo" },
         { "data": "created_at" },
         { "data": "updated_at" },
         { "data": "actions" },
      ],
      "order": [[1, 'asc']], 
      } );
   } );

   $(document).ready( function () {
       
    $('#dataTable').DataTable(
        {
            "paging": false,
            "searching" : false,
            "order": [ 3, 'desc' ]
        }
   
    );
   
    function delete_firm(firm){
    var token = $("meta[name='csrf-token']").attr("content");
    let url = "{{route('companies.index')}}"+"/"+firm;
        
    $.ajax({
        type: "POST",
        data:{
         _method:"DELETE",
         "_token": "{{ csrf_token() }}",
         "id": firm
        },
        url: url,
        success: function(response){
           console.log(response);
             alert('Компания '+response['name'] +' ( Удаленные пользователи: ' + response['deleted_employees'] +' )' + 'удалена.')
             document.location.reload();
        }
    });
    };
    $(document).on("click", ".delete-company", function(e){
      let company_id = $(this)[0].id;
      delete_firm(company_id);
   });
   //  $('.delete-firm').click(function ()  {
   //      delete_firm($(this).attr('id'));
   // });     
   
   } );
</script>