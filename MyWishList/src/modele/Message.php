<?php


namespace mywishlist\modele;


class Message extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'message';
    protected $primaryKey = 'id_message';
    public $timestamps = false ;

    public function liste(){
    return $this->belongsTo('\mywishlist\modele\Liste', 'id_parent');
    }

    public function item(){
    return $this->belongsTo('\mywishlist\modele\Item', 'id_parent');
    }

    public function compte(){
        return $this->belongsTo('\mywishlist\modele\Compte', 'id_utilisateur');
    }
}