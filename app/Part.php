<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Part
 *
 * @package App
 * @property string $repair_center
 * @property string $part
 * @property double $qty
 * @property string $unit
 * @property double $status
*/
class Part extends Model
{
    use SoftDeletes;

    protected $fillable = ['part', 'qty', 'status ', 'repair_center_id', 'unit_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Part::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_status = ["Available" => "Available", "Unavailable" => "Unavailable", "Required" => "Required"];

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPartAttribute($input)
    {
        $this->attributes['part'] = $input ? $input : null;
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

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUnitIdAttribute($input)
    {
        $this->attributes['unit_id'] = $input ? $input : null;
    }

    public function getQtyAttribute(){
        $purchases = $this->attributes['qty'];
        foreach($this->purchases as $item){
            if ($item->transaction_type === 'Procurement'){
                $purchases += $item->qty;
            }
            if ($item->transaction_type === 'Request'){
                $purchases -= $item->qty;
            }
        }
        return $purchases;
    }

    public function getStatusAttribute(){
        $purchases = $this->attributes['qty'];
        $status = 'Unavailable';
        foreach($this->purchases as $item){
            if ($item->transaction_type === 'Procurement'){
                    $purchases += $item->qty;
                if($purchases == 0 ){
                    $status = 'Unavailable';
                }
                if($purchases < 0 ){
                    $status = 'Required';
                }
                if($purchases > 0 ){
                    $status = 'Available';
                }
            }

            if ($item->transaction_type === 'Request'){
                    $purchases -= $item->qty;
                if($purchases == 0 ){
                    $status = 'Unavailable';
                }
                if($purchases < 0 ){
                    $status = 'Required';
                }
                if($purchases > 0 ){
                    $status = 'Available';
                }
            }
            
        }
        return $status;
    }
    
    public function repair_center()
    {
        return $this->belongsTo(Workshop::class, 'repair_center_id')->withTrashed();
    }

    public function unit()
    {
        return $this->belongsTo(UnitMeasurement::class, 'unit_id')->withTrashed();
    }

    public function purchases() {
        return $this->hasMany(PartsAcquired::class, 'part_id');
    }    
}
