{{-- @extends('template.template')
@section('contenue')
@section('controller')
<script src="{{ asset('angularjs/controller/livre.controller.js') }}" type="text/javascript"></script>
@endsection
<div class="span9">
    <div class="content" ng-controller="livrectrl">
        <div class="module">
            <div class="module-head">
                <h3><%title%></h3>
            </div> --}}
            {{-- <div class="module-body">
                   
            </div>
        </div>
    </div><!--/.content-->
</div> --}}
{{-- @endsection --}}
 <form class="form-horizontal row-fluid" method="POST" action="{{ route('livre.update', ['id'=>$input->id]) }}" name="myForm"  enctype="multipart/form-data" novalidate>
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
                                    <input  type="text"  name="titre_livre" value="{{$input->titre_livre}}" data-original-title="" class="form-control span8" required>
                                    <br>
                                    @if($errors->has('titre_livre'))
                                        <span class="help-inline"> {{$errors->first('titre_livre')}}</span>         
                                    @endif
                                </div>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="basicinput">Maison Editeur:</label>
                                <div class="controls">
                                    <input  type="text" name="editeur_livre" value="{{$input->editeur_livre}}" data-original-title="" class="form-control span8" required>
                                    @if($errors->has('editeur_livre'))
                                        <span class="help-inline"> {{$errors->first('editeur_livre')}}  </span>         
                                    @endif
                                </div>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="basicinput">ISBN/ISSN :</label>
                                <div class="controls">
                                    <input  type="text"  name="isbn_issn_livre" value="{{$input->isbn_issn_livre}}" data-original-title="" class="form-control span8" required>
                                    @if($errors->has('isbn_issn_livre'))
                                        <span class="help-inline"> {{$errors->first('isbn_issn_livre')}}  </span>         
                                    @endif
                                </div>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="basicinput">Année publication :</label>
                                <div class="controls">
                                    <input type="number"  name="date_pub_livre" min="1900" max="2099" step="1" value="{{$input->date_pub_livre}}"   data-original-title="" class="form-control span8" required/>
                                    @if($errors->has('date_pub_livre'))
                                        <span class="help-inline"> {{$errors->first('date_pub_livre')}}  </span>         
                                    @endif
                                </div>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="basicinput">Nature Livre :</label>
                                <div class="controls">
                                    <select name="nature_livre" data-placeholder="Selectionez.." value="{{$input->nature_livre}}" class="span8">
                                        <option value="">Selectionez..</option>
                                        <option value="voire sur place">voire sur place</option>
                                        <option value="pretable">pretable</option>
                                    </select>
                                    @if($errors->has('nature_livre'))
                                        <span class="help-inline"> {{$errors->first('nature_livre')}}  </span>         
                                    @endif
                                </div>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="basicinput">Nombre Exemplaire :</label>
                                <div class="controls">
                                    <input  type="number" name="nbr_exemplaire_livre" value="{{$input->nbr_exemplaire_livre}}"  data-original-title="" class="form-control span8" required>
                                    @if($errors->has('nbr_exemplaire_livre'))
                                        <span class="help-inline"> {{$errors->first('nbr_exemplaire_livre')}}  </span>         
                                    @endif
                                </div>
                                <hr>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="basicinput">L'Auteur du livre</label>
                                <div class="controls">
                                    <input type="text" list="listauteur" name="auteur_id" value="{{$input->auteur_id}}" id="basicinput" placeholder="Nombre d'exemplaire livre" class="span8">
                                        <datalist id="listauteur">
                                            @foreach ($auteur as $auteur)
                                                <option value="{{$auteur->id}}">{{$auteur->prenom_auteur.' '.$auteur->nom_auteur}}</option> 
                                            @endforeach
                                        </datalist>
                                </div>
                                <br/>
                                    @if($errors->has('auteur_id'))
                                        <div class="alert alert-success controls" style="width: 380px">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            {{$errors->first('auteur_id')}}  
                                        </div>    
                                    @endif
                            </div>
                            <div class="control-group">
                            <label class="control-label" for="basicinput">Catalogue du Livre</label>
                            <div class="controls">
                                <input list="categorieId" type="text"  name="domaine_id" value="{{$input->domaine_id}}"  id="basicinput" placeholder="Catalogue " class="span8">
                                    <datalist id="categorieId">
                                        @foreach ($domaine as $domaine)
                                            <option value="{{$domaine->id}}">{{$domaine->description_domaine}}</option> 
                                        @endforeach
                                    </datalist>
                            </div>
                            <br/>
                                @if($errors->has('domaine_id'))
                                    <div class="alert alert-success controls" style="width: 380px">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        {{$errors->first('domaine_id')}}  
                                    </div>    
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="basicinput">Ajouter un image de couverture</label>
                                <div class="controls">
                                <input type="file"  name="couverture_livre" value="{{$input->couverture_livre}}" accept=".jpg, .jpeg, .png"   id="basicinput"   class="form-control span8" >
                                    @if($errors->has('couverture_livre'))
                                        <span class="help-inline"> {{$errors->first('couverture_livre')}}  </span>         
                                    @endif
                                    <br/>
                                   
                                    <button type="submit" class="btn btn-primary btn-mini"><i class="icon-plus-sign"></i> Ajouter</button>
                                    
                                </div> 
                               
                            </div>
                          
                    </form>