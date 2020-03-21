@extends('template.template')
@section('contenue')
<div class="span9">
        <div class="content">
            <div class="module">
                <div class="module-head">
                    <h3>Forms</h3>
                </div>
                <style>
                .color{
                   color: brown 
                }
                </style>
                <div class="module-body">
                        <form id="addAdmin" class="Myform" class="form-horizontal row-fluid" action="{{ route('ajout_admin.create') }}" method="post" enctype="multipart/form-data" novalidate>
                            {{ csrf_field() }}
                            @if (session('success'))
                                <div class="alert alert-success ">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{session('success')}}
                                </div> 
                            @endif
                            <div class="form-group">
                                <label class="control-label"  for="basicinput">prenom :</label>
                                <div class="controls">
                                    <input  type="text" name="first_name"  value="{{old('first_name')}}"  data-original-title="" class="form-control span8" required>
                                   <small class="help-inline"> </small>
                                    <br>
                                    @if($errors->has('first_name'))
                                        <span class="help-inline"> {{$errors->first('first_name')}}</span>         
                                    @endif
                                </div>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="basicinput">Nom :</label>
                                <div class="controls">
                                    <input  type="text" name="last_name"  value="{{old('last_name')}}" data-original-title="" class="form-control span8" required>
                                   <small class="help-inline"> </small>
                                    <br>
                                    <span class="help"></span>
                                    @if($errors->has('last_name'))
                                        <span class="help-inline"> {{$errors->first('last_name')}}</span>         
                                    @endif
                                </div>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="basicinput">Date de Naissance :</label>
                                <div class="controls">
                                    <input  type="date" name="date_naissance"  value="{{old('date_naissance')}}" data-original-title="" class="form-control span8" required>
                                   <small class="help-inline"> </small>
                                    <br>
                                    <span class="help"></span>         
                                    @if($errors->has('date_naissance'))
                                        <span class="help-inline"> {{$errors->first('date_naissance')}}</span>         
                                    @endif
                                </div>
                               <hr>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="basicinput">Telephone :</label>
                                <div class="controls">
                                    <input  type="text" name="telephone"  value="{{old('telephone')}}"  data-original-title="" class="form-control span8" required>
                                   <small class="help-inline"> </small>
                                    <br>
                                    <span class="help"></span>
                                    @if($errors->has('telephone'))
                                        <span class="help-inline"> {{$errors->first('telephone')}}</span>         
                                    @endif
                                </div>
                               <hr>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="basicinput">Email :</label>
                                <div class="controls ">
                                    <input  type="email" name="email"  value="{{old('email')}}" data-original-title="" class="form-control span8" required>
                                   <small class="help-inline"> </small>
                                    <br>
                                    <span class="help"></span>
                                    @if($errors->has('email'))
                                        <span class="help-inline"> {{$errors->first('email')}}</span>         
                                    @endif
                                </div>
                                 <hr>  
                            </div>
                            <div class="form-group">
                                <div class="controls">
                                    <button type="submit" class="btn">Ajouter</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
</div>
@endsection