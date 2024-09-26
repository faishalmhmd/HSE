<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mandor extends Model
{
    use HasFactory;
    protected $table = 'mandor';
    protected $fillable = ['nama', 'email','no_hp', 'tgl_lahir','status'];
}
