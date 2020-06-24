<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TruckAttachmentStatus
 *
 * @package App
 * @property string $attachment
*/
class TruckAttachmentStatus extends Model
{
    use SoftDeletes;

    protected $fillable = ['attachment'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        TruckAttachmentStatus::observe(new \App\Observers\UserActionsObserver);
    }
    
}
