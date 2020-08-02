<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'score', 'status', 'token', 'program_id'
    ];

    public function program()
    {
        return $this->belongsTo('App\Program');
    }
}
