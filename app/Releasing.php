<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Releasing
 *
 * @package App
 * @property string $project_number
 * @property string $release_number
 * @property string $warehouse
 * @property string $client
 * @property string $contact_person
 * @property string $released_by
 * @property string $project_manager
 * @property string $date
 * @property double $area_coverd
 * @property string $prepared_by
*/
class Releasing extends Model
{
    use SoftDeletes;

    protected $fillable = ['release_number', 'date', 'area_coverd', 'prepared_by', 'project_number_id', 'warehouse_id', 'client_id', 'contact_person_id', 'released_by_id', 'project_manager_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Releasing::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProjectNumberIdAttribute($input)
    {
        $this->attributes['project_number_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setWarehouseIdAttribute($input)
    {
        $this->attributes['warehouse_id'] = $input ? $input : null;
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
     * Set to null if empty
     * @param $input
     */
    public function setContactPersonIdAttribute($input)
    {
        $this->attributes['contact_person_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setReleasedByIdAttribute($input)
    {
        $this->attributes['released_by_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProjectManagerIdAttribute($input)
    {
        $this->attributes['project_manager_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateAttribute($input)
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
    public function setAreaCoverdAttribute($input)
    {
        if ($input != '') {
            $this->attributes['area_coverd'] = $input;
        } else {
            $this->attributes['area_coverd'] = null;
        }
    }
    
    public function project_number()
    {
        return $this->belongsTo(TimeEntry::class, 'project_number_id');
    }
    
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id')->withTrashed();
    }
    
    public function client()
    {
        return $this->belongsTo(TimeProject::class, 'client_id');
    }
    
    public function contact_person()
    {
        return $this->belongsTo(ClientContact::class, 'contact_person_id')->withTrashed();
    }
    
    public function released_by()
    {
        return $this->belongsTo(Employee::class, 'released_by_id')->withTrashed();
    }
    
    public function project_manager()
    {
        return $this->belongsTo(Employee::class, 'project_manager_id')->withTrashed();
    }
    
    public function received_items() {
        return $this->hasMany(ReceivedItem::class, 'release_number_id');
    }
}
