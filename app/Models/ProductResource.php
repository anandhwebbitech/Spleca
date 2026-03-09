<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductResource extends Model
{
    //
       protected $guarded = [];   

    /* ---------- RELATION ---------- */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /* ---------- ACCESSORS ---------- */

    // Full file URL
    public function getFileUrlAttribute()
    {
        if (!$this->file) {
            return null;
        }

        return asset('uploads/products/resources/' . $this->file);
    }

    // Human readable size
    public function getFileSizeTextAttribute()
    {
        if (!$this->file_size) {
            return null;
        }

        return $this->file_size >= 1024
            ? round($this->file_size / 1024, 2) . ' MB'
            : $this->file_size . ' KB';
    }

    /* ---------- SCOPES ---------- */

    public function scopeDatasheets($query)
    {
        return $query->where('type', 'datasheet');
    }

    public function scopeBrochures($query)
    {
        return $query->where('type', 'brochure');
    }

    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }
}
