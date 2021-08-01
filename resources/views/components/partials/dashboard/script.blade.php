<script type="text/javascript">
    $(function () {

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        $('#modalTicketsCreated').on('shown.bs.modal', function() {
            var table = $('#tableTicketsCreated').DataTable({
                "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "Todos"]],
                responsive: true,
                ////  dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel'
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('dashboard.tickets.table').'?type=1' }}",
                },
                columns: [
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    // {data: 'ticket_id', name: 'ticket_id'},
                    {data: 'chamado', name: 'chamado'},
                    {data: 'usuario', name: 'usuario'},
                    {data: 'email', name: 'email'},
                    {data: 'telefone', name: 'telefone'},                  
                    {data: 'departamento', name: 'departamento'},
                    {data: 'staff', name: 'staff'},
                    {data: 'assunto', name: 'assunto'},
                    {data: 'status_evento', name: 'status_evento'},
                    {data: 'ultima_atualizacao', name: 'ultima_atualizacao'},
                    {data: 'status_chamado', name: 'status_chamado'},
                    {data: 'envio', name: 'envio'},
                ]
            });
        });
        $('#modalTicketsCreated').on('hide.bs.modal', function (e) {
            var table = $('#tableTicketsCreated').DataTable()
            table.destroy();
        });
              
        $('#modalTicketsClosed').on('shown.bs.modal', function() {
            var table = $('#tableTicketsClosed').DataTable({
                "lengthMenu": [5,10, 25, 50, 100 ],
               //  dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel'
                ],
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('dashboard.tickets.table').'?type=2' }}",
                },
                columns: [
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    // {data: 'ticket_id', name: 'ticket_id'},
                    {data: 'chamado', name: 'chamado'},
                    {data: 'usuario', name: 'usuario'},
                    {data: 'email', name: 'email'},
                    {data: 'telefone', name: 'telefone'},
                    {data: 'staff', name: 'staff'},
                    {data: 'assunto', name: 'assunto'},
                    // {data: 'curso', name: 'curso'},
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
               //  dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel'
                ],
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('dashboard.tickets.table').'?type=3' }}",
                },
                columns: [
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    // {data: 'ticket_id', name: 'ticket_id'},
                    {data: 'chamado', name: 'chamado'},
                    {data: 'usuario', name: 'usuario'},
                    {data: 'email', name: 'email'},
                    {data: 'telefone', name: 'telefone'},
                    {data: 'staff', name: 'staff'},
                    {data: 'assunto', name: 'assunto'},
                    // {data: 'curso', name: 'curso'},
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
               //  dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel'
                ],
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('dashboard.tickets.table').'?type=4' }}",
                },
                columns: [
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    // {data: 'ticket_id', name: 'ticket_id'},
                    {data: 'chamado', name: 'chamado'},
                    {data: 'usuario', name: 'usuario'},
                    {data: 'email', name: 'email'},
                    {data: 'telefone', name: 'telefone'},                  
                    {data: 'departamento', name: 'departamento'},
                    {data: 'staff', name: 'staff'},
                    // {data: 'curso', name: 'curso'},
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
               //  dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel'
                ],
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('dashboard.tickets.table').'?type=5' }}",
                },
                columns: [                    
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    // {data: 'ticket_id', name: 'ticket_id'},
                    {data: 'chamado', name: 'chamado'},
                    {data: 'usuario', name: 'usuario'},
                    {data: 'email', name: 'email'},
                    {data: 'telefone', name: 'telefone'},
                    {data: 'departamento', name: 'departamento'},
                    {data: 'staff', name: 'staff'},
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

        $('#modalTicketsOpened').on('shown.bs.modal', function() {
                var table = $('#tableTicketsOpened').DataTable({
                "lengthMenu": [ 5,10, 25, 50, 100 ],
            //  dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel'
                ],
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('dashboard.tickets.table').'?type=6' }}",
                },
                columns: [
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    // {data: 'ticket_id', name: 'ticket_id'},
                    {data: 'chamado', name: 'chamado'},
                    {data: 'usuario', name: 'usuario'},
                    {data: 'email', name: 'email'},
                    {data: 'telefone', name: 'telefone'},
                    {data: 'departamento', name: 'departamento'},
                    {data: 'staff', name: 'staff'},
                    {data: 'assunto', name: 'assunto'},
                    {data: 'status_evento', name: 'status_evento'},
                    {data: 'ultima_atualizacao', name: 'ultima_atualizacao'},
                    {data: 'status_chamado', name: 'status_chamado'},
                    {data: 'envio', name: 'envio'},
                ]
            });
        });
        $('#modalTicketsOpened').on('hide.bs.modal', function (e) {
            var table = $('#tableTicketsOpened').DataTable()
            table.destroy();
        });

        $('body').on('click', '.showMessages', function () {
            var thread_id = $(this).data('id');
            let url = "{{ route('dashboard.thread.entry', ':thread_id') }}";
            url = url.replace(':thread_id', thread_id);
            $.get(url, function(data, status){
                $('#contentThreadEntry').html(data);
            });
            $("#modalThreadEntry").modal("show");
        });
        
    });
</script>