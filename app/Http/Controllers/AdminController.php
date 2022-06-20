<?php

namespace App\Http\Controllers;

use App\Document;
use App\Utilisateur;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $documents = Document::where('corbeille', false)->get();
        $corbeilles = Document::where('corbeille', true)->get();
        $utilisateurs = Utilisateur::where('type', 'user')->get();
        $admins = Utilisateur::where('type', 'admin')->get();
        return view('utilisateur.dashboard', compact('documents','corbeilles','utilisateurs','admins'));
    }
}
