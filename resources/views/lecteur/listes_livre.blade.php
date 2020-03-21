@extends('template.lecteur_template')
@section('contenue')
 <div class="container">
        <div class="span11">
                <div class="content">
                      <div class="module">
                            <div class="module-head">
                                <h3>
                                    Liste des livres</h3>
                            </div>

                            <div class="module-option clearfix">
                                <form>
                                <div class="input-append pull-left">
                                    <input type="text" class="span3" placeholder="Filter by name..." style=" ">
                                    <button type="submit" class="btn">
                                        <i class="icon-search"></i>
                                    </button>
                                </div>
                                </form>
                            </div>
                            <div class="module-body">
                                <div class="row-fluid">
                                        <br/>
                                        @foreach ($livres as $livre)
                                            <div class="span3 test">
                                                <div class="media user ">
                                                    <a class="media-avatarcopie  pull-left" href="#">
                                                        <img src="{{ asset('images/'.$livre->couverture_livre) }}">
                                                    </a>
                                                    <div class="media-body">
                                                        <p class="media-title"><strong style="color:#248aaf"><u>Titre</u></strong><small class="muted"><br/>{{$livre->titre_livre}}</small><br/>
                                                            <strong style="color:#248aaf"><u>Auteur</u></strong><br/><small class="muted">{{$livre->auteur->prenom_auteur.' '.$livre->auteur->nom_auteur}}</small>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <a href="{{ route('lecteur.livre.show_detail', ['id'=>$livre->id]) }}" class="btn btn-primary pull-left media-title">
                                                                    Details
                                                                </a>
                                                            </div>
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                            <div class="pagination pagination-centered">
                                {{$livres->links()}}
                            </div>
                        </div>
                        </div>
                </div>
                <!--/.content-->
            </div>
 </div>
@endsection
