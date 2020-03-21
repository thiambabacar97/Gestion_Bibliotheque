$(function () {
    // let path = "{{route('livre.search')}}";
    // $('input #filter').filter({
    //     source:function (query, process) { 
    //         return $.get(path, {query:name},function (data) {
    //                 return process(data);
    //             });
    //      }
    // });
    // $('#listLivre').on('click', function(e){
    //     e.preventDefault();
    //     let $self = $(this);
    //     let url = $self.attr('href')
    //     $.ajax({
    //         type: "GET",
    //         url: url,
           
    //     })
    //     .done(function(jqxhr,data){
    //         // window.location.replace(url);
    //         // $('#content').html(jqxhr)
    //         let rep =jqxhr.data;
    //         $.each(rep, function (i, v) {
    //             $('#titre').append("<div class='span5'> <div class='media user'><a class='media-avatarcopie  pull-left' > <img src='{{ asset('images/"+v.couverture_livre+" ') }}'></a><div class='media-body'><h3 class='media-title'><p><strong style='color:#248aaf'><u>Titre</u></strong><small class='muted'>:" +v.titre_livre+"</small></p></h3><h3 class='media-title'> <p><strong style='color:#248aaf'><u>Auteur</u></strong><small class='muted'>:"+v.auteur_id+"</small></p></h3> </div</div></div></div>");
            
    //             // titre.text=;
    //             // console.log(v.titre_livre);
    //         });
           
            
           
    //     })
    //     .fail(function(jqxhr){
    //        console.log('errreurr');
           
    //     })
    // });
})