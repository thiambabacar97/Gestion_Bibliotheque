@extends('template.template')
@section('contenue')
    <div class="content">
          <div class="module">
                <div class="module-head">
                    <h3>All Members</h3>
                </div>
              
                <div class="module-option clearfix">
                    <form>
                    <div class="input-append pull-left">
                         <input type="text" class="typeahead" name="name" id="filter"  class="span3" placeholder="Filter by name..." style="height: 31px">
                        <button type="submit" class="btn">
                            <i class="icon-search"></i>
                        </button>
                    </div>
                    </form>
                </div>
                <div class="module-body">
                        <div class="row-fluid" >
                                <br/>
                                @foreach ($livres as $livre)
                                    <div class="span5"> 
                                        <div class="media user ">
                                            <a class="media-avatarcopie  pull-left" href="#">
                                                <img src="{{ asset('images/'.$livre->couverture_livre) }}">
                                            </a>
                                            <div class="media-body">
                                                <h3 class="media-title">
                                                    <p><strong style="color:#248aaf"><u>Titre</u></strong><small class="muted">: {{$livre->titre_livre}}</small></p>
                                                </h3>
                                                <h3 class="media-title">
                                                        <p><strong style="color:#248aaf"><u>Auteur</u></strong><small class="muted">: {{$livre->auteur->prenom_auteur.' '.$livre->auteur->nom_auteur}}</small></p>
                                                <div class="media-option btn-group shaded-icon">
                                                <a href="{{ route('livre.show_detail', ['id'=>$livre->id]) }}" class="btn btn-primary pull-left media-title">
                                                    Details
                                                </a>
                                                </div>
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
            <script src="{{ asset('js/jquery-3.4.1.min.js') }}" type="text/javascript"></script>        
        <script src="{{ asset('js/test.js') }}" type="text/javascript"></script> 

    </div>
        
    @endsection
    <!--/.content-->

