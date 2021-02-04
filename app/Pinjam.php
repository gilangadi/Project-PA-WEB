<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    
    protected $table = 'pinjam';
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
        return $this->belongsTo('App\Rak','id_rak','id');
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}