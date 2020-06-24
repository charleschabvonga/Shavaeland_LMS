<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EmergencyContact
 *
 * @package App
 * @property string $employee_name
 * @property string $name
 * @property string $phone1
 * @property string $phone
*/
class EmergencyContact extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'phone1', 'phone', 'employee_name_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        EmergencyContact::observe(new \App\Observers\UserActionsObserver);
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
