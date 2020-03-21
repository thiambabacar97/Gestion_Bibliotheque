@extends('template.template')
@section('contenue')
@section('script')
    <script src="{{ asset('js/formulAdd.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.domaine').select2();
            $('.etudiant').select2();
        });
    </script>
@endsection
<div class="span8">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Ajouter un nouveau memoire</h3>
            </div>
            <div class="module-body">
                    <form  id="addMemoire" class="form-horizontal row-fluid" method="POST" action="{{ route('memoire.create') }}" novalidate>
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
                                <input  class="form-control span8" type="text" ng-model="titre_memoire" name="titre_memoire" value="{{old('titre_memoire')}}" data-original-title=""  required>
                                <div style="color: red; font-size: 12px"></div>  
                            </div>
                            <hr>
                            
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Année publication :</label>
                            <div class="controls">
                                <input class="form-control span8 " type="number" ng-model="anne_memoire" name="anne_memoire" min="1900" max="2099" step="1" value="{{old('anne_memoire')}}"   data-original-title=""     required/>
                                <div style="color: red; font-size: 12px"></div>
                            </div>
                            <hr>
                            @if($errors->has('anne_memoire'))
                            <br/>
                                    <div class="alert alert-success controls control-group" style="width: 380px">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        {{$errors->first('anne_memoire')}}  
                                    </div>    
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Nombre de page :</label>
                            <div class="controls">
                                <input class="form-control span8" type="number" ng-model="nbr_page_memoire" name="nbr_page_memoire" value="{{old('nbr_page_memoire')}}" data-original-title=""  required>
                                <div style="color: red; font-size: 12px"></div>
                            </div>
                            <hr>
                            @if($errors->has('nbr_page_memoire'))
                            <br/>
                                <div class="alert alert-success controls control-group" style="width: 380px">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {{$errors->first('nbr_page_memoire')}}  
                                </div>    
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Etudiant :</label>
                            <div class="controls">
                                <select  class="etudiant form-control span8" name="etudiant_id" ng-model="etudiant_id" data-placeholder="Selectionez.." value="{{old('etudiant_id')}}"  required>
                                    <option value="">Selectionez..</option>
                                    @foreach ($etudiant as $etudiant)
                                        <option value="{{$etudiant->id}}">{{$etudiant->prenom_etudiant.' '.$etudiant->nom_etudiant}}</option> 
                                    @endforeach  
                                </select>
                                <div style="color: red; font-size: 12px"></div>
                            </div>
                            <hr>
                            @if($errors->has('etudiant_id'))
                            <br/>
                                <div class="alert alert-success controls control-group" style="width: 380px">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {{$errors->first('etudiant_id')}}  
                                </div>    
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Domaine :</label>
                            <div class="controls">
                                <select class="domaine form-control span8  " name="domaine_id"  data-placeholder="Selectionez.." value="{{old('domaine_id')}}" required>
                                    <option value="">Selectionez..</option>
                                    @foreach ($domaine as $domaine)
                                    <option value="{{$domaine->id}}">{{$domaine->description_domaine}}</option>
                                   @endforeach
                                </select>
                                <div style="color: red; font-size: 12px"></div>
                            </div>
                            <hr>
                            @if($errors->has('domaine_id'))
                            <br/>
                                <div class="alert alert-success controls control-group" style="width: 380px">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {{$errors->first('domaine_id')}}  
                                </div>    
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <button type="submit" class="btn">Ajouter</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div><!--/.content-->
</div>
@endsection