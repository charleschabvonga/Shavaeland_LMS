<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Department
 *
 * @package App
 * @property string $dept_name
 * @property string $manager
 * @property string $street_address
 * @property string $city
 * @property string $province
 * @property string $country
 * @property string $phone_no
 * @property string $extension
 * @property string $mobile_number
 * @property string $email
*/
class Department extends Model
{
    use SoftDeletes;

    protected $fillable = ['dept_name', 'manager', 'street_address', 'city', 'province', 'country', 'phone_no', 'extension', 'mobile_number', 'email'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Department::observe(new \App\Observers\UserActionsObserver);
    }
    
}
