<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','sub_title','description','slug'];
    // protected $fillable = ['title','sub_title','description','slug','lang','profile_id'];
}
