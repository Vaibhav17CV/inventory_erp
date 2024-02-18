<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    use HasFactory;

    protected $table = "tbl_stocks";

    public function category() {
        return $this->belongsTo('App\Models\category', 'category_id');
    }

    public function material() {
        return $this->belongsTo('App\Models\Materials', 'material_id');
    }
}
