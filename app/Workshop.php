<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Workshop
 *
 * @package App
 * @property string $vendor
 * @property string $center_name
*/
class Workshop extends Model
{
    use SoftDeletes;

    protected $fillable = ['center_name', 'vendor_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Workshop::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCenterNameAttribute($input)
    {
        $this->attributes['center_name'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setVendorIdAttribute($input)
    {
        $this->attributes['vendor_id'] = $input ? $input : null;
    }

    //--------------- Procurements Totals calculations ---------------//
    public function getTotalProcurementsAttribute(){
        $purchases = 0;
        foreach($this->purchases as $item){
            if($item->transaction_type == 'Procurement'){
                $purchases += $item->total;
            }
        }
        return $purchases;
    }

    //--------------- Requests Totals calculations ---------------//
    public function getTotalRequestsAttribute(){
        $purchases = 0;
        foreach($this->purchases as $item){
            if($item->transaction_type == 'Request'){
                $purchases += $item->total;
            }
        }
        return $purchases;
    }
    
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id')->withTrashed();
    }

    public function purchases() {
        return $this->hasMany(PartsAcquired::class, 'repair_center_id');
    }
    
    public function inventories() {
        return $this->hasMany(Part::class, 'repair_center_id');
    }    
}
