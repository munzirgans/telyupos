<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ["id_invoice", "name", "quantity", "price", "discount", "additional_discount", "cash", "change_cash", "datetime"];
}
