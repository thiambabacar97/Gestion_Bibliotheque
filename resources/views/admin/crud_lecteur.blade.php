@extends('template.template')
@section('contenue')
@section('script')
<script src="{{ asset('js/crud_lecteur.js') }}" ></script>
@endsection

    <div class="module">
        <div class="module-head afficheSuccesMessages">
        <h3>Liste des utilisateurs</h3>
        <button id="BtnModal" type="button" data-backdrop="false"  class="btn btn-info btn pull-right" style="width: 240px; height: 35px; margin-top: -26px" data-toggle="modal" data-target="#ajaxModel"><i class="icon-plus-sign icon-large">Ajouter un nouveau Adherent</i></button>

    </div>
    <div class="module-body table">
            <table  cellpadding="0" cellspacing="0" class="datatable-1 table table-bordered table-stripe display data-table "  style="border: 0;width: 100%">
                <thead>
                    <tr lass="odd gradeX">
                        <th>Prenom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th width="90px">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
{{--  --}}
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">

                <form id = "productForm" name = "productForm" class="form-horizontal row-fluid" >
                            {{ csrf_field() }}
                            <input type="hidden" name="product_id" id="product_id">
                            <div class="control-group">
                                <label class="control-label" for="basicinput">Prenom :</label>
                                <div class="controls">
                                    <input  type="text" name="first_name" id="first_name" placeholder="votre prenom" >
                                    <div style="color: red; font-size: 9px"></div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="basicinput">Nom :</label>
                                <div class="controls">
                                    <input  type="text" name="last_name" id="last_name" placeholder="votre nom" >
                                    <div style="color: red; font-size: 9px"></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="basicinput">Date de Naissance</label>
                                <div class="controls">
                                    <input type="date" name="date_naissance" id="date_naissance" >
                                    <div style="color: red; font-size: 9px"></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="basicinput">Telephone</label>
                                    <div class="controls">
                                    <input type="text" name="telephone" id="telephone" placeholder="77 701 22 80">
                                    <div style="color: red; font-size: 9px"></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="basicinput">Email</label>
                                <div class="controls">
                                    <input  type="email" name="email"  id="email" placeholder="exemple@gmail.com">
                                    <div style="color: red; font-size: 9px"></div>
                                </div>
                            </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes </button>

                      </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>



@endsection
