<?php

namespace App\Http\Controllers;


use App\Models\Medecin;
use App\Models\Rendezvous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RendezvousController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function add(){

        $medecins = Medecin::all();
        return view('rendezvous.add',['medecins' => $medecins]);
    }
    public function getAll(){

        //$liste_rendezvous = Medecin::paginate(2); // equivaut de : select * from medecin limit 2;
        $liste_rendezvous = Rendezvous::all(); // equivaut select * from medecin;
        return view('rendezvous.list',['liste_rendezvous' => $liste_rendezvous]);
    }
    public function edit($id){

        $rendezvous = Rendezvous::find($id);
        return view('rendezvous.edit',['rendezvous' => $rendezvous]);
    }
    public function update(Request $request){
        // Recupère les informations à partir de la base de donnée
        $rendezvous =  Medecin::find($request->id); 
        $rendezvous->libelle = $request->libelle;
        $rendezvous->date = $request->date;
        $rendezvous->medecins_id = $request->medecins_id;
        $rendezvous->user_id = Auth::id();

        $result = $rendezvous->save(); // 1 ou 0
        return redirect('/rendezvous/getAll');
    }
    public function delete($id){

        $rendezvous = Rendezvous::find($id); // equivaut de : select * from medecin where $id=$id; 
        if($rendezvous != null)
        {
           $rendezvous->delete();
        }
        return redirect('/rendezvous/getAll');
    }
    public function persist(Request $request){


        $rendezvous = new Rendezvous(); 
        $rendezvous->libelle = $request->libelle;
        $rendezvous->date = $request->date;
        $rendezvous->medecins_id = $request->medecins_id;
        $rendezvous->user_id = Auth::id();

        $result = $rendezvous->save(); // 1 ou 0
        $medecins = Medecin::all();
        return view('medecin.add',['confirmation' => $result, 'medecins' => $medecins]);
        //return $this->getAll(); // Une fois enregistré il reste sur la page d'enregistrement

    }
}
