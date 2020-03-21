$(function(){
    $('#BtnModal').click(function() {
        $("#lecteur-modal").modal({
            backdrop: false
          });
        $('#lecteur-modal').modal('show');
    });
// ajouter un nouveau lecteur
    $('#addLecteur').on('submit', function(e){
        e.preventDefault();
        let $self = $(this);
        $.ajax({
            type: "POST",
            url: "/administrateur/ajout_lecteur",
            data: $self.serializeArray()
           
           })
        .done(function(){
          
            $('#addLecteur').find('input').val('');
            $('#lecteur-modal').modal('hide');
              $('.afficheSuccesMessages').prepend("<div class='alert alert-succes'>Vous avez ajouter un nouveau Lecteur</>" )
            var oTable = $('#laravel_datatable').dataTable();
            oTable.fnDraw(false);   
        })
        .fail(function(jqxhr){
            let reponse = JSON.parse(jqxhr.responseText);
            let error = reponse.errors;
            console.log(error);
            
            $.each(error, function (index, value) { 
                var input = '#addLecteur input[name=' + index + ']';
                $(input + '+div').text(value);
            });
        })
     
    });

    $('body').on('click', '.edit-post', function (e) {
    e.preventDefault();
    var lecteur_id = $(this).data('id');
    $.get('/administrateur/lecteur/'+lecteur_id +'/modifier', function (data) {
      $('#myModal').modal('show');
      console.log(data.id);
      
      // $.ajax({
      //   type: "",
      //   url:'/administrateur/lecteur/'+lecteur_id +'/modifier',
      //   data: "",
       
      // });
  })



});
// Ma table de donne pour afficher les lecteur
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'http://localhost:8000/administrateur/lister_datatable',
        columns: [
            {data: 'first_name'},
            {data: 'last_name'},
            {data: 'email'},
          //{ data: 'avatar', render: function( data, type, full, meta ) { return "<img src=\"/images/" + data + "\" height=\"10\"/>"; } },
            {data: 'action'},
            // {data: 'modifier'},
            // {data: 'supprimer'}
        ]
    });
    
        
    $('body').on('click', '#delete-post', function () {
        var lecteur_id = $(this).data("id");
        confirm("Are You sure want to delete !");
        $.ajax({
            type: "get",
            url: "/administrateur/lecteur/"+lecteur_id+"/delete",
            success: function (data) {
            $('.module-body').prepend("<div class='alert alert-succes'> Operation reussite</div>");
            var oTable = $('#laravel_datatable').dataTable(); 
            oTable.fnDraw(false);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        }); 
    });   
  });

    