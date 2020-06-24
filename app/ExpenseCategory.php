<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class ExpenseCategory
 *
 * @package App
 * @property string $transaction_type
 * @property string $transaction_number
 * @property string $entry_date
 * @property string $due_date
 * @property string $prepared_by
 * @property string $credit_note_number
 * @property string $vendor
 * @property string $contact_person
 * @property string $account_manager
 * @property string $purchase_order_number
 * @property string $vendor_purchase_order_number
 * @property string $upload_document
 * @property enum $status
 * @property text $terms_and_conditions
 * @property decimal $subtotal
 * @property double $percent_discount
 * @property decimal $discount_amount
 * @property decimal $discounted_subtotal
 * @property double $vat
 * @property decimal $vat_amount
 * @property decimal $total_amount
 * @property decimal $paid_to_date
 * @property decimal $balance
*/
class ExpenseCategory extends Model
{
    protected $fillable = ['entry_date', 'due_date', 'prepared_by', 'credit_note_number', 'vendor_purchase_order_number', 'upload_document', 'status', 'terms_and_conditions', 'subtotal', 'percent_discount', 'discount_amount', 'discounted_subtotal', 'vat', 'vat_amount', 'total_amount', 'paid_to_date', 'balance', 'transaction_type_id', 'transaction_number_id', 'vendor_id', 'contact_person_id', 'account_manager_id', 'purchase_order_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        ExpenseCategory::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_status = ["Draft" => "Draft", "Sent" => "Sent", "Payment due" => "Payment due", "Partially paid" => "Partially paid", "Paid" => "Paid", "Up to date" => "Up to date"];

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
    public function setTransactionTypeIdAttribute($input)
    {
        $this->attributes['transaction_type_id'] = $input ? $input : null;
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
     * Set attribute to date format
     * @param $input
     */
    public function setDueDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['due_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['due_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDueDateAttribute($input)
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
    public function setPurchaseOrderNumberIdAttribute($input)
    {
        $this->attributes['purchase_order_number_id'] = $input ? $input : null;
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
    public function setPercentDiscountAttribute($input)
    {
        if ($input != '') {
            $this->attributes['percent_discount'] = $input;
        } else {
            $this->attributes['percent_discount'] = null;
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setDiscountAmountAttribute($input)
    {
        $this->attributes['discount_amount'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setDiscountedSubtotalAttribute($input)
    {
        $this->attributes['discounted_subtotal'] = $input ? $input : null;
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
        foreach($this->expenses as $item){
            $expense += $item->amount;
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
        foreach($this->expenses as $item){
            $expense -= $item->amount;
        }
        return $expense;
    }
    
    public function transaction_type()
    {
        return $this->belongsTo(TimeWorkType::class, 'transaction_type_id');
    }
    
    public function transaction_number()
    {
        return $this->belongsTo(TimeEntry::class, 'transaction_number_id');
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
    
    public function purchase_order_number()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_number_id');
    }
    
    public function invoice_items() {
        return $this->hasMany(InvoiceItem::class, 'bill_number_id');
    }

    public function expenses() {
        return $this->hasMany(Expense::class, 'vendor_credit_note_number_id');
    }
}
