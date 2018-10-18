<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Truck
 *
 * @package App
 * @property string $state
 * @property string $car_model
 * @property string $driver_name
 * @property double $latitude
 * @property double $longitude
 */
class Truck extends Model
{
    use SoftDeletes;

    protected $fillable = ['state', 'car_model', 'driver_name', 'latitude', 'longitude'];
    protected $hidden = [];



    /**
     * Set attribute to date format
     * @param $input
     */
    public function setStateAttribute($input)
    {
        if ($input != '') {
            $this->attributes['state'] = $input;
        } else {
            $this->attributes['state'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setCarModelAttribute($input)
    {
        if ($input != '') {
            $this->attributes['car_model'] = $input;
        } else {
            $this->attributes['car_model'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDriverNameAttribute($input)
    {
        if ($input != '') {
            $this->attributes['driver_name'] = $input;
        } else {
            $this->attributes['driver_name'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setLatitudeAttribute($input)
    {
        $this->attributes['latitude'] = $input ? $input : 0;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setLongitudeAttribute($input)
    {
        $this->attributes['longitude'] = $input ? $input : 0;
    }

}
