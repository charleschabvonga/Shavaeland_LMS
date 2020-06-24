<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LoadingRequirement
 *
 * @package App
 * @property string $loading_instruction_number
 * @property string $item_description
 * @property double $qty
 * @property string $unit
*/
class LoadingRequirement extends Model
{
    use SoftDeletes;

    protected $fillable = ['item_description', 'qty', 'unit', 'loading_instruction_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        LoadingRequirement::observe(new \App\Observers\UserActionsObserver);
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
    
    public function loading_instruction_number()
    {
        return $this->belongsTo(LoadingInstruction::class, 'loading_instruction_number_id')->withTrashed();
    }
    
}
