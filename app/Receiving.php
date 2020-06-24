<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

/**
 * Class Receiving
 *
 * @package App
 * @property string $date
 * @property string $project_number
 * @property string $receipt_number
 * @property string $warehouse
 * @property string $client
 * @property string $contact_person
 * @property string $received_by
 * @property string $project_manager
 * @property double $total_area_coverd
 * @property double $rate
 * @property double $days
 * @property double $total_amount
 * @property string $prepared_by
*/
class Receiving extends Model
{
    use SoftDeletes;

    protected $fillable = ['rate', 'days', 'total_amount', 'date', 'receipt_number', 'total_area_coverd', 'prepared_by', 'project_number_id', 'warehouse_id', 'client_id', 'contact_person_id', 'received_by_id', 'project_manager_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Receiving::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
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
    public function setReceivedByIdAttribute($input)
    {
        $this->attributes['received_by_id'] = $input ? $input : null;
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
    public function setTotalAreaCoverdAttribute($input)
    {
        if ($input != '') {
            $this->attributes['total_area_coverd'] = $input;
        } else {
            $this->attributes['total_area_coverd'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setRateAttribute($input)
    {
        if ($input != '') {
            $this->attributes['rate'] = $input;
        } else {
            $this->attributes['rate'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDaysAttribute($input)
    {
        if ($input != '') {
            $this->attributes['days'] = $input;
        } else {
            $this->attributes['days'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setTotalAmountAttribute($input)
    {
        if ($input != '') {
            $this->attributes['total_amount'] = $input;
        } else {
            $this->attributes['total_amount'] = null;
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
    
    public function received_by()
    {
        return $this->belongsTo(Employee::class, 'received_by_id')->withTrashed();
    }
    
    public function project_manager()
    {
        return $this->belongsTo(Employee::class, 'project_manager_id')->withTrashed();
    }
    
    public function received_items() {
        return $this->hasMany(ReceivedItem::class, 'receipt_number_id');
    }
}
