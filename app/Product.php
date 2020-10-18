<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["barcode","name","category","stock","curr","purchase_price","selling_price","unit", "discount"];
}
