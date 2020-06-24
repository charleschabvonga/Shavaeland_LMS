<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RoadFreightSubContractor
 *
 * @package App
 * @property string $subcontractor_number
 * @property string $vendor
 * @property string $git_cover_number
 * @property string $git_cover
 * @property enum $status
 * @property string $git_expiry_date
 * @property enum $git_status
*/
class RoadFreightSubContractor extends Model
{
    use SoftDeletes;

    protected $fillable = ['subcontractor_number', 'git_cover_number', 'git_cover', 'status', 'git_expiry_date', 'git_status', 'vendor_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        RoadFreightSubContractor::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_status = ["Under process" => "Under process", "Approved" => "Approved", "Declined" => "Declined"];

    public static $enum_git_status = ["Up to date" => "Up to date", "GIT expired" => "GIT expired"];

    /**
     * Set to null if empty
     * @param $input
     */
    public function setVendorIdAttribute($input)
    {
        $this->attributes['vendor_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setGitExpiryDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['git_expiry_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['git_expiry_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getGitExpiryDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }
    
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id')->withTrashed();
    }
    
    public function vehicle_scs() {
        return $this->hasMany(VehicleSc::class, 'vendor_id');
    }

    public function driver() {
        return $this->hasMany(Driver::class, 'vendor_id');
    }
}
