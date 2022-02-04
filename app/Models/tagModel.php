<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tagModel extends Model
{
    use HasFactory;
    protected $table="tagtable";
    protected $fillable = ["fashion","technology","personal_blog","innovation_idea"];
}
