<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Seller;
use App\Models\Transaction;
use App\Transformers\ProductTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    const PRODUCT_AVAILABLE = 'available';
    const PRODUCT_NOT_AVAILABLE = 'not available';
    
    public $transformer = ProductTransformer::class;

    protected $dates = ['deleted_at'];

    protected $fillable = [

        'name',
    	'description',
    	'quantity',
    	'status',
    	'image',
    	'seller_id',

    ];

    public function available()
    {
    	return $this->status == Product::PRODUCT_AVAILABLE;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }   

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
