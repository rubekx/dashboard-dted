<script type="text/javascript">
    $(function () {

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        $('#modalTicketsCreated').on('shown.bs.modal', function() {
            var table = $('#tableTicketsCreated').DataTable({
                "lengthMenu": [ 5,10, 25, 50, 100 ],
                // responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('dashboard.tickets.table').'?type=1' }}",
                },
                columns: [
                    {data: 'ticket_id', name: 'ticket_id'},
                    {data: 'chamado', name: 'chamado'},
                    {data: 'usuario', name: 'usuario'},
                    {data: 'email', name: 'email'},
                    {data: 'telefone', name: 'telefone'},
                    {data: 'curso', name: 'curso'},
                    {data: 'assunto', name: 'assunto'},
                    {data: 'status_evento', name: 'status_evento'},
                    {data: 'ultima_atualizacao', name: 'ultima_atualizacao'},
                    {data: 'status_chamado', name: 'status_chamado'},
                    {data: 'envio', name: 'envio'},
                //   {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
        $('#modalTicketsCreated').on('hide.bs.modal', function (e) {
            var table = $('#tableTicketsCreated').DataTable()
            table.destroy();
        });
              
        $('#modalTicketsClosed').on('shown.bs.modal', function() {
            var table = $('#tableTicketsClosed').DataTable({
                "lengthMenu": [ 5,10, 25, 50, 100 ],
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('dashboard.tickets.table').'?type=2' }}",
                },
                columns: [
                    {data: 'ticket_id', name: 'ticket_id'},
                    {data: 'chamado', name: 'chamado'},
                    {data: 'usuario', name: 'usuario'},
                    {data: 'email', name: 'email'},
                    {data: 'telefone', name: 'telefone'},
                    {data: 'curso', name: 'curso'},
                    {data: 'assunto', name: 'assunto'},
                    {data: 'status_evento', name: 'status_evento'},
                    {data: 'ultima_atualizacao', name: 'ultima_atualizacao'},
                    {data: 'status_chamado', name: 'status_chamado'},
                    {data: 'envio', name: 'envio'},
                ]
            });
        });
        $('#modalTicketsClosed').on('hide.bs.modal', function (e) {
            var table = $('#tableTicketsClosed').DataTable()
            table.destroy();
        });

        $('#modalTicketsReopened').on('shown.bs.modal', function() {
            var table = $('#tableTicketsReopened').DataTable({
                "lengthMenu": [ 5,10, 25, 50, 100 ],
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('dashboard.tickets.table').'?type=3' }}",
                },
                columns: [
                    {data: 'ticket_id', name: 'ticket_id'},
                    {data: 'chamado', name: 'chamado'},
                    {data: 'usuario', name: 'usuario'},
                    {data: 'email', name: 'email'},
                    {data: 'telefone', name: 'telefone'},
                    {data: 'curso', name: 'curso'},
                    {data: 'assunto', name: 'assunto'},
                    {data: 'status_evento', name: 'status_evento'},
                    {data: 'ultima_atualizacao', name: 'ultima_atualizacao'},
                    {data: 'status_chamado', name: 'status_chamado'},
                    {data: 'envio', name: 'envio'},
                ]
            });
        });
        $('#modalTicketsReopened').on('hide.bs.modal', function (e) {
            var table = $('#tableTicketsReopened').DataTable()
            table.destroy();
        });

        $('#modalTicketsTransferred').on('shown.bs.modal', function() {
            var table = $('#tableTicketsTransferred').DataTable({
                "lengthMenu": [ 5,10, 25, 50, 100 ],
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('dashboard.tickets.table').'?type=4' }}",
                },
                columns: [
                    {data: 'ticket_id', name: 'ticket_id'},
                    {data: 'chamado', name: 'chamado'},
                    {data: 'usuario', name: 'usuario'},
                    {data: 'email', name: 'email'},
                    {data: 'telefone', name: 'telefone'},
                    {data: 'curso', name: 'curso'},
                    {data: 'assunto', name: 'assunto'},
                    {data: 'status_evento', name: 'status_evento'},
                    {data: 'ultima_atualizacao', name: 'ultima_atualizacao'},
                    {data: 'status_chamado', name: 'status_chamado'},
                    {data: 'envio', name: 'envio'},
                ]
            });
        });
        $('#modalTicketsTransferred').on('hide.bs.modal', function (e) {
            var table = $('#tableTicketsTransferred').DataTable()
            table.destroy();
        });

        $('#modalTicketsOverdue').on('shown.bs.modal', function() {
            var table = $('#tableTicketsOverdue').DataTable({
                "lengthMenu": [ 5,10, 25, 50, 100 ],
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('dashboard.tickets.table').'?type=5' }}",
                },
                columns: [
                    {data: 'ticket_id', name: 'ticket_id'},
                    {data: 'chamado', name: 'chamado'},
                    {data: 'usuario', name: 'usuario'},
                    {data: 'email', name: 'email'},
                    {data: 'telefone', name: 'telefone'},
                    {data: 'curso', name: 'curso'},
                    {data: 'assunto', name: 'assunto'},
                    {data: 'status_evento', name: 'status_evento'},
                    {data: 'ultima_atualizacao', name: 'ultima_atualizacao'},
                    {data: 'status_chamado', name: 'status_chamado'},
                    {data: 'envio', name: 'envio'},
                ]
            });
        });
        $('#modalTicketsOverdue').on('hide.bs.modal', function (e) {
            var table = $('#tableTicketsOverdue').DataTable()
            table.destroy();
        });


  
        
  
        // $('#createNewCustomer').click(function () {
        //     $('#saveBtn').val("create-Customer");
        //     $('#Customer_id').val('');
        //     $('#CustomerForm').trigger("reset");
        //     $('#modelHeading').html("Create New Customer");
        //     $('#ajaxModel').modal('show');
        // });

        // $('body').on('click', '.editCustomer', function () {
        //     var Customer_id = $(this).data('id');
        //     $.get("" +'/' + Customer_id +'/edit', function (data) {
        //         $('#modelHeading').html("Edit Customer");
        //         $('#saveBtn').val("edit-user");
        //         $('#ajaxModel').modal('show');
        //         $('#Customer_id').val(data.id);
        //         $('#name').val(data.name);
        //         $('#detail').val(data.detail);
        //     })
        // });

        // $('#saveBtn').click(function (e) {
        //   e.preventDefault();
        //   $(this).html('Sending..');
  
        //   $.ajax({
        //     data: $('#CustomerForm').serialize(),
        //     url: "",
        //     type: "POST",
        //     dataType: 'json',
        //         success: function (data) {
    
        //             $('#CustomerForm').trigger("reset");
        //             $('#ajaxModel').modal('hide');
        //             table.draw();
    
        //         },
        //         error: function (data) {
        //             console.log('Error:', data);
        //             $('#saveBtn').html('Save Changes');
        //         }
        //     });
        // });  
    });
</script>