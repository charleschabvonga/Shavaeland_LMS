<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class TimeEntry
 *
 * @package App
 * @property string $operation_number
 * @property string $entry_date
 * @property string $client
 * @property string $start_time
 * @property string $end_time
 * @property enum $status
*/
class TimeEntry extends Model
{
    protected $fillable = ['operation_number', 'entry_date', 'start_time', 'end_time', 'status', 'client_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        TimeEntry::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_status = ["Pending" => "Pending", "Open" => "Open", "In Progress" => "In Progress", "Closed" => "Closed"];

    public function getStatusAttribute($input)
    {
        if ($this->attributes['end_time'] == '') {
            $status = "In progress";
        }
        if ($this->attributes['end_time'] != '') {
            $status = "Closed";
        }
        if ($this->attributes['start_time'] == '') {
            $status = "Pending";
        }

        /*foreach($this->road_freights as $item){
            $status = "Open";
        } */
        foreach($this->invoice as $item){
            if ($item->balance > 0) {
                $status = "In progress";
            }
            if ($item->balance == 0) {
                $status = "Closed";
            }
        }    
        return $status;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setEntryDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['entry_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['entry_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getEntryDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setClientIdAttribute($input)
    {
        $this->attributes['client_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setStartTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['start_time'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['start_time'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getStartTimeAttribute($input)
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
    public function setEndTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['end_time'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['end_time'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getEndTimeAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }
    
    public function work_type()
    {
        return $this->belongsToMany(TimeWorkType::class, 'time_entry_time_work_type');
    }

   public function project()
    {
        return $this->belongsTo(TimeProject::class, 'client_id');
    }
    
    public function client()
    {
        return $this->belongsTo(TimeProject::class, 'client_id');
    }

    public function road_freights() {
        return $this->hasMany(RoadFreight::class, 'project_number_id');
    }

    public function invoice() {
        return $this->hasMany(IncomeCategory::class, 'project_number_id');
    }
    
}
