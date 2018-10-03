<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Parcel
 *
 * @package App
 * @property string $state
 * @property double $height
 * @property double $width
 * @property double $length
 * @property double $weight
 * @property string $delivery_type
 * @property double $cost
 * @property string $location
 * @property string $origin
 * @property string $destination
 * @property tinyInteger $insurance
 * @property integer $priority
 * @property string $delivery_time
*/
class Parcel extends Model
{
    use SoftDeletes;

    protected $fillable = ['state', 'height', 'width', 'length', 'weight', 'delivery_type', 'cost', 'insurance', 'priority', 'delivery_time', 'location_address', 'location_latitude', 'location_longitude', 'origin_address', 'origin_latitude', 'origin_longitude', 'destination_address', 'destination_latitude', 'destination_longitude'];
    protected $hidden = [];
    
    

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setHeightAttribute($input)
    {
        if ($input != '') {
            $this->attributes['height'] = $input;
        } else {
            $this->attributes['height'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setWidthAttribute($input)
    {
        if ($input != '') {
            $this->attributes['width'] = $input;
        } else {
            $this->attributes['width'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setLengthAttribute($input)
    {
        if ($input != '') {
            $this->attributes['length'] = $input;
        } else {
            $this->attributes['length'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setWeightAttribute($input)
    {
        if ($input != '') {
            $this->attributes['weight'] = $input;
        } else {
            $this->attributes['weight'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setCostAttribute($input)
    {
        if ($input != '') {
            $this->attributes['cost'] = $input;
        } else {
            $this->attributes['cost'] = null;
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPriorityAttribute($input)
    {
        $this->attributes['priority'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDeliveryTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['delivery_time'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['delivery_time'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDeliveryTimeAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }
    
}
