<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LoadDescription
 *
 * @package App
 * @property string $description
 * @property double $qty
 * @property double $weight_volume
 * @property string $loading_instruction_number
 * @property string $delivery_instruction_number
 * @property string $air_freight_number
 * @property string $rail_freight_number
 * @property string $sea_freight_number
*/
class LoadDescription extends Model
{
    use SoftDeletes;

    protected $fillable = ['description', 'qty', 'weight_volume', 'loading_instruction_number_id', 'delivery_instruction_number_id', 'air_freight_number_id', 'rail_freight_number_id', 'sea_freight_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        LoadDescription::observe(new \App\Observers\UserActionsObserver);
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
     * Set attribute to date format
     * @param $input
     */
    public function setWeightVolumeAttribute($input)
    {
        if ($input != '') {
            $this->attributes['weight_volume'] = $input;
        } else {
            $this->attributes['weight_volume'] = null;
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setLoadingInstructionNumberIdAttribute($input)
    {
        $this->attributes['loading_instruction_number_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setDeliveryInstructionNumberIdAttribute($input)
    {
        $this->attributes['delivery_instruction_number_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setAirFreightNumberIdAttribute($input)
    {
        $this->attributes['air_freight_number_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRailFreightNumberIdAttribute($input)
    {
        $this->attributes['rail_freight_number_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setSeaFreightNumberIdAttribute($input)
    {
        $this->attributes['sea_freight_number_id'] = $input ? $input : null;
    }
    
    public function loading_instruction_number()
    {
        return $this->belongsTo(LoadingInstruction::class, 'loading_instruction_number_id')->withTrashed();
    }
    
    public function delivery_instruction_number()
    {
        return $this->belongsTo(DeliveryInstruction::class, 'delivery_instruction_number_id')->withTrashed();
    }
    
    public function air_freight_number()
    {
        return $this->belongsTo(AirFreight::class, 'air_freight_number_id')->withTrashed();
    }
    
    public function rail_freight_number()
    {
        return $this->belongsTo(RailFreight::class, 'rail_freight_number_id')->withTrashed();
    }
    
    public function sea_freight_number()
    {
        return $this->belongsTo(SeaFreight::class, 'sea_freight_number_id')->withTrashed();
    }
    
}
