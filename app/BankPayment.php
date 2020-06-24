<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class BankPayment
 *
 * @package App
 * @property string $entry_date
 * @property enum $depositor
 * @property string $client
 * @property string $account_number
 * @property string $vendor
 * @property string $vendor_account_number
 * @property string $debit_note_number
 * @property enum $payment_mode
 * @property string $payment_number
 * @property decimal $amount
 * @property decimal $balance
 * @property string $upload_document
 * @property string $prepared_by
*/
class BankPayment extends Model
{
    protected $fillable = ['entry_date', 'depositor', 'payment_mode', 'payment_number', 'amount', 'balance', 'upload_document', 'prepared_by', 'client_id', 'account_number_id', 'vendor_id', 'vendor_account_number_id', 'debit_note_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        BankPayment::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_depositor = ["Client" => "Client", "Vendor advance pymt refund" => "Vendor advance pymt refund", "Vendor purchase refund" => "Vendor purchase refund"];

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
    public function setClientIdAttribute($input)
    {
        $this->attributes['client_id'] = $input ? $input : null;
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
    public function setVendorIdAttribute($input)
    {
        $this->attributes['vendor_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setVendorAccountNumberIdAttribute($input)
    {
        $this->attributes['vendor_account_number_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setDebitNoteNumberIdAttribute($input)
    {
        $this->attributes['debit_note_number_id'] = $input ? $input : null;
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
        if ($this->attributes['debit_note_number_id'] != '') {
           $income = 0;
        }
        else{
            $income = $this->attributes['amount'];
        }

        foreach($this->income as $item){
            $income -= $item->amount;
        }
        foreach($this->credit_note as $item){
            if ($item->refund_type == 'Advance pymt refund') {
                $income -= $item->total_amount;
            } 
        }
        return $income;
    }
    
    public function client()
    {
        return $this->belongsTo(TimeProject::class, 'client_id');
    }
    
    public function account_number()
    {
        return $this->belongsTo(ClientAccount::class, 'account_number_id')->withTrashed();
    }
    
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id')->withTrashed();
    }
    
    public function vendor_account_number()
    {
        return $this->belongsTo(VendorAccount::class, 'vendor_account_number_id')->withTrashed();
    }

    public function debit_note_number()
    {
        return $this->belongsTo(DebitNote::class, 'debit_note_number_id');
    }

    public function income() {
        return $this->hasMany(Income::class, 'deposit_transaction_number_id');
    }

    public function credit_note() {
        return $this->hasMany(CreditNote::class, 'bank_reference_id');
    }
    
}
