<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rendezvous extends Model
{
    use HasFactory;
    protected $fillable = array('medecins_id','user_id','libelle', 'date');
    public static $rules = array('medecins_id' => 'required|integer',
                                 'user_id' => 'required|bigInteger',
                                 'libelle' => 'required|min:20',
                                 'date' => 'required|min:3');

    public function rendezvous(){

        return $this->belongsTo('App\Medecin');
    }
}
