<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class VendorContact
 *
 * @package App
 * @property string $company_name
 * @property string $contact_name
 * @property string $phone_number
 * @property string $email
*/
class VendorContact extends Model
{
    use SoftDeletes;

    protected $fillable = ['contact_name', 'phone_number', 'email', 'company_name_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        VendorContact::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCompanyNameIdAttribute($input)
    {
        $this->attributes['company_name_id'] = $input ? $input : null;
    }
    
    public function company_name()
    {
        return $this->belongsTo(Vendor::class, 'company_name_id')->withTrashed();
    }
    
}
