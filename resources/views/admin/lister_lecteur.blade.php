@extends('template.template')
@section('contenue')
@section('script')
    <script src="scripts/jquery-1.9.1.min.js"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="scripts/datatables/jquery.dataTables.js"></script>
    <script src="{{ asset('js/test.js') }}" type="text/javascript"></script>

    <script src="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
		$(document).ready(function() {
			$('#myTable').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	
    $('#BtnModal').click(function() {
        $("#lecteur-modal").modal({
            backdrop: false
          });
        $('#lecteur-modal').modal('show');
    });
    </script>
@endsection
        <div class="content span8">
            <div class="module">
                <div class="module-head afficheSuccesMessages">
                    <button id="BtnModal" type="button" class="btn btn-info btn pull-right" style="width: 240px; height: 35px;"><i class="icon-plus-sign icon-large">Ajouter un nouveau Adherent</i></button>    
                </div>
{{--Modall Ajout Lecteur --------------------------------------  --}}
    <div id="lecteur-modal" class="modal fade" role="dialog">
            <div class="modal-dialog  modal-dialog-centered">
              <div class="modal-content">
                <form id="addLecteur"  name="contact" role="form" class="form-horizontal row-fluid" action="{{  route('lecteur.create')  }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                            {{ csrf_field() }}			
                            <div class="control-group">
                                <label class="control-label" for="basicinput">Prenom :</label>
                                <div class="controls">
                                    <input  type="text" name="first_name" id="basicinput" placeholder="votre prenom" >
                                    <div style="color: red; font-size: 12px"></div>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label" for="basicinput">Nom :</label>
                                <div class="controls">
                                    <input  type="text" name="last_name" id="basicinput" placeholder="votre nom" >
                                    <div style="color: red; font-size: 12px"></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="basicinput">Date de Naissance</label>
                                <div class="controls">
                                    <input type="date" name="date_naissance" id="basicinput" >
                                    <div style="color: red; font-size: 12px"></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="basicinput">Telephone</label>
                                    <div class="controls">
                                    <input type="text" name="telephone" id="basicinput" placeholder="77 701 22 80"   >
                                    <div style="color: red; font-size: 12px"></div>
                                </div>
                            </div>				
                            <div class="control-group">
                                <label class="control-label" for="basicinput">Email</label>
                                <div class="controls">
                                    <input  type="email" name="email" name="telephone" id="basicinput" placeholder="exemple@gmail.com">
                                    <div style="color: red; font-size: 12px"></div>
                                </div>
                            </div>
                      </div>
                      <div class="modal-footer">					
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-info"><i class="icon-plus-sign icon-large">Ajouter Admin</i></button>
                      </div>
                </form>
              </div>
            </div>
        </div>
        {{--End--Modall Ajout Lecteur --------------------------------------  --}}
                <div class="module-head">
                    <h3>Tables</h3>
                </div>
                    <table id="myTable" class="table table-striped table-bordered table-condensed">
                    {{-- <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%"> --}}
                      <thead>
                        <tr>
                          <th>Image</th>
                          <th>Prenom</th>
                          <th>Nom</th>
                          <th>Email</th>
                          <th>Telephone</th>
                          <th>Date Inscription</th>
                          <th>Modifier</th>
                          <th>Supprimer</th>
                        </tr>
                      </thead>
                        @foreach ($lecteurs as $lecteur)                                    
                            <tbody>
                                <tr> 
                                    <td><img class="img-thumbnail media-avatar " width="50" src="{{ asset('images/'.$lecteur->avatar) }}"></td>
                                    <td>{{$lecteur->first_name}}</td>
                                    <td>{{$lecteur->last_name}}</td>
                                    <td>{{$lecteur->email}}</td>
                                    <td>{{$lecteur->telephone}}</td>
                                    <td>{{$lecteur->updated_at}}</td>
                                    <td><a  href="{{ route('lecteur.delete', ['id'=>$lecteur->id]) }}" class="btn btn-danger delete"><i class="icon-trash"></i>Supprimer</a></td>
                                   <td> <a  href="{{ route('lecteur.update_index', ['id'=>$lecteur->id]) }}" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-backdrop= "false"><i class="icon-edit"></i>Modifier</a></td>
                                </tr>
                            </tbody>
                            
                       @endforeach
                       <tfoot>
                        <tr>
                          <th>Image</th>
                          <th>Prenom</th>
                          <th>Nom</th>
                          <th>Email</th>
                          <th>Telephone</th>
                          <th>Date Inscription</th>
                          <th>Modifier</th>
                          <th>Supprimer</th>
                        </tr>
                    </tfoot>
                    </table>
                </div>
            </div>  
        </div>
    </div>
      <!-- Modal -->
      <div class="modal fade "  id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
            Exemple de modal
            </div>
            </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            </div>
    @endsection