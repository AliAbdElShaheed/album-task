<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
    ];


    // The Relationship With Category Model
    public function category()
    {
        return $this->belongsTo(Category::class);
    } // End of Category Relationship

    protected $appends = ['image_path'];


    // Get The Image Path To Show It in The Product Index Page
    public function getImagePathAttribute()
    {
        return asset('uploads/products_img/' . $this->image);
    } // End of Get Image Path


} // End of Model
