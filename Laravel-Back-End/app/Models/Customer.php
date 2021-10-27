<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table= 'customer'; 
    protected $primaryKey = 'cust_ID';
    protected $fillable = [
        'cust_ID',
        'interview_ID',
        'custname',
        'custscore',
        'custocc',
        'cust_phone_num',
        'custemail',
    ];
}
