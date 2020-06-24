<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MachinerySize
 *
 * @package App
 * @property string $size
 * @property string $attachment
*/
class MachinerySize extends Model
{
    use SoftDeletes;

    protected $fillable = ['size', 'attachment_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        MachinerySize::observe(new \App\Observers\UserActionsObserver);
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
