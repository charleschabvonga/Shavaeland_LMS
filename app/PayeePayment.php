<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class PayeePayment
 *
 * @package App
 * @property string $entry_date
 * @property string $employee
 * @property string $payslip_number
 * @property string $batch_number
 * @property string $withdrawal_transaction_number
 * @property string $payee_account_number
 * @property string $payee_payment_number
 * @property enum $payment_mode
 * @property decimal $amount
 * @property string $prepared_by
*/
class PayeePayment extends Model
{
    protected $fillable = ['entry_date', 'payee_payment_number', 'payment_mode', 'amount', 'prepared_by', 'employee_id', 'payslip_number_id', 'batch_number_id', 'withdrawal_transaction_number_id', 'payee_account_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        PayeePayment::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_payment_mode = ["Bank Transfer" => "Bank Transfer", "Cash" => "Cash", "Cheque" => "Cheque"];

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setEntryDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['entry_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['entry_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getEntryDateAttribute($input)
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
    public function setPayslipNumberIdAttribute($input)
    {
        $this->attributes['payslip_number_id'] = $input ? $input : null;
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
    public function setWithdrawalTransactionNumberIdAttribute($input)
    {
        $this->attributes['withdrawal_transaction_number_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPayeeAccountNumberIdAttribute($input)
    {
        $this->attributes['payee_account_number_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setAmountAttribute($input)
    {
        $this->attributes['amount'] = $input ? $input : null;
    }
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id')->withTrashed();
    }
    
    public function payslip_number()
    {
        return $this->belongsTo(Payslip::class, 'payslip_number_id')->withTrashed();
    }
    
    public function batch_number()
    {
        return $this->belongsTo(SalariesRequestTotal::class, 'batch_number_id')->withTrashed();
    }
    
    public function withdrawal_transaction_number()
    {
        return $this->belongsTo(VendorBankPayment::class, 'withdrawal_transaction_number_id');
    }
    
    public function payee_account_number()
    {
        return $this->belongsTo(PayeeAccount::class, 'payee_account_number_id')->withTrashed();
    }
    
}
