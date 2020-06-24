<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class Income
 *
 * @package App
 * @property string $entry_date
 * @property enum $payment_type
 * @property string $deposit_transaction_number
 * @property string $prepared_by
 * @property string $payment_number
 * @property string $invoice_number
 * @property string $sales_credit_note_number
 * @property string $client
 * @property string $debit_note_number
 * @property string $vendor
 * @property string $operation_type
 * @property string $project_type
 * @property string $project_number
 * @property string $income_category
 * @property decimal $amount
*/
class Income extends Model
{
    protected $fillable = ['entry_date', 'payment_type', 'prepared_by', 'payment_number', 'income_category', 'amount', 'deposit_transaction_number_id', 'invoice_number_id', 'sales_credit_note_number_id', 'client_id', 'debit_note_number_id', 'vendor_id', 'operation_type_id', 'project_type_id', 'project_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Income::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_payment_type = ["Invoice pymt" => "Invoice pymt", "Invoice and credit note pymt" => "Invoice & credit note pymt", "Refund account credit" => "Refund account credit", "Refund cashback" => "Refund cashback", "Other Payment" => "Other Payment"];

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
    public function setDepositTransactionNumberIdAttribute($input)
    {
        $this->attributes['deposit_transaction_number_id'] = $input ? $input : null;
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
    public function setSalesCreditNoteNumberIdAttribute($input)
    {
        $this->attributes['sales_credit_note_number_id'] = $input ? $input : null;
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
    public function setDebitNoteNumberIdAttribute($input)
    {
        $this->attributes['debit_note_number_id'] = $input ? $input : null;
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
    public function setOperationTypeIdAttribute($input)
    {
        $this->attributes['operation_type_id'] = $input ? $input : null;
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
     * Set attribute to money format
     * @param $input
     */
    public function setAmountAttribute($input)
    {
        $this->attributes['amount'] = $input ? $input : null;
    }
    
    public function deposit_transaction_number()
    {
        return $this->belongsTo(BankPayment::class, 'deposit_transaction_number_id');
    }
    
    public function invoice_number()
    {
        return $this->belongsTo(IncomeCategory::class, 'invoice_number_id');
    }
    
    public function sales_credit_note_number()
    {
        return $this->belongsTo(CreditNote::class, 'sales_credit_note_number_id');
    }
    
    public function client()
    {
        return $this->belongsTo(TimeProject::class, 'client_id');
    }
    
    public function debit_note_number()
    {
        return $this->belongsTo(DebitNote::class, 'debit_note_number_id');
    }
    
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id')->withTrashed();
    }
    
    public function operation_type()
    {
        return $this->belongsTo(OperationType::class, 'operation_type_id')->withTrashed();
    }
    
    public function project_type()
    {
        return $this->belongsTo(TimeWorkType::class, 'project_type_id');
    }
    
    public function project_number()
    {
        return $this->belongsTo(TimeEntry::class, 'project_number_id');
    }

    public function income_category()
    {
        return $this->belongsTo(TimeEntry::class, 'income_category_id');
    } 
    
}
