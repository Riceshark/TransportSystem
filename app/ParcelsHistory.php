<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ParcelsHistory
 *
 * @package App
 * @property string $enter_time
 * @property string $leave_time
 * @property string $parcel
 * @property string $location
*/
class ParcelsHistory extends Model
{
    use SoftDeletes;

    protected $fillable = ['enter_time', 'leave_time', 'location_address', 'location_latitude', 'location_longitude', 'parcel_id'];
    protected $hidden = [];
    
    

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setEnterTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['enter_time'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['enter_time'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getEnterTimeAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setLeaveTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['leave_time'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['leave_time'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getLeaveTimeAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setParcelIdAttribute($input)
    {
        $this->attributes['parcel_id'] = $input ? $input : null;
    }
    
    public function parcel()
    {
        return $this->belongsTo(Parcel::class, 'parcel_id')->withTrashed();
    }
    
}
