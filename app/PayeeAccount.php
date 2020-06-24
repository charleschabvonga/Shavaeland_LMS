<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PayeeAccount
 *
 * @package App
 * @property string $employee
 * @property string $bank
 * @property string $account_number
 * @property string $branch_code
 * @property string $branch
 * @property string $department
 * @property string $position
 * @property enum $status
 * @property enum $pymt_measurement_type
 * @property decimal $wage_rate
 * @property decimal $pension_rate
 * @property decimal $overtime_rate
 * @property decimal $public_holiday_rate
 * @property decimal $medical_aid
 * @property double $sales_rate
*/
class PayeeAccount extends Model
{
    use SoftDeletes;

    protected $fillable = ['bank', 'account_number', 'branch_code', 'branch', 'status', 'pymt_measurement_type', 'wage_rate', 'pension_rate', 'overtime_rate', 'public_holiday_rate', 'medical_aid', 'sales_rate', 'employee_id', 'department_id', 'position_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        PayeeAccount::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_status = ["Not active" => "Not active", "Payment due" => "Payment due", "Up to date" => "Up to date", "Paid off" => "Paid off", "Debited" => "Debited", "Closed" => "Closed"];

    public static $enum_pymt_measurement_type = ["Monthy" => "Monthy", "BiWeekly" => "BiWeekly", "Weekly" => "Weekly", "Daily" => "Daily", "Hrs" => "Hrs", "kms" => "Kms"];

    //--------------- Get status attribute ---------------//
    public function getStatusAttribute($input)
    {
        $status = "Not active";
        if ($this->account_balance > 0){
            $status = 'Payment due';
        }
        if ($this->account_balance < 0){
            $status = 'Debited';
        }
        if ($this->account_balance == 0){
            $status = 'Paid off';
        }
        return $status;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setEmployeeIdAttribute($input)
    {
        $this->attributes['employee_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setDepartmentIdAttribute($input)
    {
        $this->attributes['department_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPositionIdAttribute($input)
    {
        $this->attributes['position_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setWageRateAttribute($input)
    {
        $this->attributes['wage_rate'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPensionRateAttribute($input)
    {
        $this->attributes['pension_rate'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setOvertimeRateAttribute($input)
    {
        $this->attributes['overtime_rate'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPublicHolidayRateAttribute($input)
    {
        $this->attributes['public_holiday_rate'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setMedicalAidAttribute($input)
    {
        $this->attributes['medical_aid'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setSalesRateAttribute($input)
    {
        if ($input != '') {
            $this->attributes['sales_rate'] = $input;
        } else {
            $this->attributes['sales_rate'] = null;
        }
    }

    //--------------- Payslips Totals calculations ---------------//
    public function getNetIncomeTotalAttribute(){
        $income = 0;
        foreach($this->payslips as $item){
            $income += $item->net_income;
        }
        return $income;
    }
    public function getPaidToDateTotalAttribute(){
        $income = 0;
        foreach($this->payslips as $item){
            $income += $item->paid_to_date;
        }
        return $income;
    }
    public function getBalanceTotalAttribute(){
        $income = 0;
        foreach($this->payslips as $item){
            $income += $item->balance;
        }
        return $income;
    }

    //--------------- Payslip Payments Totals calculations ---------------//
    public function getAmountTotalAttribute(){
        $income = 0;
        foreach($this->payslip_payments as $item){
            $income += $item->amount;
        }
        return $income;
    }

    //--------------- Account Balance Totals calculations ---------------//
    public function getAccountBalanceAttribute(){
        $income = 0;
        foreach($this->payslips as $item){
            $income += $item->net_income;
        }
        foreach($this->payslip_payments as $item){
            $income -= $item->amount;
        }
        return $income;
    }
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id')->withTrashed();
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id')->withTrashed();
    }
    
    public function position()
    {
        return $this->belongsTo(Employee::class, 'position_id')->withTrashed();
    }

    public function payslips() {
        return $this->hasMany(Payslip::class, 'employee_id');
    }

    public function payslip_payments() {
        return $this->hasMany(PayeePayment::class, 'employee_id');
    }
    
}
