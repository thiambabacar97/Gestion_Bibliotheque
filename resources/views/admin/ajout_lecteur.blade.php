@extends('template.template')
@section('contenue')
@section('script')
    <script src="{{ asset('js/formulAdd.js') }}"></script>
@endsection
<div class="span8">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Ajouter un nouveau adherent</h3>
            </div>
            <style>
                .color{
                    color: red;
                }
            </style>
            <div class="module-body">
                    <form id="addLecteur" class="form-horizontal row-fluid" method="POST"  action="{{ route('lecteur.create') }}" >
                        {{ csrf_field() }}
                        @if (session('success'))
                            <div class="alert alert-success ">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{session('success')}}
                            </div> 
                        @endif
                        <div class="form-group">
                            <label class="control-label" for="basicinput">prenom :</label>
                            <div class="controls">
                                <input  type="text" name="first_name"  value="{{old('first_name')}}"  data-original-title="" class="form-control span8" >
                                 <div style="color: red; font-size: 12px"></div>
                                
                                @if($errors->has('first_name'))
                                    <span class="help-inline"> {{$errors->first('first_name')}}</span>         
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Nom :</label>
                            <div class="controls">
                                <input  type="text" name="last_name"  value="{{old('last_name')}}" data-original-title="" class="form-control span8" >
                                 <div style="color: red; font-size: 12px"></div>
                                
                                @if($errors->has('last_name'))
                                    <span class="help-inline"> {{$errors->first('last_name')}}</span>         
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Date de Naissance :</label>
                            <div class="controls">
                                 <input  type="date" name="date_naissance"  value="{{old('date_naissance')}}" data-original-title="" class="form-control span8" >
                                  <div style="color: red; font-size: 12px"></div>
                                 
                                 @if($errors->has('date_naissance'))
                                    <span class="help-inline"> {{$errors->first('date_naissance')}}</span>         
                                 @endif
                                </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Telephone :</label>
                            <div class="controls">
                                <input  type="tel" name="telephone"  value="{{old('telephone')}}"  data-original-title="" class="form-control span8" >
                                 <div style="color: red; font-size: 12px"></div>
                                
                                @if($errors->has('telephone'))
                                   <span class="help-inline"> {{$errors->first('telephone')}}</span>         
                                @endif
                               </div>
                            <hr>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Email :</label>
                            <div class="controls">
                                <input  type="email" name="email"  value="{{old('email')}}" data-original-title="" class="form-control span8" >
                                 <div style="color: red; font-size: 12px"></div>
                                
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
    </div><!--/.content-->
</div>
@endsection