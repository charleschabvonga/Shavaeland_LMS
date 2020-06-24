<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ReceivedItem
 *
 * @package App
 * @property string $receipt_number
 * @property string $release_number
 * @property string $item
 * @property double $qty
 * @property double $area
 * @property string $unit
*/
class ReceivedItem extends Model
{
    use SoftDeletes;

    protected $fillable = ['item', 'qty', 'area', 'unit', 'receipt_number_id', 'release_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        ReceivedItem::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setReceiptNumberIdAttribute($input)
    {
        $this->attributes['receipt_number_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setReleaseNumberIdAttribute($input)
    {
        $this->attributes['release_number_id'] = $input ? $input : null;
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
    public function setAreaAttribute($input)
    {
        if ($input != '') {
            $this->attributes['area'] = $input;
        } else {
            $this->attributes['area'] = null;
        }
    }
    
    public function receipt_number()
    {
        return $this->belongsTo(Receiving::class, 'receipt_number_id')->withTrashed();
    }
    
    public function release_number()
    {
        return $this->belongsTo(Releasing::class, 'release_number_id')->withTrashed();
    }
    
}
