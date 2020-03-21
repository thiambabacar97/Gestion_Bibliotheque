$(document).ready(function (e) {
              
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#image').change(function(){
      
        let reader = new FileReader();
        reader.onload = (e) => { 
          $('#image_preview_container').attr('src', e.target.result); 
        }
        reader.readAsDataURL(this.files[0]); 

    });

    $('#addLivre').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: '/administrateur/ajout_livre',
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
                $(this).find('input').val('');
                window.location.reload();
                $('.module-body').prepend('<div class="alert alert-success"> Vous avez ajouter un nouveau Administrateur</div>');
            },
            error: function(data){
                let test =JSON.parse(data.responseText)
                let test1 = test.errors
                $.each(test1, function (i, v) {
                    var input = '#addLivre input[name=' + i + ']';
                    $(input + '+div').text(v);
                    var select = '#addLivre select[name=' + i + ']';
                    window.location.reload();   
                    $(select + '+div').text(v);             
                });
            }
        });
    });
    
});
