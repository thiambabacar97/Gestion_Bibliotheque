$(function(){ 
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url:  '/administrateur/livre/preter',
          type: 'GET',
         },
        columns:[
            {data: 'num_inventaire_livre'},
            {data: 'titre_livre'},
            {data: 'auteur'} ,
          
          //{ data: 'avatar', render: function( data, type, full, meta ) { return "<img src=\"/images/" + data + "\" height=\"10\"/>"; } },
            // {data: 'first_name'},
            {data: 'lecteur'},
            {data: 'dateEmprunt'},
            {data: 'dateRetour'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            // {data: 'supprimer'},
        ]
    })
    $('body').on('click', '.edit-post', function (e) {
        var livre_id = $(this).data("livre_id");
        var user_id = $(this).data("user_id");
        let conf = confirm("Êtes-vous sûr de vouloir Valider!");
        if(!conf){
            e.preventDefault()
        }
        $.ajax({
            type: "get",
            url:"/administrateur/livre/"+livre_id+"/rendre_livre"+user_id +"",
            success: function (data) {
                table.draw();
                $('.module-head').append("<div class='alert alert-success'>"+data+"</>" )                    
            },
            error: function (data) {
               console.log(data)
            }
        });
    })
    $('body').on('click', '#delete-post', function () {
        var livre_id = $(this).data("livre_id");
        var user_id = $(this).data("user_id");
        console.log(user_id);
        
        let conf = confirm("Êtes-vous sûr de vouloir Valider!");
        if(!conf){
            e.preventDefault()
        }
        $.ajax({
            type: "get",
            url:"/administrateur/livre/"+livre_id+"/renouveler_livre"+user_id +"",
            success: function (data) {
                table.draw();
                $('.module-head').append("<div class='alert alert-success'>"+data+"</>" )                    
            },
            error: function (data) {
               console.log(data)
            }
        });
    });    
 })