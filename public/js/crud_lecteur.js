$(function () {
       
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
  
  var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "/administrateur/lecteurs",
      columns: [
          {data: 'first_name', name: 'first_name'},
          {data: 'last_name', name: 'last_name'},
          {data: 'email' ,name: 'email'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });

 $('#createNewProduct').click(function (){ 
        $('#saveBtn').val("create-product");
        $('#product_id').val('');
        $('#productForm').trigger("reset");
        $('#modelHeading').html("Create New Product");
        $("#ajaxModel").modal({backdrop: false});
        $('#ajaxModel').modal('show');
    });
    
    $('body').on('click', '.editProduct', function () {
      var product_id = $(this).data('id');
      $.get('lecteurs/' + product_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Product");
          $("#ajaxModel").modal({backdrop: false});
          $('#ajaxModel').modal('show');
          $('#product_id').val(data.id);
          $('#first_name').val(data.first_name);
          $('#last_name').val(data.last_name);
          $('#date_naissance').val(data.date_naissance);
          $('#telephone').val(data.telephone);
          $('#email').val(data.email);
      })
   });
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
    
        $.ajax({
          data: $('#productForm').serialize(),
          url: "lecteurs",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $('#productForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
              let reponse =JSON.parse(data.responseText);
              let error = reponse.errors;
              $.each(error, function (index, value) { 
                  var input = '#productForm input[name=' + index + ']';
                  $(input +'+div').text(value);
                //   window.location.reload();
              });
          }
      });
    });
    
    $('body').on('click', '.deleteProduct', function () {
        var product_id = $(this).data("id");
        var conf = confirm("Êtes-vous sûr de vouloir supprimer!");
        if(!conf){
            e.preventDefault()
        }
        $.ajax({
            type: "DELETE",
            url: 'lecteurs/'+product_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });   
});