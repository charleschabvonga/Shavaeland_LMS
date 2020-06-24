<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Trailer
 *
 * @package App
 * @property string $trailer_type
 * @property string $trailer_description
 * @property string $make
 * @property string $model
 * @property enum $availability
 * @property enum $service_status
 * @property string $chasis_number
 * @property string $purchase_date
 * @property decimal $purchase_price
 * @property decimal $salvage_value
 * @property decimal $investment
 * @property decimal $depreciation
 * @property decimal $maintenance
 * @property decimal $tyre
*/
class Trailer extends Model
{
    use SoftDeletes;

    protected $fillable = ['trailer_description', 'make', 'model', 'availability', 'service_status', 'chasis_number', 'purchase_date', 'purchase_price', 'salvage_value', 'investment', 'depreciation', 'maintenance', 'tyre', 'trailer_type_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Trailer::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_availability = ["Yes" => "Yes", "No(Road Freight)" => "No(Road Freight)", "N0(Workshop)" => "N0(Workshop)"];

    public static $enum_service_status = ["Scheduled" => "Scheduled", "Caution" => "Caution", "Due" => "Due", "Done" => "Done"];

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTrailerTypeIdAttribute($input)
    {
        $this->attributes['trailer_type_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setPurchaseDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['purchase_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['purchase_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getPurchaseDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPurchasePriceAttribute($input)
    {
        $this->attributes['purchase_price'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setSalvageValueAttribute($input)
    {
        $this->attributes['salvage_value'] = .10*$this->purchase_price;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setInvestmentAttribute($input)
    {
        $this->attributes['investment'] = ($this->purchase_price+$this->salvage_value)/2;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setDepreciationAttribute($input)
    {
        $this->attributes['depreciation'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setMaintenanceAttribute($input)
    {
        $this->attributes['maintenance'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setTyreAttribute($input)
    {
        $this->attributes['tyre'] = $input ? $input : null;
    }
    
    public function trailer_type()
    {
        return $this->belongsTo(MachineryType::class, 'trailer_type_id')->withTrashed();
    }
    
}
