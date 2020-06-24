<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class VendorBankPayment
 *
 * @package App
 * @property string $entry_date
 * @property enum $withdrawer
 * @property string $vendor
 * @property string $account_number
 * @property string $client
 * @property string $client_account_number
 * @property string $credit_note_number
 * @property enum $payment_mode
 * @property string $payment_number
 * @property decimal $amount
 * @property decimal $balance
 * @property string $upload_document
 * @property string $prepared_by
*/
class VendorBankPayment extends Model
{
    protected $fillable = ['entry_date', 'withdrawer', 'payment_mode', 'payment_number', 'amount', 'balance', 'upload_document', 'prepared_by', 'vendor_id', 'account_number_id', 'client_id', 'client_account_number_id', 'credit_note_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        VendorBankPayment::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_withdrawer = ["Vendor" => "Vendor", "Client advance pymt refund" => "Client advance pymt refund", "Client sale refund" => "Client sale refund", "Department" => "Department"];

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
    public function setVendorIdAttribute($input)
    {
        $this->attributes['vendor_id'] = $input ? $input : null;
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
     * Set to null if empty
     * @param $input
     */
    public function setClientIdAttribute($input)
    {
        $this->attributes['client_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setClientAccountNumberIdAttribute($input)
    {
        $this->attributes['client_account_number_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCreditNoteNumberIdAttribute($input)
    {
        $this->attributes['credit_note_number_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setAmountAttribute($input)
    {
        $this->attributes['amount'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setBalanceAttribute($input)
    {
        $this->attributes['balance'] = $input ? $input : null;
    }

    //--------------- Deposit Balance ---------------//
    public function getBalanceAttribute(){
        if ($this->attributes['credit_note_number_id'] != '') {
           $expense = 0;
        }
        else{
            $expense = $this->attributes['amount'];
        }

        foreach($this->expense as $item){
            $expense -= $item->amount;
        }
        foreach($this->debit_note as $item){
            if ($item->refund_type == 'Advance pymt refund') {
                $expense -= $item->total_amount;
            } 
        }
        foreach($this->salary_payments as $item){
            $expense -= $item->amount;
        }
        return $expense;
    }
    
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id')->withTrashed();
    }
    
    public function account_number()
    {
        return $this->belongsTo(VendorAccount::class, 'account_number_id')->withTrashed();
    }
    
    public function client()
    {
        return $this->belongsTo(TimeProject::class, 'client_id');
    }
    
    public function client_account_number()
    {
        return $this->belongsTo(ClientAccount::class, 'client_account_number_id')->withTrashed();
    }

    public function credit_note_number()
    {
        return $this->belongsTo(CreditNote::class, 'credit_note_number_id');
    }

    public function expense() {
        return $this->hasMany(Expense::class, 'withdrawal_transaction_number_id');
    }

    public function debit_note() {
        return $this->hasMany(DebitNote::class, 'withdrawal_transaction_number_id');
    }

    public function salary_payments() {
        return $this->hasMany(PayeePayment::class, 'withdrawal_transaction_number_id');
    }
    
}
