<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    //
    protected $guarded = [];
    public function user()
    {
        return $this->hasMany(User::class, 'user_id');
    }

}
