<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Payslip
 *
 * @package App
 * @property string $date
 * @property string $starting_date
 * @property string $ending_date
 * @property string $employee
 * @property string $batch_number
 * @property string $account_number
 * @property string $payslip_number
 * @property enum $status
 * @property decimal $overtime_and_bonus_total
 * @property decimal $deductions_total
 * @property decimal $gross
 * @property double $income_tax
 * @property decimal $income_tax_amount
 * @property decimal $net_income
 * @property decimal $paid_to_date
 * @property decimal $balance
 * @property string $prepared_by
*/
class Payslip extends Model
{
    use SoftDeletes;

    protected $fillable = ['date', 'starting_date', 'ending_date', 'payslip_number', 'status', 'overtime_and_bonus_total', 'deductions_total', 'gross', 'income_tax', 'income_tax_amount', 'net_income', 'paid_to_date', 'balance', 'prepared_by', 'employee_id', 'batch_number_id', 'account_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Payslip::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_status = ["Draft" => "Draft", "Payment due" => "Payment due", "Partially paid" => "Partially paid", "Paid" => "Paid"];

    //Get status attribute
    public function getStatusAttribute($input)
    {
        $status = "Draft";
        if ($this->balance == $this->total_amount){
            $status = 'Payment due';
        }
        if (($this->paid_to_date != $this->net_income) && ($this->paid_to_date > 0)){
            $status = 'Partially paid';
        }
        if ($this->balance == 0){
            $status = 'Paid';
        }
        return $status;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateAttribute($input)
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
    public function setStartingDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['starting_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['starting_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getStartingDateAttribute($input)
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
    public function setEndingDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['ending_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['ending_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getEndingDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
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
    public function setBatchNumberIdAttribute($input)
    {
        $this->attributes['batch_number_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setAccountNumberIdAttribute($input)
    {
        $this->attributes['account_number_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setOvertimeAndBonusTotalAttribute($input)
    {
        $this->attributes['overtime_and_bonus_total'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setDeductionsTotalAttribute($input)
    {
        $this->attributes['deductions_total'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setGrossAttribute($input)
    {
        $this->attributes['gross'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setIncomeTaxAttribute($input)
    {
        if ($input != '') {
            $this->attributes['income_tax'] = $input;
        } else {
            $this->attributes['income_tax'] = null;
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setIncomeTaxAmountAttribute($input)
    {
        $this->attributes['income_tax_amount'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setNetIncomeAttribute($input)
    {
        $this->attributes['net_income'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPaidToDateAttribute($input)
    {
        $this->attributes['paid_to_date'] = $input ? $input : null;
    }

    public function getPaidToDateAttribute(){
        $income = $this->attributes['paid_to_date'];
        foreach($this->payslip_payments as $item){
            $income += $item->amount;
        }
        return $income;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setBalanceAttribute($input)
    {
        $this->attributes['balance'] = $input ? $input : null;
    }

    public function getBalanceAttribute(){
        $income = $this->attributes['balance'];
        foreach($this->payslip_payments as $item){
            $income -= $item->amount;
        }
        return $income;
    }
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id')->withTrashed();
    }
    
    public function batch_number()
    {
        return $this->belongsTo(SalariesRequestTotal::class, 'batch_number_id')->withTrashed();
    }
    
    public function account_number()
    {
        return $this->belongsTo(PayeeAccount::class, 'account_number_id')->withTrashed();
    }
    
    public function deduction_items() {
        return $this->hasMany(DeductionItem::class, 'item_number_id');
    }
    public function overtime_and_bonus_items() {
        return $this->hasMany(OvertimeAndBonusItem::class, 'item_number_id');
    }

    public function payslip_payments() {
        return $this->hasMany(PayeePayment::class, 'payslip_number_id');
    }
}
