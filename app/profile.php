<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\user;

class profile extends Model
{
    protected $table='profiles';
    protected $fillable=['name','surname','age',
    'image','department','description'];
}
