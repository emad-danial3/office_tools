<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    public $table="orders";
    public $timestamps = true;
    protected $fillable = [
        'EMAIL_ADDRESS', 'EMPLOYEE_ID','LAST_NAME', 'semester_id','department_id','status','hash_code'
    ];

    public function OrderProducts()
    {
        return $this->hasMany('App\Models\OrderProducts','order_id','id');
    }

    public function semester()
    {
        return $this->belongsTo('App\Models\Semester','semester_id','id');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\Department','department_id','id');
    }
}
