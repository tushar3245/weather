<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherObservation extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'weather_observations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_time',
        'parameter_name',
        'parameter_value',
        // Add other fillable fields as needed
    ];
}
