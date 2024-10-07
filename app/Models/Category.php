<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory , SoftDeletes;
    
    protected $fillable = ['name' , 'parent_id' , 'description' , 'image' , 'status' , 'slug'];
    
    public static function rules(){
        return [
            'name' => 'required|string|min:3|max:255|unique:categories,name',
            'parent_id' => ['nullable', 'int', 'exists:categories,id'],
            'image' => ['image', 'max:1048576'],
            'status'=> 'in:active,archived',
        ];
    }

    public function parent(){
      
        return $this->belongsTo(Category::class , 'parent_id', 'id')
               ->withDefault([
                'name' => '-',
               ]);
    }

    public function children(){
      
        return $this->hasMany(Category::class , 'parent_id', 'id');
    }


    public function products(){

        return $this->hasMany(Product::class, 'category_id', 'id');
    }

   
}
