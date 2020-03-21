@extends('template.lecteur_template')
@section('contenue')
<div class="container">
    <div class="span11">
        <div class="content">
            <div class="module message">
                <div class="module-head">
                    <h3>
                        Message</h3>
                </div>
                <div class="module-option clearfix">
                    <div class="pull-left">
                        <div class="btn-group">
                            <button class="btn">
                                Inbox</button>
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Inbox(11)</a></li>
                                <li><a href="#">Sent</a></li>
                                <li><a href="#">Draft(2)</a></li>
                                <li><a href="#">Trash</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Settings</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-info btn" data-backdrop="false" data-toggle="modal" data-target="#contact-modal"><i class="icon-plus-sign icon-large">Creer un Sujet</i></button>
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
                            <form id="addSujet"  name="contact" role="form" class="form-horizontal row-fluid" action="{{ route('lecteur.forum.store') }}" method="post" >
                                <div class="modal-body">
                                        {{ csrf_field() }}	
                                       		
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Titre du sujet :</label>
                                            <div class="controls">
                                                <input  type="text" name="titre" value="{{old('titre')}}" id="basicinput" placeholder="Titre du sujet" class="span12">
                                                @if($errors->has('titre'))
                                                    <span class="help-inline">{{$errors->first('titre')}} </span>        
                                                @endif
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Votre Sujet :</label>
                                            <div class="controls">
                                                <textarea name="message" value="{{old('message')}}" class="span12" rows="5"></textarea>
                                                @if($errors->has('message'))
                                                 <span class="help-inline">{{$errors->first('message')}} </span>        
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
                    @foreach ($messages as $message)
                    <div class="media stream">
                            <a href="#" class="media-avatar medium pull-left">
                                <img src="{{ asset('images/'.$message->user->avatar) }}">
                            </a>
                            <div class="media-body">
                                <div class="stream-headline">
                                    <h5 class="stream-author">
                                     {{$message->user->first_name.' '.$message->user->last_name}} <small>posté le{{$message->created_at->format('d/m/y à H:m')}}</small>
                                    </h5>
                                    <h5 class="stream-author">
                                        <a style="text-decoration: none;text-decoration-color: red" href="{{ route('lecteur.forum.show', $message) }}">{{$message->titre}}</a>
                                    </h5>
                                    <div class="stream-text">
                                        {{$message->message}}
                                    </div>
                                </div>
                            </div>
                        </div> 
                    @endforeach
                      
                <div class="module-foot">
                        <div class="pagination pagination-centered">
                                {{$messages->links()}}
                        </div>
                </div>
            </div>
        </div>
        <!--/.content-->
    </div>
</div>
@endsection