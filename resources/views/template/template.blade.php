<!DOCTYPE html>
<html>
<head>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>gestion bibliotheque</title>
        
        <link type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('bootstrap/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('css/theme.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('images/icons/css/font-awesome.css') }}" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    </head>
    <div class="row"  style="margin-left: 5%;margin-right: 5%;">
        <div class="card">
            <div class="card-body">
                    <body  style="background: url(/images/bn.jpg) #eee;background-size: cover ;">
                            <div class="navbar navbar-fixed-top">
                                <div class="navbar-inner">
                                    <div class="container">
                                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                                            <i class="icon-reorder shaded"></i></a><a class="brand" href="index.html">THiam </a>
                                        <div class="nav-collapse collapse navbar-inverse-collapse">
                                            <ul class="nav pull-right">
                                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown
                                                        @unless (Auth::user()->unreadNotifications->isEmpty())  
                                                        <span  class="fa-layers-text fa-inverse" data-fa-transform="shrink-4 up-2 left-1" style="color: red; font-weight:900"><i class="fa fa-bell-o" style="background-color: red" aria-hidden="false"></i>{{ auth()->user()->unreadNotifications->count() }}</span>
                                                    @endunless
                                                    <b class="caret"></b></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#">Item No. 1</a></li>
                                                        <li><a href="#">Don't Click</a></li>
                                                        <li class="divider"></li>
                                                        <li class="nav-header">Example Header</li>
                                                        <li><a href="#">A Separated link</a></li>
                                                    </ul>
                                                </li>
                                                <li><a >{{auth()->user()->first_name.' '.auth()->user()->last_name}} </a></li></a></li>
                                                <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    <img src="{{ asset('images/'.auth()->user()->avatar) }}" class="nav-avatar" />
                    
                                                    <b class="caret"></b></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="{{ route('profile.index') }}">Edit Profile</a></li>
                                                        <li class="divider"></li>
                                                        <li id="deconnecter"><form action="{{ route('auth.logout')}}" method="post" id="logout-form" >
                                                            {{ csrf_field() }}
                                                            <a style="text-decoration: none;padding: 10px 20px;display: block;
                    
                                                            padding: 3px 20px;
                                                            
                                                            clear: both;
                                                            
                                                            font-weight: normal;
                                                            
                                                            line-height: 20px;
                                                            
                                                            color: #333333;
                                                            
                                                            white-space: nowrap;" class="nav-link" href="#"><i class="menu-icon icon-signout"></i>Deconnexion</a>
                                                        </form></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.nav-collapse -->
                                    </div>
                                </div>
                                <!-- /navbar-inner -->
                            </div>
                            <!-- /navbar -->
                            <div class="wrapper">
                                <div class="container">
                                    <div class="row">
                                        <div class="span3">
                                            <div class="sidebar">
                                                <ul class="widget widget-menu unstyled">
                                                    <li class="active"><a href="{{route('home.admin')}}"><i class="menu-icon icon-dashboard"></i>Dashboard</a></li>
                                                    <li><a id="listLecteur" href="{{ route('lecteurs.index') }}"><i class="menu-icon icon-tasks"></i>Gestion Lecteurs</a></li>
                                                </ul>
                                                <ul class="widget widget-menu unstyled">
                                                    <li><a  id="link" href="{{ route('livre.show') }}"><i class="menu-icon icon-table"></i>Liste Livre</a></li>
                                                    <li><a href="{{ route('domaine.index') }}"><i class="menu-icon icon-bold"></i> Domaines </a></li>
                                                    <li><a href="{{ route('auteur.index') }}"><i class="menu-icon icon-book"></i>Ajouter Auteur </a></li>
                                                    <li><a  href="{{ route('livre.index') }}"><i class="menu-icon icon-paste"></i>Ajouter Livre </a></li>  
                                                </ul>  
                                                <!--/.widget-nav-->
                                                <ul class="widget widget-menu unstyled">
                                                    <li><a href="{{ route('lecteur.create') }}"><i class="menu-icon icon-book"></i>Ajouter lecteur </a></li>
                                                    <li><a href="{{ route('etudiant.index') }}"><i class="menu-icon icon-table"></i>Ajouter Etudiant </a></li>
                                                    <li><a href="{{ route('memoire.index') }}"><i class="menu-icon icon-bar-chart"></i>Ajouter Memoire </a></li>
                                             
                                                    <li><a   href="{{ route('livre.show_book_ask') }}"><i class="menu-icon icon-bar-chart"></i>Livre demander </a></li>
                                                    <li><a   href="{{ route('livre.list_livre_preter') }}"><i class="menu-icon icon-bar-chart"></i>Livre préter </a></li>
                                                    <li style="background-color: #2d2b32">
                                                        <form action="{{ route('auth.logout')}}" method="post" id="logout-form" >
                                                            {{ csrf_field() }}
                                                            <a href="#" onclick="document.getElementById('logout-form').submit()">Deconnexion</a>
                                                        </form>
                                                    </li>
                                                </ul>                          
                                            </div>
                                        </div>
                                        <div class="span9" id="conten">
                                           @yield('contenue')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                    var element = document.querySelector('#logout-form')
                                    var form = document.querySelector('#deconnecter')
                                    form.addEventListener('click',function(){
                                       window.location.reload();
                                       element.submit();
                                    });
                            </script>
                            <div class="footercp" style="margin-bottom: -30px">
                            <div class="container">
                                <b class="copyright">&copy; 2019 Projet Memoire - Thaim Babacar </b>Tous droits réservés.
                            </div>
                            </div> 
                            @yield('table')         
                            <script src="{{ asset('scripts/jquery-1.9.1.min.js') }}" type="text/javascript"></script>
                            <script src="{{ asset('js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
                            <script src="{{ asset('scripts/jquery-ui-1.10.1.custom.min.js') }}" type="text/javascript"></script>
                            <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
                            <script src="{{ asset('scripts/flot/jquery.flot.js') }}" type="text/javascript"></script>
                            <script src="{{ asset('scripts/flot/jquery.flot.resize.js') }}" type="text/javascript"></script>
                            {{-- <script src="{{ asset('scripts/common.js') }}" type="text/javascript"></script> --}}
                            @yield('script')   
                        </body>
            </div>
        </div>
    </div>
   
   
   
   
   
   
   
    
