<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityWeather extends Model
{
    protected $fillable = ['timestamp', 'temp', 'pressure', 'humidity'];
}
