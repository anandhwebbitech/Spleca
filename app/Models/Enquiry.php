<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    //
    const PENDING = 1;
    const PROCESS =2;
    const CONFIRM = 3;
    const COMPLETE = 4;
    const CANCEL =5;
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
