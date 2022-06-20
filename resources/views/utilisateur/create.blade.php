@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ajouter un utilisateur</h1>

        </div>

        <div>
            @if (session()->has('success'))
                <p class="text-success">{{ session('success') }}</p>
                <br>
            @endif
            <form action="{{ route('utilisateur.store') }}" method="post">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label for="nom">Nom de l'utilisateur</label>
                    <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom"
                        aria-describedby="helpId">
                    @error('nom')
                        <small id="helpId" class="text-danger">{{ $message }}</small>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="login">Identifient</label>
                    <input type="text" name="login" id="login" class="form-control"
                        placeholder="Identifiant de connexion" aria-describedby="helpId">
                    @error('login')
                        <small id="helpId" class="text-danger">{{ $message }}</small>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe"
                        aria-describedby="helpId">
                    @error('password')
                        <small id="helpId" class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="type">Type d'utilisateur</label>
                    <select class="form-control" name="type" id="type">
                        <option value="admin">Admin</option>
                        <option value="user">Utilisateur simple</option>
                    </select>
                </div>
                @error('categorie')
                    <small id="helpId" class="text-danger">{{ $message }}</small>
                @enderror

                <br><br>
                <button type="submit" class="btn btn-primary">Ajouter l'utilisateur</button>

            </form>
        </div>

    </div>
@endsection
