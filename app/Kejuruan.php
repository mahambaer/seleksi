<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kejuruan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function programs()
    {
        return $this->hasMany('App\Program');
    }

    public function soals()
    {
        return $this->hasMany('App\Soal');
    }
}
