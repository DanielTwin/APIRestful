<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use App\Scopes\BuyerScope;
use App\Transformers\BuyerTransformer;



class Buyer extends User
{
    use HasFactory;

    public $transformer = BuyerTransformer::class;


    protected static function boot()
    {
        
        parent::boot();

        static::addGlobalScope(new BuyerScope);

    }

    public function transations(){

        return $this->hasMany(Transaction::class);

    }

}
