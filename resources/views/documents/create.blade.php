@extends('layouts.admin')

@section("content")
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ajouter un document</h1>
        
    </div>

    <div>
        @if (session()->has('success'))
            <p class="text-success">{{ session('success') }}</p>
            <br>
        @endif
        <form action="{{ route('documents.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
              <label for="nom">Nom du document</label>
              <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom du document" aria-describedby="helpId">
              @error('nom')
                  <small id="helpId" class="text-danger">{{ $message }}</small>
              @enderror
              
            </div>
            <br>
            <div class="form-group">
              <label for="categorie">Catégorie de document</label>
              <select class="form-control" name="categorie" id="categorie">
                <option>Categorie 1</option>
                <option>Categorie 2</option>
                <option>Categorie 3</option>
              </select>
            </div>
            @error('categorie')
                  <small id="helpId" class="text-danger">{{ $message }}</small>
              @enderror
            <br>
            <div class="custom-file">
                <input id="document" class="custom-file-input" type="file" name="document">
                <label for="document" class="custom-file-label">Importer le document</label>
                @error('document')
                  <small id="helpId" class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            
            <br><br><br>
            <button type="submit" class="btn btn-primary">Ajouter le document</button>
        </form>
    </div>

</div>

@endsection