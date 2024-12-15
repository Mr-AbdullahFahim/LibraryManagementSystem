<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Members extends Model
{
    use HasFactory;

    protected $table = 'members';

    protected $fillable = ['name','email','phone','address','membership_deadline'];
}
// $table->string('name');
// $table->string('email')->unique();
// $table->string('phone', 20);
// $table->text('address')->nullable();
// $table->date('membership_date');
// $table->enum('status', ['active', 'inactive'])->default('active');