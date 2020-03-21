@extends('template.lecteur_template')
@section('contenue')
<div class="span11">
        <div class="content">
            <div class="module">
                
                <div class="module-head">
                    <style>
                            .modal {
                              width: 300px; 
                              margin-top: 120px;
                            
                             }
                    </style>
                    <div class="alert alert-danger ">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                       <p>
                        Cher lecteur nous vous informons que pour cet livre on n'a plus d'exemplaire disponible dans nos stock,
                         Parcontre tous les exemplaire de ce livre et leurs Date de diponiblites vous ont ennumere au dessus vous pouvez faire une reservation
                       </p>
                     
                    </div> 
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
                          <th>Date de  Disponiblité</th>
                          <th>Faire une Reservation</th>
                        </tr>
                      </thead>
                        @if (session('success'))
                            <div class="alert alert-success ">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{session('success')}}
                            </div> 
                        @endif
                        @foreach ($mes_emprunt as $mes_emprunt)

                                <?php  $auteur=DB::select('SELECT  * FROM auteurs WHERE id ='.$mes_emprunt->getLivre()->auteur_id);
                                ?>
                                @foreach ($auteur as $auteur)                                    
                                    <tbody>
                                        <tr> 
                                            <td>{{$mes_emprunt->getLivre()->num_inventaire_livre}}</td>
                                            <td>{{$mes_emprunt->getLivre()->titre_livre}}</td>
                                            <td>{{$auteur->prenom_auteur.' '.$auteur->nom_auteur}}</td>
                                            <td>{{$mes_emprunt->dateRetour}}</td>
                                            <td><button type="button" class="btn btn-info btn" data-backdrop="false" data-toggle="modal" data-target="#reservation-modal">Faire une reservation</button></td>
                                            <div id="reservation-modal" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-sm  ">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <a class="close" data-dismiss="modal">×</a>
                                                          <h3>Contact Form</h3>
                                                        </div>
                                                        <form id="reserver" action="{{ route('lecteur.livre.enrigistre_resrevation', ['id'=>$mes_emprunt->livre_id]) }}" method="POST" name="contact" role="form">
                                                                <div class="modal-body">
                                                                        {{ csrf_field() }}					
                                                                  <div class="form-group">
                                                                    <label for="name">Date de Reservation:</label>
                                                                    <input type="date" name="dateReservation" class="form-control">
                                                                    <small class="help-inline"> </small>
                                                                  </div>					
                                                                </div>
                                                                <div class="modal-footer">					
                                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                                                                  <input type="submit" class="btn btn-success" id="submit">
                                                                </div>
                                                        </form>
                                                      </div>
                                                    </div>
                                                </div>
                                        </tr>
                                    </tbody>
                               @endforeach 
                       @endforeach
                    </table>
                    
                </div>
            </div>  
        </div>
    </div>
@endsection