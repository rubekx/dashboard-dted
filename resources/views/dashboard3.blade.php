@php $ticketCreated = App\Http\Controllers\DashboardController::ticketCreated(); @endphp
@php $ticketsClosed = App\Http\Controllers\DashboardController::ticketsClosed(); @endphp
@php $ticketsReopened = App\Http\Controllers\DashboardController::ticketsReopened(); @endphp
@php $ticketsTransferred = App\Http\Controllers\DashboardController::ticketsTransferred(); @endphp
@php $ticketsOverdue = App\Http\Controllers\DashboardController::ticketsOverdue(); @endphp
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 xl:w-1/3 p-6 cursor-pointer" onclick="toggleModal('ticketCreated')">
            <div class=" bg-white border rounded p-5 bg-ost-blue">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-ost-blue">
                            <i class="fa fa-wallet fa-2x fa-fw fa-inverse"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-white">Criados</h5>
                        <h3 class="font-bold text-4xl text-white">{{count($ticketCreated)}}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 xl:w-1/3 p-6 cursor-pointer" onclick="toggleModal('ticketsClosed')">
            <!--Metric Card-->
            <div class="bg-white border rounded p-5 bg-ost-green">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-ost-green"><i class="fas fa-users fa-2x fa-fw fa-inverse"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-white">Fechados</h5>
                        <h3 class="font-bold text-4xl text-white">{{count($ticketsClosed)}}</h3>
                    </div>
                </div>
            </div>
            <!--/Metric Card-->
        </div>
        <div class="w-full md:w-1/2 xl:w-1/3 p-6 cursor-pointer" onclick="toggleModal('ticketsReopened')">
            <!--Metric Card-->
            <div class="bg-white border rounded bg-gray-400 p-5">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-gray-400"><i class="fas fa-user-plus fa-2x fa-fw fa-inverse"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-white">Reabertos</h5>
                        <h3 class="font-bold text-4xl text-white">{{count($ticketsReopened)}}</h3>
                    </div>
                </div>
            </div>
            <!--/Metric Card-->
        </div>
        <div class="w-full md:w-1/2 xl:w-1/3 p-6 cursor-pointer" onclick="toggleModal('ticketsTransferred')">
            <!--Metric Card-->
            <div class="bg-white border rounded bg-ost-yelow p-5">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-ost-yelow"><i class="fas fa-server fa-2x fa-fw fa-inverse"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-white">Transferidos</h5>
                        <h3 class="font-bold text-4xl text-white">{{count($ticketsTransferred)}}</h3>
                    </div>
                </div>
            </div>
            <!--/Metric Card-->
        </div>
        <div class="w-full md:w-1/2 xl:w-1/3 p-6 cursor-pointer" onclick="toggleModal('ticketsOverdue')">
            <!--Metric Card-->
            <div class="bg-white border rounded bg-ost-purple p-5">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-ost-purple"><i class="fas fa-tasks fa-2x fa-fw fa-inverse"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-white">Atrasados</h5>
                        <h3 class="font-bold text-4xl text-white">{{count($ticketsOverdue)}}</h3>
                    </div>
                </div>
            </div>
            <!--/Metric Card-->
        </div>
    </div>
    <div class="container">
        <h2>Modal Example</h2>
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
          Open modal
        </button>
      
        <!-- The Modal -->
        <div class="modal" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                Modal body..
              </div>
              
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
              
            </div>
          </div>
        </div>
        
      </div>

    <div class="container">
        <h1>Laravel 6 Ajax CRUD </h1>
        <a class="btn btn-success" href="javascript:void(0)" id="createNewCustomer"> Create New Customer</a>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="CustomerForm" name="CustomerForm" class="form-horizontal">
                       <input type="hidden" name="Customer_id" id="Customer_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Details</label>
                            <div class="col-sm-12">
                                <textarea id="detail" name="detail" required="" placeholder="Enter Details" class="form-control"></textarea>
                            </div>
                        </div>
    
                        <div class="col-sm-offset-2 col-sm-10">
                         <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                         </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        $(function () {
      
            $('#ajaxModel').on('shown.bs.modal', function() {
                console.log('chamou1');
            });
                  
            $('#myModal').on('shown.bs.modal', function() {
                console.log('chamou2');
            });

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
          });
      
          var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "",
              columns: [
                  {data: 'id', name: 'id'},
                  {data: 'chamado', name: 'chamado'},
                  {data: 'usuario', name: 'usuario'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
      
          $('#createNewCustomer').click(function () {
              $('#saveBtn').val("create-Customer");
              $('#Customer_id').val('');
              $('#CustomerForm').trigger("reset");
              $('#modelHeading').html("Create New Customer");
              $('#ajaxModel').modal('show');
          });
      
          $('body').on('click', '.editCustomer', function () {
            var Customer_id = $(this).data('id');
            $.get("" +'/' + Customer_id +'/edit', function (data) {
                $('#modelHeading').html("Edit Customer");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel').modal('show');
                $('#Customer_id').val(data.id);
                $('#name').val(data.name);
                $('#detail').val(data.detail);
            })
         });
      
          $('#saveBtn').click(function (e) {
              e.preventDefault();
              $(this).html('Sending..');
      
              $.ajax({
                data: $('#CustomerForm').serialize(),
                url: "",
                type: "POST",
                dataType: 'json',
                success: function (data) {
      
                    $('#CustomerForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
      
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
          });
      
          $('body').on('click', '.deleteCustomer', function () {
      
              var Customer_id = $(this).data("id");
              confirm("Are You sure want to delete !");
      
              $.ajax({
                  type: "DELETE",
                  url: ""+'/'+Customer_id,
                  success: function (data) {
                      table.draw();
                  },
                  error: function (data) {
                      console.log('Error:', data);
                  }
              });
          });
      
        });
      </script>