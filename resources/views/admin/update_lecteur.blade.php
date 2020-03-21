
                    <form name="myform"  method="POST" action="{{ route('lecteur.update', ['id'=>$lecteur->id]) }}"  class="form-horizontal row-fluid"  novalidate>
                        {{ csrf_field() }}
                        @if (session('success'))
                            <div class="alert alert-success ">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{session('success')}}
                            </div> 
                        @endif
                        <div class="form-group">
                            <label class="control-label"   for="basicinput">prenom :</label>
                            <div class="controls">
                                <input  type="text" name="first_name"  value="{{$lecteur->first_name}}"  data-original-title="" class="form-control span8" required>
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
                                <input  type="text" name="last_name"  value="{{$lecteur->last_name}}" data-original-title="" class="form-control span8" required>
                                <br>
                                @if($errors->has('last_name'))
                                    <span class="help-inline"> {{$errors->first('last_name')}}</span>         
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Date de Naissance :</label>
                            <div class="controls">
                                 <input  type="date" name="date_naissance"  value="{{$lecteur->date_naissance}}" data-original-title="" class="form-control span8" required>
                                 <br>
                                 @if($errors->has('date_naissance'))
                                    <span class="help-inline"> {{$errors->first('date_naissance')}}</span>         
                                 @endif
                                </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Telephone :</label>
                            <div class="controls">
                                <input  type="tel" name="telephone"  value="{{$lecteur->telephone}}"  data-original-title="" class="form-control span8" required>
                                <br>
                                @if($errors->has('telephone'))
                                   <span class="help-inline"> {{$errors->first('telephone')}}</span>         
                                @endif
                               </div>
                            <hr>
                        <div class="form-group">
                            <label class="control-label" for="basicinput">Email :</label>
                            <div class="controls">
                            <input  type="email" name="email"  value="{{$lecteur->email}}" data-original-title="" class="form-control span8" required>
                                <br>
                                @if($errors->has('email'))
                                   <span class="help-inline"> {{$errors->first('email')}}</span>         
                                @endif
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <button class="btn btn-info" type="submit" class="btn">Ajouter</button>
                            </div>
                        </div>
                    </form>