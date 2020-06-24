<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SalariesRequestTotal
 *
 * @package App
 * @property string $batch_number
 * @property string $starting_pay_date
 * @property string $ending_pay_date
 * @property enum $status
*/
class SalariesRequestTotal extends Model
{
    use SoftDeletes;

    protected $fillable = ['batch_number', 'starting_pay_date', 'ending_pay_date', 'status'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        SalariesRequestTotal::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_status = ["In progress" => "In progress", "Partially paid" => "Partially paid", "Paid" => "Paid", "Payment due" => "Payment due"];

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setStartingPayDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['starting_pay_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['starting_pay_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getStartingPayDateAttribute($input)
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
    public function setEndingPayDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['ending_pay_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['ending_pay_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getEndingPayDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
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

    //--------------- Payslip Payments Totals calculations ---------------//
    /*public function getAvailableBalanceAttribute(){
        $income = 0;
        foreach($this->deposit_amounts as $item){
            $income += $item->balance; 
        }
        return $income;
    }*/

    public function payslips() {
        return $this->hasMany(Payslip::class, 'batch_number_id');
    }

    public function payslip_payments() {
        return $this->hasMany(PayeePayment::class, 'batch_number_id');
    }

    /*public function deposit_amounts() {
        return $this->hasMany(VendorBankPayment::class, 'vendor_id');
    }*/
    
}
