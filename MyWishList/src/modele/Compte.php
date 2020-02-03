<?php


namespace mywishlist\modele;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compte extends Model
{
    protected $table = 'utilisateur';
    protected $primaryKey = 'id_Utilisateur';
    public $timestamps = false;

    public function items(){
        return $this->hasMany('\mywishlist\modele\Item', 'id_Utilisateur');
    }

    public function messages(){
        return $this->hasMany('\mywishlist\modele\Message', 'id_Utilisateur');
    }

    public function listes(){
        return $this->hasMany('\mywishlist\modele\Liste', 'id_Utilisateur');
    }

}