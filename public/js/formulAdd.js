$(function () {
    $('#btnModal').click(function() {
        $("#contact-modal").modal({
            backdrop: false
          });
        $('#contact-modal').modal('show')
        })

    $('#BtnModal').click(function() {

            $("#lecteur-modal").modal({
                backdrop: false
              });
            $('#lecteur-modal').modal('show')
            })
            
    $('#addAdmin').on('submit', function(e){
                e.preventDefault();
                
                let url = $('#addAdmin').attr('action');
                let $self = $(this);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $self.serializeArray()
                   
                   })
                .done(function(){
                    $('.module-body').prepend("<div class='alert alert-succes'>Vous avez ajouter un nouveau Bibliothecaire</>" )
                    $('#addAdmin').find('input').val('');
                    $('#btnModal').modal('hide');
                    
                })
                .fail(function(jqxhr){
                    console.log('tt');
                    
                    let reponse = JSON.parse(jqxhr.responseText);
                    let error = reponse.errors;
                    $.each(error, function (index, value) { 
                        var input = '#addAdmin input[name=' + index + ']';
                        $(input + '+small').text(value);
                    });
                   
                })
             
    });
  
    $('#addAuteur').on('submit', function(e){
        e.preventDefault();
        let $self = $(this)
        let url = $self.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: $self.serializeArray()
    })
        .done(function(jqxhr){
            $('.module-body').prepend("<div class='alert alert-succes'> Vous avez ajouter un nouvau Auteur</div>");
            $self.find('input').val('');
        })
        .fail(function(jqxhr){
            let reponse =JSON.parse(jqxhr.responseText);
            let error = reponse.errors;
            $.each(error, function (index, value) { 
                var input = '#addAuteur input[name=' + index + ']';
                $(input + '+div').text(value);
                window.location.reload();
            });
        });
    })
    $('#addDomaine').on('submit', function(e){
        e.preventDefault();
        let $self = $(this)
        let url = $self.attr('action');
        $.post(url, $self.serializeArray())
        .done(function(jqxhr){
            $('#sms_info').prepend("<div class='alert alert-success '> Vous avez ajouter un nouveau Domaine</div>");
            $self.find('input').val('');
        })
        .fail(function(jqxhr){
            let reponse =JSON.parse(jqxhr.responseText);
            let error = reponse.errors;
            $.each(error, function (index, value) { 
                var input = '#addDomaine input[name=' + index + ']';
                $(input +'+div').text(value);
                window.location.reload();
            });
        
            
        });
        
        
        
    })
    $('#addMemoire').on('submit', function(e){
        e.preventDefault();
        let $self = $(this)
        let url = $self.attr('action');
        $.post(url, $self.serializeArray())
        .done(function(jqxhr){
            $('.module-body').prepend("<div class='alert alert-succes'> Vous avez ajouter un nouvau Memoire</div>");
            $self.find('input').val('');
            $self.find('select').val('');
        })
        .fail(function(jqxhr){
            let reponse =JSON.parse(jqxhr.responseText);
            let error = reponse.errors;
            $.each(error, function (index, value) { 
                var input = '#addMemoire input[name=' + index + ']';
                $(input +'+div').text(value);
                var select = '#addMemoire select[name=' + index + ']';
                $(select +'+div').text(value);
                window.location.reload();
            });
        
            
        });
        
        
        
    })
    $('#addEtudiant').on('submit', function(e){
        e.preventDefault();
        let $self = $(this)
        let url = $self.attr('action');
        $.post(url, $self.serializeArray())
        .done(function(jqxhr){
            $('.module-body').prepend("<div class='alert alert-succes'> Vous avez ajouter un nouvau Etudiant</div>");
            $self.find('input').val('');
            $self.find('select').val('');
        })
        .fail(function(jqxhr){
            let reponse =JSON.parse(jqxhr.responseText);
            let error = reponse.errors;
            $.each(error, function (index, value) { 
                var input = '#addEtudiant input[name=' + index + ']';
                $(input +'+div').text(value);
                window.location.reload();
                
            });
        
            
        });
        
        
        
    })

});