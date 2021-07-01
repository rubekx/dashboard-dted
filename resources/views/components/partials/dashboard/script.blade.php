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