$(function(){
   $('#reserver').on('submit', function(e){
      e.preventDefault();
      let $self = $(this);
      let url   = $self.attr('action');
      $.ajax({
         type: "POST",
         url: url,
         data: $self.serializeArray()
      })
      .done(function(jqxhr){
         console.log(jqxhr);
         
         $('.row-fluid').prepend(jqxhr);
         $self.find('input').val('');
         $('#reservation-modal').modal('hide')
         
      })
      .fail(function(jqxhr){
        
         let reponse =JSON.parse(jqxhr.responseText);
         let error = reponse.errors;
         $.each(error, function (index, value) {
           $('small').text(value);
      });
     });
    
     
});
})