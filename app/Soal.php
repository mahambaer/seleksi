<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'link', 'kejuruan_id', 'program_id'
    ];

    public function kejuruan()
    {
        return $this->belongsTo('App\Kejuruan');
    }

    public function jawabans()
    {
        return $this->hasMany('App\Jawaban');
    }

    public function programs()
    {
        return $this->belongsToMany('App\Program');
    }

    // public function program()
    // {
    //     return $this->belongsTo('App\Program');
    // }
}
