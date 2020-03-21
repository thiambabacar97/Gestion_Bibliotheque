@extends('template.template')
@section('contenue')
<div class="span8">
    <div class="content">
        <div class="module">
            <div class="module-body">
                <div class="profile-head media">
                    <a href="#" class="media-avatar pull-left">
                        <img src="{{ asset('images/'.$user->avatar)}}">
                    </a>
                    <div class="media-body">
                        <h4>
                            {{$user->first_name.' '.$user->last_name}} <small>Online</small>
                        </h4>
                        <p class="profile-brief">
                          Bonjour cher bibliothécaire, vous pouver modifier ici tous vos informations personnel.
                        </p>
                        <div class="profile-details muted">
                        <form  action="{{route('profile.update_image')}}"  method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="control-group">
                                    <label class="control-label" for="basicinput">Modifier votre image de profile</label>
                                    <div class="controls">
                                        <input type="file" name="avatar" accept=".jpg, .jpeg, .png"   id="basicinput"  class="span8" multiple>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" class="btn">Modifier</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                            <h4>Votre email</h4>
                            <div class="profile-details muted">
                                <form  action="{{route('profile.update_email')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="control-group">
                                        <div class="controls">
                                            <label class="control-label" for="basicinput">Adresse e-mail actuelle</label>
                                            <input type="text" name="email" value="{{$user->email}}" disabled>
                                        </div>
                                        <div class="controls">
                                            <label class="control-label" for="basicinput">Nouvel e-mail</label>
                                            <input type="text" name="email"   value="">
                                            <br/>
                                            @if($errors->has('email'))
                                                <div class="alert alert-success controls" style="width: 153px;">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    {{$errors->first('email')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <button type="submit" class="btn">Modifier</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <hr>
                            <h4>Changer votre mot de passe</h4>
                            <div class="profile-details muted">
                                    <form action="{{route('profile.update_password')}}" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="control-group">
                                            <div class="controls">
                                                <label class="control-label" for="basicinput">Nouveau mot de passe</label>
                                                <input type="password" name="password"   value="">
                                                <br/>
                                                @if($errors->has('password'))
                                                    <div class="alert alert-success controls" style="width: 153px">
                                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                                        {{$errors->first('password')}}
                                                    </div>
                                                @endif
                                                <label class="control-label" for="basicinput">Réécrire nouveau mot de passe</label>
                                                <input type="password" name="password_confirmation">
                                                <br/>
                                                @if($errors->has('password_confirmation'))
                                                    <div class="alert alert-success controls" style="width: 153px">
                                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                                        {{$errors->first('password_confirmation')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" class="btn">Modifier</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                    </div>
                </div>


            </div>
            <!--/.module-body-->
        </div>
        <!--/.module-->
    </div>
    <!--/.content-->
</div>
@endsection
