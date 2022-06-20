@extends('layouts.admin')

@section("content")
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Liste des documents</h1>
   

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nom du document</th>
                            <th>Format</th>
                            <th>Catégorie</th>
                            <th>Date d'ajout</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Nom du document</th>
                            <th>Format</th>
                            <th>Catégorie</th>
                            <th>Date d'ajout</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($documents as $document)
                            <tr>
                                <td>{{ $document->id }}</td>
                                <td>{{ $document->nom }}</td>
                                <td>{{ $document->format }}</td>
                                <td>{{ $document->categorie }}</td>
                                <td>{{ $document->created_at }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <a href="{{ asset('document/'.$document->nom.".".$document->format) }}" class="btn btn-sm btn-info" download>Télécharger</a>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <form action="{{ route('documents.update',$document->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                            <button class="btn btn-sm btn-danger" type="submit">Supprimer</button>
                                            </form>
                                            
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        
                     
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection