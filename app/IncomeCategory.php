<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class IncomeCategory
 *
 * @package App
 * @property string $project_type
 * @property string $project_number
 * @property string $entry_date
 * @property string $due_date
 * @property string $prepared_by
 * @property string $invoice_number
 * @property string $client
 * @property string $contact_person
 * @property string $account_manager
 * @property string $quotation_number
 * @property string $sales_order_number
 * @property enum $status
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
class IncomeCategory extends Model
{
    protected $fillable = ['entry_date', 'due_date', 'prepared_by', 'invoice_number', 'sales_order_number', 'status', 'subtotal', 'percent_discount', 'discount_amount', 'discounted_subtotal', 'vat', 'vat_amount', 'total_amount', 'paid_to_date', 'balance', 'project_type_id', 'project_number_id', 'client_id', 'contact_person_id', 'account_manager_id', 'quotation_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        IncomeCategory::observe(new \App\Observers\UserActionsObserver);
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
    public function setProjectTypeIdAttribute($input)
    {
        $this->attributes['project_type_id'] = $input ? $input : null;
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
    public function setQuotationNumberIdAttribute($input)
    {
        $this->attributes['quotation_number_id'] = $input ? $input : null;
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
        $income = $this->attributes['paid_to_date'];
        foreach($this->incomes as $item){
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
        foreach($this->incomes as $item){
            $income -= $item->amount;
        }
        return $income;
    }
    
    public function project_type()
    {
        return $this->belongsTo(TimeWorkType::class, 'project_type_id');
    }
    
    public function project_number()
    {
        return $this->belongsTo(TimeEntry::class, 'project_number_id');
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
    
    public function quotation_number()
    {
        return $this->belongsTo(Quotation::class, 'quotation_number_id');
    }
    
    public function invoice_items() {
        return $this->hasMany(InvoiceItem::class, 'invoice_number_id');
    }

    public function incomes() {
        return $this->hasMany(Income::class, 'invoice_number_id');
    }
}
