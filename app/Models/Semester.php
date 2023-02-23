<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    public $table="semesters";
    public $timestamps = true;
    protected $fillable = [
        'id','name','from_date','to_date','status','complete'
    ];
}
