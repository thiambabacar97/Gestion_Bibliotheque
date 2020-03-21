@extends('template.template')
@section('contenue')
@section('script')
    <script src="{{ asset('js/gestion_pret.js') }}" ></script>
@endsection
<div class="module">
    <div class="module-head" >
        <h3>Livres Preter</h3>
    </div>
    @if (session('success'))
    <div class="alert alert-success ">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{session('success')}}
    </div>
@endif
@if (session('danger'))
    <div class="alert alert-danger ">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{session('danger')}}
    </div>
@endif
    <div class="module-body table">
            <table  cellpadding="0" cellspacing="0" class="datatable-1 table table-bordered table-stripe display data-table "  style="border: 0;width: 100%">
                <thead>
                    <tr lass="odd gradeX">
                        <th>Numero Inventaire</th>
                        <th>Titre Livre</th>
                        <th>Auteur</th>
                        <th>Lecteur </th>
                        <th>Date Emprunt </th>
                        <th>Date Retour </th>
                        <th width="160px">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
