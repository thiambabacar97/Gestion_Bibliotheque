@extends('template.template')
@section('contenue')
@section('script')
    <script src="{{ asset('js/formulAdd.js') }}"></script>
@endsection
<div class="span8">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Ajouter un nouveau domaine</h3>
            </div>
            <div class="module-body">
                    <form id="addDomaine" class="form-horizontal row-fluid" method="POST" action="{{ route('domaine.create') }}" novalidate>
                        {{ csrf_field() }}
                        @if (session('success'))
                            <div class="alert alert-success ">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{session('success')}}
                            </div> 
                        @endif
                        <div class="form-group " id="sms_info">
                            <label class="control-label" for="basicinput">Domaine :</label>
                            <div class="controls">
                                <input class="form-control span8" type="text"  name="description_domaine" value="{{old('description_domaine')}}"  data-original-title="" required>
                                <div style="color: red; font-size: 12px"></div>
                                 
                            </div>
                            @if($errors->has('description_domaine'))
                            <br/>
                                <div class="alert alert-success controls control-group" style="width: 380px">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {{$errors->first('description_domaine')}}  
                                </div>    
                            @endif
                            <hr>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                               <button type="submit" class="btn btn-info">Ajouter </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div><!--/.content-->
</div>
@endsection