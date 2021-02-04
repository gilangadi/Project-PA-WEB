<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Koleksi extends Model
{
    
    protected $table = 'koleksi';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user','id_rak'
    ];
    
    public function user(){

        return $this->belongsTo('App\User','id_user');
    }

    public function rak(){

        return $this->belongsTo('App\Rak','id_rak');
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}