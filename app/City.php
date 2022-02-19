<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CityWeather;

class City extends Model
{
    protected $fillable = ['name', 'country', 'lat', 'lon', 'external_id'];

    public function weather()
    {
        return $this->hasMany(CityWeather::class);
    }
}
