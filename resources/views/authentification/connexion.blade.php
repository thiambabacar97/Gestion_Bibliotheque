<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edmin</title>
	<link type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	<link type="text/css" href="{{ asset('bootstrap/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
	<link type="text/css" href="{{ asset('css/theme.css') }}" rel="stylesheet">
	<link type="text/css" href="{{ asset('images/icons/css/font-awesome.css') }}" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>

			  	<a class="brand" href="index.html">
					GESTBiBlIO
			  	</a>
				<div class="nav-collapse collapse navbar-inverse-collapse">
				
					<ul class="nav pull-right">
						<li><a href="#">
							Mot de passe oublié?
						</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="wrapperconnexion">
			<div class="container">
				<div class="row">
					<div class="module module-login span4 offset4">
						<form class="form-vertical"  method="POST" action="{{ route('auth.connect') }}">
								{{csrf_field()}}
							<div class="module-head">
								<h3>Se connecter</h3>
							</div>
							<div class="module-body">
								<div class="control-group">
									<div class="controls row-fluid">
										<input input class="span12" type="email" name="email" id="inputEmail" placeholder="exemple@gmail.com" value="{{old('email')}}">
									</div>
								</div>
								<div class="control-group">
										<div class="controls row-fluid">
											<input class="span12" type="password" name="password" id="inputPassword" placeholder="Password">
										</div>
										<div>
											@if($errors->has('email'))
												<span class="help-inline"> {{$errors->first('email')}}</span>         
											@endif
										</div>
								</div>
							</div>
							<div class="module-foot">
								<div class="control-group">
									<div class="controls clearfix">
										<button type="submit" class="btn btn-primary pull-right">Login</button>
										<label class="checkbox">
											<input type="checkbox"> Se souviens de moi
										</label>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	<div class="footer">
		<div class="container">
			<b class="copyright">&copy; 2019 Projet Memoire - Thaim Babacar </b> Tous droits réservés.
		</div>
	</div>
	<script src="{{ asset('scripts/jquery-1.9.1.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('scripts/jquery-ui-1.10.1.custom.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
</body>