<?php

namespace App\Http\Controllers;

use App\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $utilisateurs = Utilisateur::all();
        return view('utilisateur.index', compact('utilisateurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('utilisateur.create');
    }

    public function login()
    {
        // Fonction de connexion
        Request()->validate([
            "login" => "required",
            "password" => "required"
        ]);

        // Verification des informations dans la base de données 
        $user = Utilisateur::where('login',request('login'))->where('password', sha1(Request('password')))->first();

        if(isset($user)){
            // Si l'identifiant et le mot de passe sont correct, on stock la session tout en verifiant le type de l'utilisateur pour rediriger l'utilisateur vers la page correspondant
            session([
                "utilisateur" => $user
            ]);
            if($user->type == "admin"){
                return redirect(route('admin.dashboard'));
            }else{
                return redirect(route('document.user.index'));
            }
        }else{
            return back()->with('error','Identifiant ou mot de passe incorrect');
        }
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
            "nom" => "required",
            "login" => "required|unique:utilisateurs,login",
            "type" => "required",
            "password" => 'required'
        ]);

        // Ajout à la base de données
        $user = new Utilisateur();
        $user->nom = Request('nom');
        $user->login = Request('login');
        $user->password = sha1(Request('password'));
        $user->type = Request('type');
        $user->save();

        return back()->with('success','Utilisateur ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Utilisateur  $utilisateur
     * @return \Illuminate\Http\Response
     */
    public function show(Utilisateur $utilisateur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Utilisateur  $utilisateur
     * @return \Illuminate\Http\Response
     */
    public function edit(Utilisateur $utilisateur)
    {
        return view('utilisateur.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Utilisateur  $utilisateur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Utilisateur $utilisateur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Utilisateur  $utilisateur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Utilisateur $utilisateur)
    {
        $utilisateur->delete();

        return back();
    }
}
