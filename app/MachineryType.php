<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MachineryType
 *
 * @package App
 * @property string $machinery_type
 * @property string $attachment
*/
class MachineryType extends Model
{
    use SoftDeletes;

    protected $fillable = ['machinery_type', 'attachment_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        MachineryType::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setAttachmentIdAttribute($input)
    {
        $this->attributes['attachment_id'] = $input ? $input : null;
    }
    
    public function attachment()
    {
        return $this->belongsTo(TruckAttachmentStatus::class, 'attachment_id')->withTrashed();
    }
    
}
