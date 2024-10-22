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
        'name',
        'slug',
        'description',
        'image',
        'category_id',
        'store_id',
        'price',
        'compare_price',
        'status',
    ];

    protected $hidden = [
        'created_at' , 'updated_at' , 'deleted_at', 'image',
    ];

    protected $appends = [
        'image_url',
    ];


    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope());
        
        static::creating(function(Product $product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function category()
    {

        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store()
    {

        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id', 'id', 'id');
    }

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }
    //Accessors
    public function getImageUrlAttribute()
    {

        if (!$this->image) {
            return 'https://agrimart.in/uploads/vendor_banner_image/default.jpg';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }

    public function getSalePercentAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }
        return number_format(100 - (100 * $this->price / $this->compare_price), 2);
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $options = array_merge([

            'store_id' => null,
            'category_id' => null,
            'tag_id' => null,
            'status' => 'active',

        ], $filters);

        $builder->when([$options['status']], function ($builder, $status) {
            $builder->where('status', $status);
        });
        $builder->when($options['store_id'], function ($builder, $value) {
            $builder->where('store_id', $value);
        });

        $builder->when($options['category_id'], function ($builder, $value) {
            $builder->where('category_id', $value);
        });

        $builder->when($options['tag_id'], function($builder, $value) {

            $builder->whereExists(function($query) use ($value) {
                $query->select(1)
                    ->from('product_tag')
                    ->whereRaw('product_id = products.id')
                    ->where('tag_id', $value);
            });
            // $builder->whereRaw('id IN (SELECT product_id FROM product_tag WHERE tag_id = ?)', [$value]);
            // $builder->whereRaw('EXISTS (SELECT 1 FROM product_tag WHERE tag_id = ? AND product_id = products.id)', [$value]);
            
            // $builder->whereHas('tags', function($builder) use ($value) {
            //     $builder->where('id', $value);
            // });
        });
    }
}