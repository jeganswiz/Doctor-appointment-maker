<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquirydates extends Model
{
    use HasFactory;
    protected $table = 'enquiry_optional_dates';
    public $timestamps = false;
}
