<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class DebitNote
 *
 * @package App
 * @property enum $refund_type
 * @property string $vendor
 * @property string $contact_person
 * @property string $account_manager
 * @property string $transaction_number
 * @property string $credit_note_number
 * @property string $withdrawal_transaction_number
 * @property string $credit_note_payment_number
 * @property string $debit_note_number
 * @property string $date
 * @property enum $payment_status
 * @property decimal $subtotal
 * @property double $vat
 * @property decimal $vat_amount
 * @property decimal $total_amount
 * @property decimal $paid_to_date
 * @property decimal $balance
 * @property string $prepared_by
*/
class DebitNote extends Model
{
    protected $fillable = ['refund_type', 'debit_note_number', 'date', 'payment_status', 'subtotal', 'vat', 'vat_amount', 'total_amount', 'paid_to_date', 'balance', 'prepared_by', 'vendor_id', 'contact_person_id', 'account_manager_id', 'transaction_number_id', 'credit_note_number_id', 'withdrawal_transaction_number_id', 'credit_note_payment_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        DebitNote::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_refund_type = ["Advance pymt refund" => "Advance pymt refund", "Purchase refund cashback" => "Purchase refund cashback", "Purchase refund account credit" => "Purchase refund account credit"];

    public static $enum_status = ["Draft" => "Draft", "Sent" => "Sent", "Payment Due" => "Payment Due", "Partially paid" => "Partially paid", "Paid" => "Paid", "Account credited" => "Account credited", "Rejected" => "Rejected"];

    //Get status attribute
    public function getPaymentStatusAttribute($input)
    {
        $status = "Draft";
        if ($this->balance == $this->total_amount){
            $status = 'Payment due';
        }
        if (($this->paid_to_date != $this->total_amount) && ($this->paid_to_date > 0)){
            $status = 'Partially paid';
        }
        if ($this->balance == 0){
            $status = 'Paid';
        }
        return $status;
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
    public function setContactPersonIdAttribute($input)
    {
        $this->attributes['contact_person_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setAccountManagerIdAttribute($input)
    {
        $this->attributes['account_manager_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTransactionNumberIdAttribute($input)
    {
        $this->attributes['transaction_number_id'] = $input ? $input : null;
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
    public function setCreditNotePaymentNumberIdAttribute($input)
    {
        $this->attributes['credit_note_payment_number_id'] = $input ? $input : null;
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
     * Set attribute to money format
     * @param $input
     */
    public function setSubtotalAttribute($input)
    {
        $this->attributes['subtotal'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setVatAttribute($input)
    {
        if ($input != '') {
            $this->attributes['vat'] = $input;
        } else {
            $this->attributes['vat'] = null;
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setVatAmountAttribute($input)
    {
        $this->attributes['vat_amount'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setTotalAmountAttribute($input)
    {
        $this->attributes['total_amount'] = $input ? $input : null;
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
        foreach($this->inbound_deposits as $item){
            $income += $item->amount;
        }
        if ($this->refund_type != 'Purchase refund account credit') {
            foreach($this->incomes as $item){
                $income += $item->amount;
            }
        }
        foreach($this->expenses as $item){
            if ($item->withdrawal_transaction_number == '') {
                $income += $item->amount;
            }
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
        foreach($this->inbound_deposits as $item){
            $income -= $item->amount;
        }
        if ($this->refund_type != 'Purchase refund account credit') {
            foreach($this->incomes as $item){
                $income -= $item->amount;
            }
        }
        foreach($this->expenses as $item){
            if ($item->withdrawal_transaction_number == '') {
                $income -= $item->amount;
            }
        }
        return $income;
    }
    
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id')->withTrashed();
    }
    
    public function contact_person()
    {
        return $this->belongsTo(VendorContact::class, 'contact_person_id')->withTrashed();
    }
    
    public function account_manager()
    {
        return $this->belongsTo(Employee::class, 'account_manager_id')->withTrashed();
    }
    
    public function transaction_number()
    {
        return $this->belongsTo(TimeEntry::class, 'transaction_number_id');
    }
    
    public function credit_note_number()
    {
        return $this->belongsTo(ExpenseCategory::class, 'credit_note_number_id');
    }
    
    public function withdrawal_transaction_number()
    {
        return $this->belongsTo(VendorBankPayment::class, 'withdrawal_transaction_number_id');
    }
    
    public function credit_note_payment_number()
    {
        return $this->belongsTo(Expense::class, 'credit_note_payment_number_id');
    }
    
    public function invoice_items() {
        return $this->hasMany(InvoiceItem::class, 'debit_note_number_id');
    }

    public function inbound_deposits() {
        return $this->hasMany(BankPayment::class, 'debit_note_number_id');
    }

    public function incomes() {
        return $this->hasMany(Income::class, 'debit_note_number_id');
    }

    public function expenses() {
        return $this->hasMany(Expense::class, 'debit_note_number_id');
    }
}
