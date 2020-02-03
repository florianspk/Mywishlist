<?php

namespace mywishlist\modele;

use Illuminate\Database\Eloquent;

class Item extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'item';
    protected $primaryKey = 'id';
    public $timestamps = false ;

    public function liste(){
        return $this->belongsTo('\mywishlist\modele\Liste', 'liste_id');
    }

    public function comptes(){
        return $this->belongsTo('\mywishlist\modele\Compte', 'id_Utilisateur');
    }

    public function messages(){
        return $this->hasMany('\mywishlist\modele\Message','id_parent');
    }
}