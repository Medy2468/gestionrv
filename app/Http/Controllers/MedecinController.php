<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use Illuminate\Http\Request;

class MedecinController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function add(){

        return view('medecin.add');
    }
    public function getAll(){

        $liste_medecins = Medecin::paginate(2); // equivaut de : select * from medecin limit 2;
        //$liste_medecins = Medecin::all(); // equivaut select * from medecin;
        return view('medecin.list',['liste_medecins' => $liste_medecins]);
    }
    public function edit($id){

        $medecin = Medecin::find($id);
        return view('medecin.edit',['medecin' => $medecin]);
    }
    public function update(Request $request){
        // Recupère les informations à partir de la base de donnée
        $medecin = Medecin::find($request->id);
        $medecin->nom = $request->nom;
        $medecin->prenom = $request->prenom;
        $medecin->telephone = $request->telephone;

        $result = $medecin->save(); // 1 ou 0
        return $this->getAll();
    }
    public function delete($id){

        $medecin = Medecin::find($id); // equivaut de : select * from medecin where $id=$id; 
        if($medecin != null)
        {
           $medecin->delete();
        }
        return $this->getAll();
    }
    public function persist(Request $request){


        $medecin = new Medecin(); 
        $medecin->nom = $request->nom;
        $medecin->prenom = $request->prenom;
        $medecin->telephone = $request->telephone;

        $result = $medecin->save(); // 1 ou 0

        return view('medecin.add',['confirmation' => $result]);
        //return $this->getAll(); // Une fois enregistré il reste sur la page d'enregistrement

    }
}
