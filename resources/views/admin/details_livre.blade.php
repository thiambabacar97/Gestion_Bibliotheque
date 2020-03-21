@extends('template.template')
@section('contenue')
     <div class="wrapper">
        <div class="container">
            <div class="row">
                <!--/.span3-->
                <div class="span9">
                    <div class="content">
                        <div class="module">
                            <div class="module-head">
                                <h3>All Members</h3>
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
                            </div>
                            <div class="module-body">
                                <div class="row-fluid">
                                    <div class="span12">
                                            @foreach ($livre as $livre)
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
                                                            <a  href="{{ route('livre.delete', ['id'=>$livre->id]) }}" class="btn btn-danger btn-mini btn-delete delete"><i class="icon-trash"></i>  Supprimer</a>
                                                            <a  href="{{ route('livre.update_index', ['id'=>$livre->id]) }}" class="btn btn-primary btn-mini" data-toggle="modal" data-target="#myModal" data-backdrop= "false"><i class="icon-edit"></i> Modifier</a>
                                                        </p>
                                                    <!-- Modal -->
                                                    <div class="modal fade "  id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                    Exemple de modal
                                                    </div>
                                                    </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                                    </div>
                                                </div>
                                                <hr>
                                                
                                            @endforeach
                                    </div>
                                </div>
                                <!--/.row-fluid-->
                                <br />
                                
                            </div>
                        </div>
                    </div>
                    <!--/.content-->
                </div>
                <!--/.span9-->
            </div>
        </div>
        <!--/.container-->
    </div>
    <script>
         var supprimer = document.querySelectorAll('.delete')
        for (let index = 0; index < supprimer.length; index++) {
            const link = supprimer[index];
            link.addEventListener('click', function(e){
                let conf = confirm('Voulez vous vraiment supprimer cet livre ?')
                if(!conf){
                    e.preventDefault()
                }

            })
        }
    </script>
@endsection
