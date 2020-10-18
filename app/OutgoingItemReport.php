<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutgoingItemReport extends Model
{
    protected $fillable = ["name","quantity","datetime","via","barcode"];
}
