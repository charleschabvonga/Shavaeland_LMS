<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BeneficiaryDetail
 *
 * @package App
 * @property string $employee_name
 * @property string $beneficiary_name
 * @property string $id_number
 * @property string $address
 * @property string $phone1
 * @property string $phone
 * @property string $allocation_percentage
*/
class BeneficiaryDetail extends Model
{
    use SoftDeletes;

    protected $fillable = ['beneficiary_name', 'id_number', 'address', 'phone1', 'phone', 'allocation_percentage', 'employee_name_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        BeneficiaryDetail::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setEmployeeNameIdAttribute($input)
    {
        $this->attributes['employee_name_id'] = $input ? $input : null;
    }
    
    public function employee_name()
    {
        return $this->belongsTo(Employee::class, 'employee_name_id')->withTrashed();
    }
    
}
