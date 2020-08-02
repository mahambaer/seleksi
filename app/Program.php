<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'durasi', 'status', 'kejuruan_id'
    ];

    public function kejuruan()
    {
        return $this->belongsTo('App\Kejuruan');
    }

    public function pesertas()
    {
        return $this->hasMany('App\Peserta');
    }

    public function soals()
    {
        return $this->belongsToMany('App\Soal');
        //return $this->hasMany('App\Soal');
    }
}
