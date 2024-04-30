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
    use HasTranslations;


    public $translatable = [
        'name',
        'description',
    ];

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'image',
        'purchase_price',
        'sale_price',
        'stock',
    ];


    // The Relationship With Category Model
    public function category()
    {
        return $this->belongsTo(Category::class);
    } // End of Category Relationship

    protected $appends = ['image_path', 'profit_percent'];


    // Get The Image Path To Show It in The Product Index Page
    public function getImagePathAttribute()
    {
        return asset('uploads/products_img/' . $this->image);
    } // End of Get Image Path


    // Get The Profit Percentage
    public function getProfitPercentAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = $profit * 100 / $this->purchase_price;
        return number_format($profit_percent, 2);
    } // End of Get The Profit Percentage

} // End of Model
