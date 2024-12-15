<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $table="books";

    protected $fillable=['title','author','genre','published_year','isbn','count','cover_image'];
}
// $table->string('title');
// $table->string('author');
// $table->string('genre')->nullable();
// $table->year('published_year')->nullable();
// $table->string('isbn')->unique();
// $table->integer('count')->default(1);