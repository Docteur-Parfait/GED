@extends('layouts.admin')

@section("content")
<h1 class="h3 mb-2 text-gray-800">Liste des utilisateurs</h1>
   

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nom de l'utilisateur</th>
                            <th>Identifiant</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Nom de l'utilisateur</th>
                            <th>Identifiant</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($utilisateurs as $utilisateur)
                            <tr>
                                <td>{{ $utilisateur->id }}</td>
                                <td>{{ $utilisateur->nom }}</td>
                                <td>{{ $utilisateur->login }}</td>
                                <td>{{ $utilisateur->type }}</td>
                                <td>
                                    <div class="row">
                                       
                                        
                                        <div class="col-lg-6">
                                            <form action="{{ route('utilisateur.destroy',$utilisateur->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
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
@endsection