// $(function(){
    
// $('#listLecteur').on('click', function(e){
//     e.preventDefault();
//     let $self = $(this);
//     let url = $self.attr('href')
//     $.ajax({
//         type: "GET",
//         url: url
//     })
//     .done(function(jqxhr,data){
//         let donne=jqxhr.data;
//         $.each(donne, function (i, v) { 
//         $('.row-fluid').append("<div class='span5'><div class='media user'><a class='media-avatar  pull-left' href='#'><img src='/images/" +v.avatar +"' ></a><div class='media-body'><h3 class='media-title'>:"+v.first_name+''+v.first_name+" ")
//             console.log(v);
//         });
       
        
//         //  window.location.href = url; 
//         // window.location.replace(url);
//         // $('#content').html(jqxhr)
       
//     })
//     .fail(function(jqxhr){
//         window.location.href = 'http://localhost:8000/administrateur/noteFoundPage'; 
//     })
// });

// $('#detail').on('click',function(e) {
//     e.preventDefault();
//     $self = $(this);
//     let url = $self.attr('href');
//      $.ajax({
//          type: "GET",
//          url: url,
//      })
//      .done(function (jqxhr) {
//         window.location.href = url; 
//         // window.location.replace(url);
//         // $('#content').html(jqxhr)
//      })
//      .fail(function () {
//        window.location.href = 'http://localhost:8000/administrateur/noteFoundPage'; 
//      })
// })

// })
// <div class="content">
// <div class="module">
//     <div class="module-head">
//         <h3>Tables</h3>
//     </div>
//     <div class="module-body">
//         <table class="table table-bordered" id="table">
//             <thead>
//                <tr>
//                   <th>Id</th>
//                   <th>Name</th>
//                   <th>Email</th>
//                </tr>
//             </thead>
//         </table>
//     </div>
// </div>  
// </div>