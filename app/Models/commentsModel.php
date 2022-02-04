<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commentsModel extends Model
{
    use HasFactory;
    protected $table="usercomments";
    protected $fillable = ["comment"];
}
