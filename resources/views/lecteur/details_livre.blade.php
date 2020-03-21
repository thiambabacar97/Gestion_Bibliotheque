@extends('template.lecteur_template')
@section('contenue')

    <div class="container">
            <div class="span11">
                    <div class="content">
                        <div class="module">
                            <div class="module-head">
                                <h3>Detail du livre</h3>
                            </div>
                            <div class="module-option clearfix">
                                <form>
                                <div class="input-append pull-left">
                                    <input type="text" class="span3" placeholder="Filter by name...">
                                    <button type="submit" class="btn">
                                        <i class="icon-search"></i>
                                    </button>
                                </div>
                                </form>
                                <div class="input-append pull-right">
                                  <a href="{{ route('retourner') }}" class="btn btn-primary">Retour</a>
                                </div>
                            </div>
                            <div class="module-body">
                                <div class="row-fluid">
                                    <div class="span12">
                                            @if (session('error'))
                                            <div class="alert alert-danger ">
                                              <button type="button" class="close" data-dismiss="alert">×</button>
                                                  {{session('error')}}
                                              </div>
                                            @endif
                                            @if (session('errorr'))
                                            <div class="alert alert-danger ">
                                              <button type="button" class="close" data-dismiss="alert">×</button>
                                                  {{session('errorr')}}
                                              </div>
                                            @endif

                                            @if (session('success'))
                                            <div class="alert alert-success ">
                                               <button type="button" class="close" data-dismiss="alert">×</button>
                                               {{session('success')}}
                                            </div>
                                            @endif
                                                <div class="media user">
                                                    <a class="media-avatarcopiee pull-left">
                                                        <img src="{{ asset('images/'.$livre->couverture_livre) }}">
                                                    </a>
                                                    <div class="media-body">
                                                        <p class="media-title">
                                                            <strong style="color:#248aaf"><u>Numero Inventaire</u></strong> : {{$livre->num_inventaire_livre}}
                                                        </p>
                                                        <p class="media-title">
                                                            <strong style="color:#248aaf"><u>Titre</u></strong> : {{$livre->titre_livre}}
                                                        </p>
                                                        <p class="media-title">
                                                            <strong style="color:#248aaf"><u>Auteur</u></strong> : {{$livre->auteur->prenom_auteur.' '.$livre->auteur->nom_auteur}}
                                                        </p>
                                                        <p class="media-title">
                                                            <strong style="color:#248aaf"><u>Domaine</u></strong> : {{$livre->domaine->description_domaine}}
                                                        </p>
                                                        <p class="media-title">
                                                            <strong style="color:#248aaf"><u>Maison d'édition</u></strong> : {{$livre->editeur_livre}}
                                                        </p>
                                                        <p class="media-title">
                                                            <strong style="color:#248aaf"><u>Date publication</u></strong> : {{$livre->date_pub_livre}}
                                                        </p>
                                                        <p class="media-title">
                                                            <strong style="color:#248aaf"><u>Nature </u></strong> : {{$livre->nature_livre}}
                                                        </p>
                                                        <p class="media-title">
                                                            <strong style="color:#248aaf"><u>Nombre Exemplaire </u></strong> : {{$livre->nbr_exemplaire_livre}}
                                                        </p>
                                                        <p class="media-title">
                                                            <strong style="color:#248aaf"><u>ISBN/ISSN </u></strong> : {{$livre->isbn_issn_livre}}
                                                        </p>
                                                        <p class="media-title">
                                                            <a  href="{{ route('lecteur.livre.emprunter', ['id'=>$livre->id]) }}" class="btn btn-primary emprunt">Emprunter</a>
                                                            <a  href="{{ route('lecteur.livre.reserver', ['id'=>$livre->id]) }}" class="btn btn-primary reserver">Resever</a>
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                    </div>
                                </div>
                                <!--/.row-fluid-->
                                <br />

                            </div>
                        </div>
                    </div>
                    <!--/.content-->
                </div>
    </div>

    <script>
    var emprunter = document.querySelectorAll('.emprunt')
           for (let index = 0; index < emprunter.length; index++) {
               const link = emprunter[index];
               link.addEventListener('click', function(e){
                   let conf = confirm('Voulez vous vraiment emprunter cet livre ?')
                   if(!conf){
                       e.preventDefault()
                       alert("Vous avez annuler l'action")
                   }

               })
           }

           var reservation = document.querySelectorAll('.reserver')
           for (let index = 0; index < reservation.length; index++) {
               const link = reservation[index];
               link.addEventListener('click', function(e){
                   let conf = confirm('Voulez vous vraiment reserver cet livre ?')
                   if(!conf){
                       e.preventDefault()
                       alert("Vous avez annuler l'action")
                   }

               })
           }
    </script>
@endsection
