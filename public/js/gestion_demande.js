$(function(){

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url:  '/administrateur/livre/demande',
          type: 'GET',
         },
        columns:[
            {data: 'num_inventaire_livre'},
            {data: 'titre_livre'},
            {data: 'auteur'} ,
          //{ data: 'avatar', render: function( data, type, full, meta ) { return "<img src=\"/images/" + data + "\" height=\"10\"/>"; } },
            {data: 'lecteur'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            // {data: 'supprimer'},
        ]
        
    });
        $('body').on('click', '#delete-post', function (e) {
        var livre_id = $(this).data("livre_id");
        var user_id = $(this).data("user_id");
        let conf = confirm("Êtes-vous sûr de vouloir Rejeter!");
        if(!conf){
            e.preventDefault()
        }
        $.ajax({
            type: "get",
            url:livre_id+"/rejeter_emprunt"+user_id +"",
            success: function (data) {
                table.draw();
                $('.module-head').append("<div class='alert alert-succes'>emrumprent rejeter</>" )                  
            },
            error: function (data) {
                alert('quelle que chose a mal fonctione')
            }
        });
      
        });
   
    $('body').on('click', '.edit-post', function (e) {
        var livre_id = $(this).data("livre_id");
        var user_id = $(this).data("user_id");
        let conf = confirm("Êtes-vous sûr de vouloir Valider!");
        if(!conf){
            e.preventDefault()
        }
        $.ajax({
            type: "get",
            url:"/administrateur/livre/"+livre_id+"/valider"+user_id +"",
            success: function (data) {
                console.log(data)
                table.draw();
                if (data =="Operation reussite") {
                    $('.module-head').append("<div class='alert alert-success'>"+data+"</>" )       
                }else{
                    $('.module-head').append("<div class='alert alert-danger'>"+data+"</>" ) 
                }
                                  
            },
            error: function (data) {
               console.log(data)
            }
        });
    })
  })    