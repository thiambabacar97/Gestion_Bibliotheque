@extends('template.template')
@section('contenue')
@section('script')
    <script src="{{ asset('js/formulAdd.js') }}"></script>
@endsection
<div class="span8" >
    <div class="content"  ng-controller="etudiantctrl">
        <div class="module">
            <div class="module-head">
                <h3>Ajouter Etudiant</h3>
            </div>
            <div class="module-body">
                    <form id="addEtudiant" class="form-horizontal row-fluid" method="POST" action="{{ route('etudiant.create') }}" >
                        {{ csrf_field() }}
                        @if (session('success'))
                            <div class="alert alert-success ">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{session('success')}}
                            </div> 
                        @endif
                        <div class="form-group">
                            <label class="control-label"  for="basicinput">Prenom Etudiant :</label>
                            <div class="controls">
                                <input  type="text" name="prenom_etudiant" value="{{old('prenom_etudiant')}}"  data-original-title="" class="form-control span8" >
                                <div style="color: red; font-size: 12px"></div>
                                @if($errors->has('prenom_etudiant'))
                                    <span class="help-inline">{{$errors->first('prenom_etudiant')}} </span>        
                                @endif
                            </div>
                           <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Nom Etudiant:</label>
                            <div class="controls">
                                <input  type="text" name="nom_etudiant"  value="{{old('nom_etudiant')}}" data-original-title="" class="form-control span8" >
                                 <div style="color: red; font-size: 12px"></div>
                                @if($errors->has('nom_etudiant'))
                                    <span class="help-inline">{{$errors->first('nom_etudiant')}} </span>        
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Date de Naissance etudiant :</label>
                            <div class="controls">
                                <input  type="date" name="date_naissance_etudiant"  value="{{old('date_naissance_etudiant')}}" data-original-title="" class="form-control span8" >
                                 <div style="color: red; font-size: 12px"></div>
                                @if($errors->has('date_naissance_etudiant'))
                                    <span class="help-inline">{{$errors->first('date_naissance_etudiant')}} </span>        
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Nationtalité etudiant :</label>
                            <div class="controls">
                                <input  type="text" name="nationalite_etudiant"  value="{{old('nationalite_etudiant')}}"  data-original-title="" class="form-control span8" >
                                <div style="color: red; font-size: 12px"></div>
                                @if($errors->has('nationalite_etudiant'))
                                    <span class="help-inline">{{$errors->first('nationalite_etudiant')}} </span>        
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <input type="submit"  class="btn btn-info" value="Ajouter" >
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div><!--/.content-->
</div>
@endsection