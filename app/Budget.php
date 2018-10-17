<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{

    protected $fillable = [
        'value',
        'name',
        'description',
        'date'
        ];
    protected $hidden = [];
}
