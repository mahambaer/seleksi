<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'link', 'status', 'soal_id', 'tipe'
    ];

    public function soal()
    {
        return $this->belongsTo('App\Soal');
    }
}
