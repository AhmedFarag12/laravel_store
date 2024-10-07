<?php

namespace App\Models;

use App\Models\Store;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'image', 'category_id', 'store_id',
        'price', 'compare_price', 'status',
    ];
    protected static function booted(){

        static::addGlobalScope('store' , new StoreScope());
    }

    public function category(){
        
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function store(){
        
        return $this->belongsTo(Store::class,'store_id','id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'product_tag','product_id','tag_id','id','id');
    }

    public function scopeActive(Builder $builder){
        $builder->where('status', '=' ,'active');
    }
     //Accessors
     public function getImageUrlAttribute(){

        if (!$this->image) {
            return 'https://agrimart.in/uploads/vendor_banner_image/default.jpg';   
        }
        if(Str::startsWith($this->image, ['http://','https://'])){
            return $this->image;
        }
        return asset('storage/' . $this->image);
       
     }

     public function getSalePercentAttribute(){
        if (!$this->compare_price) {
            return 0;

        }
        return number_format(100 - (100 * $this->price / $this->compare_price), 2) ;
     }
}
