<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sitesettings extends Model
{
    use HasFactory;
    protected $table = 'site_settings';
    public $timestamps = false;
}
