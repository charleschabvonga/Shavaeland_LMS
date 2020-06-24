<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TimeProject
 *
 * @package App
 * @property string $name
 * @property enum $client_type
 * @property string $street_address
 * @property string $city
 * @property string $province
 * @property string $postal_code
 * @property string $country
 * @property string $vat_number
 * @property string $website
 * @property string $email
 * @property string $phone_number_1
 * @property string $phone_number_2
 * @property string $fax_number
*/
class TimeProject extends Model
{
    protected $fillable = ['name', 'client_type', 'street_address', 'city', 'province', 'postal_code', 'country', 'vat_number', 'website', 'email', 'phone_number_1', 'phone_number_2', 'fax_number'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        TimeProject::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_client_type = ["Client" => "Client", "Department" => "Department"];
    
    public function client_contacts() {
        return $this->hasMany(ClientContact::class, 'company_name_id');
    }
}
