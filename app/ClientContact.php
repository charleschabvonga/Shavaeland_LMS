<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ClientContact
 *
 * @package App
 * @property string $company_name
 * @property string $contact_name
 * @property string $phone_number
 * @property string $email
*/
class ClientContact extends Model
{
    use SoftDeletes;

    protected $fillable = ['contact_name', 'phone_number', 'email', 'company_name_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        ClientContact::observe(new \App\Observers\UserActionsObserver);
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
        return $this->belongsTo(TimeProject::class, 'company_name_id');
    }
    
}
