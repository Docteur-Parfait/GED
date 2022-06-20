<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Pour afficher la liste des documents chez l'admin
        $documents = Document::where('corbeille',false)->get();
        return view('documents.index',compact('documents'));
    }

    public function UserIndex()
    {
        //Pour afficher la liste des documents chez l'utilisateur
        $documents = Document::where('corbeille',false)->get();
        return view('utilisateur.documents.index',compact('documents'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('documents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Request()->validate([
            "nom" => "required|unique:documents,nom",
            "document" => "required|max:2024",
            "categorie" => "required"
        ]);

        // Obtension des information du fichier
        $nom = Request('nom').".".$request->document->extension();

        $format = $request->document->extension();

        // Envoi du fichier dans le dossier public 
        $request->document->move(public_path('document'), $nom);

        // Ajout à la base de données 
        $document = new Document();
        $document->nom = Request('nom');
        $document->categorie = Request('categorie');
        $document->format = $format;
        $document->slug = Str::slug($nom);
        $document->corbeille = false;
        $document->save();

        return back()->with('success','Document ajouté avec succès');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {

        return view('documents.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        return view('documents.edit');
    }

    public function corbeille()
    {
        $documents = Document::where('corbeille',true)->get();
        return view('documents.corbeille',compact('documents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $document)
    {
        $document = Document::find($document);
        if ($document->corbeille == false) {
            $document->corbeille = true;
        }else{
            $document->corbeille = false;
        }
        
        $document->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $document->delete();

        return back();
    }
}
