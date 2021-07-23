<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelName extends Model
{
    use HasFactory;

    protected $table = "model_names";

    protected $fillable = ['category_id', 'company_id', 'status'];

}
