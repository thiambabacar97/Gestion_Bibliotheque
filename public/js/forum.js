function toggleFormulaire(id) {
    let element = document.getElementById('reponseForm-'+id) ;
    element.classList.toggle('form_content');
    }
$(function(){   
    
    $('#addcomment').click(function() {
        $("#contact-modal").modal({
            backdrop: false
          });
          $('form  #add_message').on('submit', function(e){
            e.preventDefault();
            let $self = $(this)
            let url = $self.attr('action');
            console.log(url);
            
            $.post(url, $self.serializeArray())
            .done(function(jqxhr){
               console.log(jqxhr)
            })
            .fail(function(jqxhr){
              console.log(jqxhr);
              
            }); 
        })
        $('#contact-modal').modal('show')
        })

    $('#contactForm').on('submit', function(e){
            e.preventDefault();
            let $self = $(this)
            let url = $self.attr('action');
            console.log(url);
            
            $.post(url, $self.serializeArray())
            .done(function(jqxhr){
                $self.find('textarea ').val('');
            })
            .fail(function(jqxhr){
                let reponse =JSON.parse(jqxhr.responseText);
                let error = reponse.errors;
                $.each(error, function (index, value) { 
                    $('#addComments').text(value);
                    console.log(value);
                    window.location.reload();
                });
            }); 
    })
    $('.maReponse').on('submit', function(e){
        e.preventDefault();
        let $self = $(this)
        let url = $self.attr('action');
        console.log(url);
        
        $.post(url, $self.serializeArray())
        .done(function(jqxhr){
            $self.find('textarea ').val('');
        })
        .fail(function(jqxhr){
            let reponse =JSON.parse(jqxhr.responseText);
            let error = reponse.errors;
            $.each(error, function (index, value) { 
                $('#reponseComments').text(value);
                console.log(value);
                // window.location.reload();
            });
        }); 
    })

 })


