<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    
    protected $table = 'rak';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'judul', 
        'pengarang',
        'tahun_terbit', 
        'urlimages',
        'urlpdf',
        'status',
        'status_buku_jurnal'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
