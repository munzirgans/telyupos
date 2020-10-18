<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeItemReport extends Model
{
    protected $fillable = ["barcode","quantity","name","datetime","via"];
}
