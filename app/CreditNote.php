<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class CreditNote
 *
 * @package App
 * @property enum $refund_type
 * @property string $client
 * @property string $contact_person
 * @property string $account_manager
 * @property string $project_number
 * @property string $invoice_number
 * @property string $bank_reference
 * @property string $invoice_payment_number
 * @property string $credit_note_number
 * @property string $date
 * @property enum $status
 * @property text $terms_and_conditions
 * @property decimal $subtotal
 * @property double $vat
 * @property decimal $vat_amount
 * @property decimal $total_amount
 * @property decimal $paid_to_date
 * @property decimal $balance
 * @property string $prepared_by
*/
class CreditNote extends Model
{
    protected $fillable = ['refund_type', 'credit_note_number', 'date', 'status', 'terms_and_conditions', 'subtotal', 'vat', 'vat_amount', 'total_amount', 'paid_to_date', 'balance', 'prepared_by', 'client_id', 'contact_person_id', 'account_manager_id', 'project_number_id', 'invoice_number_id', 'bank_reference_id', 'invoice_payment_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        CreditNote::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_refund_type = ["Advance pymt refund" => "Advance pymt refund", "Sales refund cashback" => "Sales refund cashback", "Sales refund account credit" => "Sales refund account credit"];

    public static $enum_status = ["Draft" => "Draft", "Sent" => "Sent", "Payment due" => "Payment due", "Partially paid" => "Partially paid", "Paid" => "Paid", "Account credited" => "Account credited", "Rejected" => "Rejected"];

    //Get status attribute
    public function getStatusAttribute($input)
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
    public function setClientIdAttribute($input)
    {
        $this->attributes['client_id'] = $input ? $input : null;
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
    public function setProjectNumberIdAttribute($input)
    {
        $this->attributes['project_number_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setInvoiceNumberIdAttribute($input)
    {
        $this->attributes['invoice_number_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setBankReferenceIdAttribute($input)
    {
        $this->attributes['bank_reference_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setInvoicePaymentNumberIdAttribute($input)
    {
        $this->attributes['invoice_payment_number_id'] = $input ? $input : null;
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
        $expense = $this->attributes['paid_to_date'];
        foreach($this->outbound_deposits as $item){
            $expense += $item->amount;
        }
        if ($this->refund_type != 'Sales refund account credit') {
            foreach($this->expenses as $item){
                $expense += $item->amount;
            }
        }
        
        foreach($this->incomes as $item){
            if ($item->deposit_transaction_number == '') {
                $expense += $item->amount;
            }
        }
        return $expense;
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
        $expense = $this->attributes['balance'];
        foreach($this->outbound_deposits as $item){
            $expense -= $item->amount;
        }
        if ($this->refund_type != 'Sales refund account credit') {
            foreach($this->expenses as $item){
                $expense -= $item->amount;
            }
        }
        foreach($this->incomes as $item){
            if ($item->deposit_transaction_number == '') {
                $expense -= $item->amount;
            }
        }
        return $expense;
    }
    
    public function client()
    {
        return $this->belongsTo(TimeProject::class, 'client_id');
    }
    
    public function contact_person()
    {
        return $this->belongsTo(ClientContact::class, 'contact_person_id')->withTrashed();
    }
    
    public function account_manager()
    {
        return $this->belongsTo(Employee::class, 'account_manager_id')->withTrashed();
    }
    
    public function project_number()
    {
        return $this->belongsTo(TimeEntry::class, 'project_number_id');
    }
    
    public function invoice_number()
    {
        return $this->belongsTo(IncomeCategory::class, 'invoice_number_id');
    }
    
    public function bank_reference()
    {
        return $this->belongsTo(BankPayment::class, 'bank_reference_id');
    }
    
    public function invoice_payment_number()
    {
        return $this->belongsTo(Income::class, 'invoice_payment_number_id');
    }
    
    public function invoice_items() {
        return $this->hasMany(InvoiceItem::class, 'credit_note_number_id');
    }

    public function expenses() {
        return $this->hasMany(Expense::class, 'client_credit_note_number_id');
    }

    public function incomes() {
        return $this->hasMany(Income::class, 'sales_credit_note_number_id');
    }

    public function outbound_deposits() {
        return $this->hasMany(VendorBankPayment::class, 'credit_note_number_id');
    }
}
