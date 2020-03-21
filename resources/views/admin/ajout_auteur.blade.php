@extends('template.template')
@section('contenue')
@section('script')
    <script src="{{ asset('js/formulAdd.js') }}"></script>
@endsection
<div class="span9" >
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Ajouter un nouveau auteur</h3>
            </div>
            <div class="module-body">
                    <form id="addAuteur" class="form-horizontal row-fluid" method="POST" action="{{ route('auteur.create') }}" novalidate>
                        {{ csrf_field() }}
                        @if (session('success'))
                            <div class="alert alert-success ">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{session('success')}}
                            </div> 
                        @endif
                        <div class="form-group">
                            <label class="control-label"   for="basicinput">Prenom Auteur :</label>
                            <div class="controls">
                                <input  class="form-control span8" type="text"  name="prenom_auteur" value="{{old('prenom_auteur')}}"  data-original-title="" required>
                               <div style="color: red; font-size: 12px"></div>
                              
                                @if($errors->has('prenom_auteur'))
                                    <span class="help-inline">{{$errors->first('prenom_auteur')}} </span>        
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Nom Auteur:</label>
                            <div class="controls">
                                <input  class="form-control span8" type="text"  name="nom_auteur" value="{{old('nom_auteur')}}" data-original-title="" required>
                               <div style="color: red; font-size: 12px"></div>
                              
                                @if($errors->has('nom_auteur'))
                                    <span class="help-inline">{{$errors->first('nom_auteur')}} </span>        
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Date de Naissance Auteur :</label>
                            <div class="controls">
                                <input  class="form-control span8" type="date"  name="date_naissance_auteur" value="{{old('date_naissance_auteur')}}"  placeholder="yyyy-MM-dd"  required  data-original-title="" required>
                               <div style="color: red; font-size: 12px"></div>
                              
                                @if($errors->has('date_naissance_auteur'))
                                    <span class="help-inline">{{$errors->first('date_naissance_auteur')}} </span>        
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Nationtalité Auteur :</label>
                            <div class="controls">
                                <input  class="form-control span8" type="text"  name="nationalite_auteur" value="{{old('nationalite_auteur')}}"  data-original-title="" required>
                               <div style="color: red; font-size: 12px"></div>
                              
                                @if($errors->has('nationalite_auteur'))
                                    <span class="help-inline">{{$errors->first('nationalite_auteur')}} </span>        
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <input type="submit"  class="btn">
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div><!--/.content-->
</div>
@endsection