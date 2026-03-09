<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $guarded = [];

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

public function features() {
    return $this->hasMany(ProductFeature::class);
}

public function files() {
    return $this->hasMany(ProductFile::class);
}

public function reviews() {
    return $this->hasMany(ProductReview::class);
}

public function category() {
    return $this->belongsTo(SubCategory::class);
}
public function resources()
{
    return $this->hasMany(ProductResource::class, 'product_id');
}

public function datasheets()
{
    return $this->hasMany(ProductResource::class)
        ->where('type', 'datasheet')
        ->where('status', 1);
}

public function brochures()
{
    return $this->hasMany(ProductResource::class)
        ->where('type', 'brochure')
        ->where('status', 1);
}

public function videos()
{
    return $this->hasMany(ProductResource::class)
        ->where('type', 'video')
        ->where('status', 1);
}
}
