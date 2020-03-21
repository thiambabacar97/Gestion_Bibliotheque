<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>gestion bibliotheque</title>
        <link type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('bootstrap/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('css/theme.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('images/icons/css/font-awesome.css') }}" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>
    <div class="row" style="margin-left: 5%;margin-right: 5%;">
        <div>
            <div class="card">
                <div class="card-body">
                        <body  style="background: url(/images/bn.jpg) #eee;background-size: cover ;">
                                <div class="navbar navbar-fixed-top ">
                                    <div class="navbar-innercp ">
                                        <div class="container">
                                            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                                                <i class="icon-reorder shaded"></i></a><a class="brand"> GESTBiBlIO  </a>
                                            <div class="nav-collapse collapse navbar-inverse-collapse">
                                                    <ul class="nav pull-right">
                                                        <li><a href="{{route('lecteur.profile.index')}}">{{auth()->user()->first_name.' '.auth()->user()->last_name}} </a></li>  
                                                        <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                            <img src="{{ asset('images/'.auth()->user()->avatar) }}" class="nav-avatar" />
                                                            @unless (Auth::user()->unreadNotifications->isEmpty()) 
                                                                
                                                                <span  style="color: red"><i class="icon-bell-alt"></i> {{ auth()->user()->unreadNotifications->count() }}</span>
                                                            @endunless
                                                                <b class="caret"></b></a>
                                                                <ul class="dropdown-menu">
                                                                @unless (Auth::user()->unreadNotifications->isEmpty())
                                                              
                                                                    @foreach (Auth::user()->unreadNotifications as $notification )
                                                                        @if ($notification->type =='App\Notifications\NouveauCommentaire')
                                                                            <li>
                                                                                <a href="{{ route('lecteur.forum.show_notification', ['message'=>$notification->data['messageId'],'notification'=>$notification->id])}}"> <strong>{{$notification->data['messageUser']}}</strong> vient de commenter votre sujet <strong style="color: blue">{{$notification->data['messageTitre']}}</strong> </a>
                                                                            </li>
                                                                        @endif
                                                                        @if ($notification->type =='App\Notifications\EmpruntValider')
                                                                            <li>
                                                                                <a href="{{ route('lecteur.livre.mes_livres_emprunte_notif', ['livre'=>$notification->data['idlivre'],'notification'=>$notification->id])}}"> Cher lecteur votre Emprunte du Livre <strong style="color: blue">{{$notification->data['titreLivre']}}</strong>
                                                                                de <strong style="color: blue">{{$notification->data['auteur']}}</strong> a été validé. Nous vous prions de passer le recuperer  d'ici 24H au  plus tard à la BU 
                                                                                <strong style="color: blue "></strong></a>
                                                                            </li>    
                                                                        @endif
                                                                    @endforeach
                                                                   
                                                                @endunless
                                                                    <li><a href="{{route('lecteur.profile.index')}}">Paramètres du compte</a></li>
                                                                    <li class="divider"></li>
                                                                    <li id="deconnecter"><form action="{{ route('lecteur.auth.logout')}}" method="post" id="logout-form" >
                                                                            {{ csrf_field() }}
                                                                            <a style="text-decoration: none;padding: 10px 20px;display: block;
                                    
                                                                            padding: 3px 20px;
                                                                            
                                                                            clear: both;
                                                                            
                                                                            font-weight: normal;
                                                                            
                                                                            line-height: 20px;
                                                                            
                                                                            color: #333333;
                                                                            
                                                                            white-space: nowrap;" class="nav-link" href="#"><i class="menu-icon icon-signout"></i>Deconnexion</a>
                                                                        </form></li>
                                                                        <script>
                                                                            var element = document.querySelector('#logout-form')
                                                                            var form = document.querySelector('#deconnecter')
                                                                            form.addEventListener('click',function(){
                                                                             
                                                                               window.location.reload();
                                                                               element.submit();
                                                                            })
                                                                        </script>
                                                                </ul>
                                                            </li>
                                                    </ul>   
                                                <ul class="nav pull-left">
                                                    <li><a href="{{ route('home.index') }}">Accueil</a></li>
                                                    <li><a href="{{ route('lecteur.livre.show') }}">Livres</a></li>
                                                    {{-- <li><a  href="{{ route('lecteur.livre.reserver', ['id'=>$livre->id]) }}">Resever</a></li> --}}
                                                    <li><a href="{{ route('lecteur.livre.mes_livres_emprunte') }}">Mes Empruntes </a></li>
                                                    <li><a href="#">Suggestion</a></li>
                                                    <li><a href="{{ route('lecteur.forum.index') }}">Forum</a></li>
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
                                                
                                                     @yield('contenue')
                        
                                                </div>
                                            </div>
                                            <!--/.span3-->
                                          
                                            <!--/.span9-->
                                        </div>
                                    </div>
                                    <!--/.container-->
                                </div>
                                <!--/.wrapper-->
                                <div class="footercp">
                                    <div class="container">
                                            <b class="copyright">&copy; 2019 Projet Memoire - Thaim Babacar </b>Tous droits réservés.
                                    </div>
                                </div>
                                <script src="{{ asset('js/jquery-3.4.1.min.js') }}" type="text/javascript"></script>       
                                <script src="{{ asset('js/show.lecteur.js') }}" type="text/javascript"></script>
                                <script src="{{ asset('js/forum.js') }}" type="text/javascript"></script>
                                <script src="{{ asset('scripts/jquery-1.9.1.min.js') }}" type="text/javascript"></script>
                                <script src="{{ asset('scripts/jquery-ui-1.10.1.custom.min.js') }}" type="text/javascript"></script>
                                <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
                                <script src="{{ asset('scripts/flot/jquery.flot.js') }}" type="text/javascript"></script>
                                <script src="{{ asset('scripts/flot/jquery.flot.resize.js') }}" type="text/javascript"></script>
                                <script src="{{ asset('scripts/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
                                <script src="{{ asset('scripts/common.js') }}" type="text/javascript"></script>
                              
                        </body>
                </div>
           </div>
        </div>
    </div>

