@extends('template.lecteur_template')
@section('contenue')
<div class="span11">
        <div class="content">
            <div class="module">

                <div class="module-head">
                        <p class="profile-brief">
                                <h3>Chers lecteur</h3>
                               Voici la liste des livres que vous avez emprunter. nous vous prions de respecter la date de retour des livres.</br>
                                Pour toute information supplementaire veillez nous joindre sur le <small style="color:blue">77 701 22 80 ou bayenguer79@gmail.com</small>
                            </p>


                    <div class="module-option clearfix">
                        <form>
                            <div class="input-append pull-left">
                                <input type="text" class="span3" placeholder="Filter by name..." style="height: 21px">
                                <button type="submit" class="btn">
                                    <i class="icon-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="module-body">
                        <div class="row-fluid">
                            <div class="span12">
                        </div>
                            </div>
                    <table class="table table-striped table-bordered table-condensed">
                      <thead>
                        <tr>
                          <th>Numero Inventaire</th>
                          <th>Titre Livre</th>
                          <th>Auteur Livre</th>
                        </tr>
                      </thead>
                        @if (session('success'))
                            <div class="alert alert-success ">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{session('success')}}
                            </div>
                        @endif
                        @foreach ($mes_emprunt as $mes_emprunt)

                                <?php  $auteur=DB::select('SELECT  * FROM auteurs WHERE id ='.$mes_emprunt->getLivre()->auteur_id);
                                ?>
                                @foreach ($auteur as $auteur)
                                    <tbody>
                                        <tr>
                                            <td>{{$mes_emprunt->getLivre()->num_inventaire_livre}}</td>
                                            <td>{{$mes_emprunt->getLivre()->titre_livre}}</td>
                                            <td>{{$auteur->prenom_auteur.' '.$auteur->nom_auteur}}</td>
                                        </tr>
                                    </tbody>
                               @endforeach
                       @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
