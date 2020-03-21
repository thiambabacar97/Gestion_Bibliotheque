@extends('template.lecteur_template')
@section('contenue')
<div class="container" >
    <div class="span11">
        <div class="content">
            <div class="module message">
                <div class="module-head">
                    <h3>
                        Message   <a style="margin-top: -5px" href="{{route('lecteur.forum.return')}}" class="btn btn-info pull-right"><i class="icon-arrow-left"></i>Retour</a>
                    </h3>
                       
                </div>
                
                <div class="media stream">
                        <a href="#" class="media-avatar medium pull-left">
                             <img src="{{ asset('images/'.$message->user->avatar) }}">
                        </a>
                        <div class="media-body">
                            <div class="stream-headline">
                                <h5 class="stream-author">
                                        {{$message->user->first_name.' '.$message->user->last_name}}
                                        <small>posté le {{$message->created_at->format('d/m/y à H:m')}}</small>
                                       
                                </h5>
                                <h5 class="stream-author">
                                        {{$message->titre}}
                                    </h5>
                                <div class="stream-text">
                                        {{$message->message}}

                                </div>
                            </div>
                            <!--/.stream-headline-->
                            <div class="stream-options">
                                    <?php
                                    if ($message->user->id == auth()->user()->id) {
                                        ?>
                                        <button type="button" id="addcomment" class="btn btn-info btn" >Modifier</button>
                                        <a href="{{route('lecteur.forum.delete',$message)}}" class="btn btn-danger"><i class="icon-reply shaded"></i>Supprimer</a>
                                <?php } ?>
                                     
                                
                            </div>
                            <hr>
                            <h5 class="stream-author"> Commentaires</h5>
                            <form  id="contactForm" name="contact" role="form" method="POST" action="{{ route('forum.comment.store',$message) }}">
                                   {{ csrf_field() }}
                                <div class="form-group">
                                      <label for="message">Message</label>
                                      <textarea  name="content" class="form-control" style="width: 500px; height:100px ">{{old('content')}}</textarea>
                                      <div id="addComments" style="color: red; font-size: 12px"></div>
                                     <div>
                                            @if($errors->has('content'))
                                            <span class="help-inline"> {{$errors->first('content')}} </span>         
                                          @endif
                                     </div>
                                    </div>
                                    <div class="form-group">
                                    <input type="submit" class="btn btn-info" id="submit">
                                    </div>					
                                </form>
                                @forelse ($message->commentaires  as $commentaire)
                                    <div class="stream-respond">
                                        <div class="media stream">
                                                <div class="media-body">
                                                    <div class="stream-headline">
                                                            <h5 class="stream-author">
                                                                {{$commentaire->user->first_name.' '.$commentaire->user->last_name}}
                                                                <small>posté le {{$commentaire->created_at->format('d/m/y à H:m')}}</small>   
                                                            </h5>
                                                        <div class="stream-text">
                                                            {{$commentaire->content}}
                                                        </div>
                                                    </div>
                                                    <!--/.stream-headline-->
                                                </div>
                                            </div>
                                    </div>
                                    @foreach ( $commentaire->commentaires as $reponseCommentaire)
                                        <div style="margin-left: 50px; margin-top:-30px">
                                                <div class="stream-respond">
                                                        <div class="media stream"  >
                                                                
                                                                <div class="media-body">
                                                                    <div class="stream-headline">
                                                                            <h5 class="stream-author">
                                                                                {{$reponseCommentaire->user->first_name.' '.$reponseCommentaire->user->last_name}}
                                                                                <small>posté le {{$reponseCommentaire->created_at->format('d/m/y à H:m')}}</small>   
                                                                            </h5>
                                                                        <div class="stream-text">
                                                                            {{$reponseCommentaire->content}}
                                                                        </div>
                                                                    </div>
                                                                    <!--/.stream-headline-->
                                                                </div>
                                                            </div>
                                                    </div>
                                        </div>
                                    @endforeach
                                    <style>
                                            .form_content{
                                                display: none
                                            }
                                            .form_content_visible{
                                                display: block
                                            }
                                    </style>
                                    <button  class="btn btn-info" onclick="toggleFormulaire({{$commentaire->id}})"><i class="icon-reply shaded"></i>Répondre</button>
                                    <hr>
                                    <div style="margin-left: 50px;" >
                                    <form  class="form_content maReponse" id="reponseForm-{{$commentaire->id}}"  role="form" method="POST" action="{{ route('forum.comment.store_reponse',$commentaire) }}" class="d-none" >
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="message">Ma reponse</label>
                                                <textarea name="repondre_commentaire" class="form-control" style="width: 500px; height:100px ">{{old('repondre_commentaire')}}</textarea>
                                                <div id="reponseComments" style="color: red; font-size: 12px"></div>
                                                @if($errors->has('repondre_commentaire'))
                                                     <span class="help-inline">{{$errors->first('repondre_commentaire')}} </span>        
                                                 @endif
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-info" id="submit">
                                            </div>					
                                        </form>
                                    </div>
                                @empty
                                    
                                @endforelse
                            
                            <!--/.stream-respond-->
                        </div>
                    </div>
                        {{-- Debut modal formulaire d'ajout --}}
                    <div id="contact-modal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <a class="close" data-dismiss="modal">×</a>
                                  <h3>Contact Form</h3>
                                </div>
                                <form  id="add_message" name="contact" role="form" class="form-horizontal row-fluid" action="{{route('lecteur.forum.update', $message)}}" method="post" >
                                    <div class="modal-body">
                                            {{ csrf_field() }}			
                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Titre du sujet :</label>
                                                <div class="controls">
                                                     <input  type="text" name="titre"  value="{{$message->titre}}" id="basicinput" placeholder="Titre du sujet" class="span12">
                                                     @if($errors->has('titre'))
                                                        <span class="help-inline"> {{$errors->first('titre')}}  </span>         
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Votre Sujet :</label>
                                                <div class="controls">
                                                    <textarea name="message" class="span12" rows="5">{{$message->message}}</textarea>
                                                    @if($errors->has('message'))
                                                        <span class="help-inline"> {{$errors->first('message')}}  </span>         
                                                    @endif
                                                </div>
                                            </div>
                                      </div>
                                      <div class="modal-footer">					
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-info"><i class="icon-plus-sign icon-large">Ajouter Admin</i></button>
                                      </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        {{-- Fin modal fornmulaire d'ajout --}}
                    <div class="module-foot">
                        
                </div>
            </div>
        </div>
        <!--/.content-->
    </div>
</div>
@endsection