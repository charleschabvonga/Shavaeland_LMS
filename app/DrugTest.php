<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class DrugTest
 *
 * @package App
 * @property string $drug_test_number
 * @property string $employee_name
 * @property string $last_annual_drug_test
 * @property string $last_random_drug_test
 * @property string $last_physical_exam_date
 * @property text $description
*/
class DrugTest extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['drug_test_number', 'last_annual_drug_test', 'last_random_drug_test', 'last_physical_exam_date', 'description', 'employee_name_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        DrugTest::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setEmployeeNameIdAttribute($input)
    {
        $this->attributes['employee_name_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setLastAnnualDrugTestAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['last_annual_drug_test'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['last_annual_drug_test'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getLastAnnualDrugTestAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setLastPhysicalExamDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['last_physical_exam_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['last_physical_exam_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getLastPhysicalExamDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }
    
    public function employee_name()
    {
        return $this->belongsTo(Employee::class, 'employee_name_id')->withTrashed();
    }
    
}
