@extends('template.template')
@section('contenue')
@section('script')
<script src="{{ asset('js/addLivre.js') }}" type="text/javascript"></script>  
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.domaine').select2();
        $('.auteur').select2();
    });
</script>
@endsection
<div class="span8">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Ajouter un nouveau livre </h3>
            </div>
            <div class="module-body">
                    <form id="addLivre" class="form-horizontal row-fluid" method="POST" action="{{ route('livre.create')}}"   enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        @if (session('success'))
                            <div class="alert alert-success ">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{session('success')}}
                            </div> 
                        @endif
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Titre:</label>
                            <div class="controls">
                                <input  type="text"  name="titre_livre" value="{{old('titre_livre')}}" data-original-title="" class="form-control span8"  >
                                <div style="color: red; font-size: 12px"></div>
                                @if($errors->has('titre_livre'))
                                    <span class="help-inline"> {{$errors->first('titre_livre')}}</span>         
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Maison Editeur:</label>
                            <div class="controls">
                                <input  type="text"  name="editeur_livre" value="{{old('editeur_livre')}}" data-original-title="" class="form-control span8"  >
                               <div style="color: red; font-size: 12px"></div>
                                 
                                @if($errors->has('editeur_livre'))
                                    <span class="help-inline"> {{$errors->first('editeur_livre')}}  </span>         
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">ISBN/ISSN :</label>
                            <div class="controls">
                                <input  type="text"  name="isbn_issn_livre" value="{{old('isbn_issn_livre')}}" data-original-title="" class="form-control span8"  >
                               <div style="color: red; font-size: 12px"></div>
                                @if($errors->has('isbn_issn_livre'))
                                    <span class="help-inline"> {{$errors->first('isbn_issn_livre')}}  </span>         
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Année publication :</label>
                            <div class="controls">
                                <input type="number" name="date_pub_livre" min="1900" max="2099" step="1" value="{{old('date_pub_livre')}}"   data-original-title="" class="form-control span8"  />
                               <div style="color: red; font-size: 12px"></div>
                                @if($errors->has('date_pub_livre'))
                                    <span class="help-inline"> {{$errors->first('date_pub_livre')}}  </span>         
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Nature Livre :</label>
                            <div class="controls">
                                <select  name="nature_livre" data-placeholder="Selectionez.." value="{{old('nature_livre')}}" class="span8">
                                    <option value="">Selectionez..</option>
                                    <option value="voire sur place">voire sur place</option>
                                    <option value="pretable">pretable</option>
                                </select>
                               <div style="color: red; font-size: 12px"></div>
                                 
                                @if($errors->has('nature_livre'))
                                    <span class="help-inline"> {{$errors->first('nature_livre')}}  </span>         
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Nombre Exemplaire :</label>
                            <div class="controls">
                                <input  type="number" name="nbr_exemplaire_livre" value="{{old('nbr_exemplaire_livre')}}"  data-original-title="" class="form-control span8"  >
                               <div style="color: red; font-size: 12px"></div>
                                @if($errors->has('nbr_exemplaire_livre'))
                                    <span class="help-inline"> {{$errors->first('nbr_exemplaire_livre')}}  </span>         
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Auteur :</label>
                            <div class="controls">
                                <select name="auteur_id" class="auteur form-control span8" data-placeholder="Selectionez.." value="{{old('auteur_id')}}" >
                                    <option value="">Selectionez..</option>
                                    @foreach ($auteur as $auteur)
                                        <option value="{{$auteur->id}}">{{$auteur->prenom_auteur.' '.$auteur->nom_auteur}}</option> 
                                    @endforeach  
                                </select>
                               <div style="color: red; font-size: 12px"></div>
                                 
                                @if($errors->has('auteur_id'))
                                    <span class="help-inline"> {{$errors->first('auteur_id')}}  </span>         
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Domaine :</label>
                            <div class="controls">
                                <select name="domaine_id"  data-placeholder="Selectionez.." value="{{old('domaine_id')}}" class="domaine form-control span8"  >
                                    <option value="">Selectionez..</option>
                                    @foreach ($domaine as $domaine)
                                        <option value="{{$domaine->id}}">{{$domaine->description_domaine}}</option>
                                   @endforeach
                                </select>
                               <div style="color: red; font-size: 12px"></div>
                                 
                                @if($errors->has('domaine_id'))
                                    <span class="help-inline"> {{$errors->first('domaine_id')}}  </span>         
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Ajouter un image de couverture</label>
                            <div class="controls">
                                <input  type="file"  name="couverture_livre"   id="image"   class="form-control span8" >
                               <div style="color: red; font-size: 12px"></div>
                               <small class="media stream">
                                <a class="media-avatar medium pull-left">
                                    <img  id="image_preview_container" src="{{ asset('/images/cover.png') }}" alt="preview image" style="max-height: 150px;">
                                </a>
                            </small>
                                @if($errors->has('couverture_livre'))
                                    <span class="help-inline"> {{$errors->first('couverture_livre')}}  </span>         
                                @endif
                            </div>
                            
                        </div> 
                        <div class="form-group">
                            <div class="controls">
                                <input type="submit" class="btn btn-info">
                            </div>
                        </div>
                    </form>
            </div>
          
        </div>
    </div><!--/.content-->
</div>
@endsection