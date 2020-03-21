@extends('template.template')
@section('contenue')
     <div class="wrapper">
        <div class="container">
            <div class="row">
                <!--/.span3-->
                <div class="span9">
                    <div class="content">
                        <div class="module">
                            <div class="module-head">
                                <h3>
                                    All Members</h3>
                            </div>
                            <div class="module-option clearfix">
                                <form>
                                <div class="input-append pull-left">
                                    <input type="text" class="span3" placeholder="Filter by name...">
                                    <button type="submit" class="btn">
                                        <i class="icon-search"></i>
                                    </button>
                                </div>
                                </form>
                            </div>
                            <div class="module-body">
                                <div class="row-fluid">
                                    <div class="span12">
                                                <div class="media user" >
                                                    
                                                    <div style="text-align:center">
                                                           <u> <H2 >CARTE DE MEMBRE</H2>
                                                            <p>UNIVERSITE NELSON MANDELA DE DAKAR</p></u>
                                                            <hr>
                                                    </div>
                                                    <a class="media-avatarcopi  pull-left">
                                                        <img src="{{ asset('images/'.$lecteur->avatar) }}">
                                                    </a>
                                                    <div class="media-body ecart">
                                                        <p class="media-title">
                                                            <strong style="color:#248aaf"><u>Prenom</u></strong> : {{$lecteur->first_name}}
                                                        </p>
                                                        <p class="media-title">
                                                            <strong style="color:#248aaf"><u>Nom</u></strong> : {{$lecteur->last_name}}
                                                        </p>
                                                        <p class="media-title">
                                                            <strong style="color:#248aaf"><u>Date naissance</u></strong> : {{$lecteur->date_naissance}}
                                                        </p>
                                                        <p class="media-title">
                                                            <strong style="color:#248aaf"><u>Telephone</u></strong> : {{$lecteur->telephone}}
                                                        </p>
                                                        <p class="media-title">
                                                            <strong style="color:#248aaf"><u>Email</u></strong> : {{$lecteur->email}}
                                                        </p>
                                                        <!-- Trigger the modal with a button -->
                                                    </div>
                                                    
                                                </div>
                                                <p class="media-title"style="text-align:center">
                                                    <a  href="{{ route('lecteur.delete', ['id'=>$lecteur->id]) }}" class="btn btn-danger delete">Supprimer</a>
                                                    <a  href="{{ route('lecteur.update_index', ['id'=>$lecteur->id]) }}" class="btn btn-danger">Modifier</a>
                                                </p>
                                                <hr>
                                    </div>
                                </div>
                                <!--/.row-fluid-->
                                <br />
                                
                            </div>
                        </div>
                    </div>
                    <!--/.content-->
                </div>
                <!--/.span9-->
            </div>
        </div>
        <!--/.container-->
    </div>
    <script>
        var supprimer = document.querySelectorAll('.delete')
           for (let index = 0; index < supprimer.length; index++) {
               const link = supprimer[index];
               link.addEventListener('click', function(e){
                   let conf = confirm('Voulez vous vraiment supprimer cet livre ?')
                   if(!conf){
                       e.preventDefault()
                       alert("Vous avez annuler l'action")
                   }
   
               })
           }
       </script>
@endsection
