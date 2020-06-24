<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DeductionItem
 *
 * @package App
 * @property string $item_number
 * @property string $item_description
 * @property decimal $unit_price
 * @property double $qty
 * @property decimal $total
 * @property string $unit
*/
class DeductionItem extends Model
{
    use SoftDeletes;

    protected $fillable = ['item_description', 'unit_price', 'qty', 'total', 'unit', 'item_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        DeductionItem::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setItemNumberIdAttribute($input)
    {
        $this->attributes['item_number_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setUnitPriceAttribute($input)
    {
        $this->attributes['unit_price'] = $input ? $input : null;
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
     * Set attribute to money format
     * @param $input
     */
    public function setTotalAttribute($input)
    {
        $this->attributes['total'] = $input ? $input : null;
    }
    
    public function item_number()
    {
        return $this->belongsTo(Payslip::class, 'item_number_id')->withTrashed();
    }
    
}
