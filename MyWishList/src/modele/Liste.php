<?php


namespace mywishlist\modele;
use Illuminate\Database\Eloquent;

class Liste extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'liste';
    protected $primaryKey = 'no';
    public $timestamps = false ;

    public function items(){
        return $this->hasMany('\mywishlist\modele\Item','liste_id');
    }

    public function messages(){
        return $this->hasMany('\mywishlist\modele\Message','id_parent');
    }

    public function addItem(Item $item) {
        $item->liste_id = $this->id;
    }

    public function addItems($items){
        foreach ($items as $item)
            $this->addItem($item);
    }
}