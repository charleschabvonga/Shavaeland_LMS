<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PartsAcquired
 *
 * @package App
 * @property string $repair_center
 * @property string $transaction_type
 * @property string $received_by
 * @property string $dispatched_by
 * @property string $prepared_by
 * @property string $order_number
 * @property string $date
 * @property string $part
 * @property double $qty
 * @property string $unit
 * @property double $unit_price
 * @property double $total
*/
class PartsAcquired extends Model
{
    use SoftDeletes;

    protected $fillable = ['prepared_by', 'order_number', 'date', 'qty','unit_price','total', 'unit_id', 'repair_center_id', 'part_id', 'transaction_type', 'received_by_id', 'dispatched_by_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        PartsAcquired::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_transaction_type = ["Procurement" => "Procurement", "Request" => "Request"];

    /**
     * Set to null if empty
     * @param $input
     */
    public function setOrderNumberAttribute($input)
    {
        $this->attributes['order_number'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPreparedByAttribute($input)
    {
        $this->attributes['prepared_by'] = $input ? $input : null;
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
    public function setDispatchedByIdAttribute($input)
    {
        $this->attributes['dispatched_by_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRepairCenterIdAttribute($input)
    {
        $this->attributes['repair_center_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUnitIdAttribute($input)
    {
        $this->attributes['unit_id'] = $input ? $input : null;
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
    public function setPartIdAttribute($input)
    {
        $this->attributes['part_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setQtyAttribute($input)
    {
        if ($input != '') {
            $this->attributes['qty'] = $input;
        } else {
            $this->attributes['qty'] = null;
        }
    }
    
    public function repair_center()
    {
        return $this->belongsTo(Workshop::class, 'repair_center_id')->withTrashed();
    }
    
    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id')->withTrashed();
    }

    public function received_by()
    {
        return $this->belongsTo(Employee::class, 'received_by_id')->withTrashed();
    }

    public function dispatched_by()
    {
        return $this->belongsTo(Employee::class, 'dispatched_by_id')->withTrashed();
    }

    public function unit()
    {
        return $this->belongsTo(UnitMeasurement::class, 'unit_id')->withTrashed();
    }
    
}
