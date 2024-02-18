<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    use HasFactory;

    protected $table = "tbl_materials";
    
    public function category() {
        return $this->belongsTo('App\Models\category', 'category_id');
    }

}
