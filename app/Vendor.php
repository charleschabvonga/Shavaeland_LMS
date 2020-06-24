<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class Vendor
 *
 * @package App
 * @property string $name
 * @property enum $vendor_type
 * @property string $street_address
 * @property string $city
 * @property string $province
 * @property string $postal_code
 * @property string $country
 * @property string $vat
 * @property string $website
 * @property string $email
 * @property string $phone_number_1
 * @property string $phone_number_2
 * @property string $fax_number
 * @property string $tax_clearance_number
 * @property string $tax_clearance_expiration_date
 * @property string $company_registration_number
 * @property string $directors_name
 * @property string $director_id_number
*/
class Vendor extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['name', 'vendor_type', 'street_address', 'city', 'province', 'postal_code', 'country', 'vat', 'website', 'email', 'phone_number_1', 'phone_number_2', 'fax_number', 'tax_clearance_number', 'tax_clearance_expiration_date', 'company_registration_number', 'directors_name', 'director_id_number'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Vendor::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_vendor_type = ["" => "", "Supplier" => "Supplier", "Department" => "Department"];

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setTaxClearanceExpirationDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['tax_clearance_expiration_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['tax_clearance_expiration_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getTaxClearanceExpirationDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }
    
    public function vendor_contacts() {
        return $this->hasMany(VendorContact::class, 'company_name_id');
    }
    public function road_freight_sub_contractors() {
        return $this->hasMany(RoadFreightSubContractor::class, 'vendor_id');
    }
}
