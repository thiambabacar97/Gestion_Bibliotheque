@extends('template.lecteur_template')
@section('contenue')
<div class="span11">
        <div class="content">
            <div class="module">
                
                <div class="module-head">
                        <p class="profile-brief">
                                <h3>Chers lecteur</h3>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                unknown printer took a galley of type.
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia nihil quae vitae aut repellat quibusdam, incidunt,
                                 sapiente est cum fuga inventore libero in? Nobis eius nostrum veniam animi nemo? Expedita.
                                 Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus porro laudantium illo nisi accusamus et quos amet odio, quam vitae ipsa 
                                 suscipit ipsam repellendus beatae fugiat corporis. Quasi, dolorum! Explicabo!
                                 Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem ullam consectetur aliquid tempore possimus minima recusandae natus. Possimus expedita eligendi, earum officia,
                                  distinctio ipsum aliquid, voluptatem veritatis nobis amet assumenda!
                                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore nobis laudantium harum cumque quo, asperiores quam saepe cum officia? Quam ex l
                                  abore vero, dolorem optio adipisci sint harum blanditiis alias?
                            </p>
                    
                    
                    <div class="module-option clearfix">
                        <form>
                            <div class="input-append pull-left">
                                <input type="text" class="span3" placeholder="Filter by name..." style="height: 21px">
                                <button type="submit" class="btn">
                                    <i class="icon-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="module-body">
                        <div class="row-fluid">
                            <div class="span12">
                        </div> 
                            </div>
                    <table class="table table-striped table-bordered table-condensed">
                      <thead>
                        <tr>
                          <th>Numero Inventaire</th>
                          <th>Titre Livre</th>
                          <th>Auteur Livre</th>
                        </tr>
                      </thead>
                        @if (session('success'))
                            <div class="alert alert-success ">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{session('success')}}
                            </div> 
                        @endif
                      

                                <?php  $auteur=DB::select('SELECT  * FROM auteurs WHERE id ='.$mes_emprunt->getLivre()->auteur_id);
                                ?>
                                @foreach ($auteur as $auteur)                                    
                                    <tbody>
                                        <tr> 
                                            <td>{{$mes_emprunt->getLivre()->num_inventaire_livre}}</td>
                                            <td>{{$mes_emprunt->getLivre()->titre_livre}}</td>
                                            <td>{{$auteur->prenom_auteur.' '.$auteur->nom_auteur}}</td>
                                        </tr>
                                    </tbody>
                               @endforeach 
                     
                    </table>
                </div>
            </div>  
        </div>
    </div>
@endsection