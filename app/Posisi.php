<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{
    protected $table = "posisi";

    public function user(){
        return $this->belongsToMany(User::class);
    }
}
