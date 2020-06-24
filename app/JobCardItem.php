<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class JobCardItem
 *
 * @package App
 * @property string $job_card_items
 * @property string $client_job_card_number
 * @property string $workshop
 * @property string $part
 * @property double $price
 * @property double $qty
 * @property string $unit
 * @property double $total
*/
class JobCardItem extends Model
{
    use SoftDeletes;

    protected $fillable = ['workshop', 'part', 'price', 'qty', 'unit', 'total', 'job_card_items_id', 'client_job_card_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        JobCardItem::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setJobCardItemsIdAttribute($input)
    {
        $this->attributes['job_card_items_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setClientJobCardNumberIdAttribute($input)
    {
        $this->attributes['client_job_card_number_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setPriceAttribute($input)
    {
        if ($input != '') {
            $this->attributes['price'] = $input;
        } else {
            $this->attributes['price'] = null;
        }
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
    public function setTotalAttribute($input)
    {
        if ($input != '') {
            $this->attributes['total'] = $input;
        } else {
            $this->attributes['total'] = null;
        }
    }
    
    public function job_card_items()
    {
        return $this->belongsTo(InhouseJobCard::class, 'job_card_items_id')->withTrashed();
    }
    
    public function client_job_card_number()
    {
        return $this->belongsTo(ClientJobCard::class, 'client_job_card_number_id')->withTrashed();
    }
    
}
