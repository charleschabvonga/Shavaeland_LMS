<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class Expense
 *
 * @package App
 * @property string $entry_date
 * @property enum $payment_type
 * @property string $vendor
 * @property string $client
 * @property string $vendor_credit_note_number
 * @property string $client_credit_note_number
 * @property string $debit_note_number
 * @property string $withdrawal_transaction_number
 * @property string $operation_type
 * @property string $transaction_type
 * @property string $transaction_number
 * @property string $payment_number
 * @property string $expense_category
 * @property decimal $amount
 * @property string $prepared_by
*/
class Expense extends Model
{
    protected $fillable = ['entry_date', 'payment_type', 'payment_number', 'expense_category', 'amount', 'prepared_by', 'vendor_id', 'client_id', 'vendor_credit_note_number_id', 'client_credit_note_number_id', 'debit_note_number_id', 'withdrawal_transaction_number_id', 'operation_type_id', 'transaction_type_id', 'transaction_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Expense::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_payment_type = ["Vendor tax invoice pymt" => "Vendor tax invoice pymt", "Purchase credit note and debit note pymt" => "Purchase credit note & debit note pymt", "Refund cashback" => "Refund cashback", "Refund account credit" => "Refund account credit", "Salaries" => "Salaries", "Other Payment" => "Other Payment"];

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
    public function setClientIdAttribute($input)
    {
        $this->attributes['client_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setVendorCreditNoteNumberIdAttribute($input)
    {
        $this->attributes['vendor_credit_note_number_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setClientCreditNoteNumberIdAttribute($input)
    {
        $this->attributes['client_credit_note_number_id'] = $input ? $input : null;
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
    public function setWithdrawalTransactionNumberIdAttribute($input)
    {
        $this->attributes['withdrawal_transaction_number_id'] = $input ? $input : null;
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
     * Set attribute to money format
     * @param $input
     */
    public function setAmountAttribute($input)
    {
        $this->attributes['amount'] = $input ? $input : null;
    }
    
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id')->withTrashed();
    }
    
    public function client()
    {
        return $this->belongsTo(TimeProject::class, 'client_id');
    }
    
    public function vendor_credit_note_number()
    {
        return $this->belongsTo(ExpenseCategory::class, 'vendor_credit_note_number_id');
    }
    
    public function client_credit_note_number()
    {
        return $this->belongsTo(CreditNote::class, 'client_credit_note_number_id');
    }
    
    public function debit_note_number()
    {
        return $this->belongsTo(DebitNote::class, 'debit_note_number_id');
    }
    
    public function withdrawal_transaction_number()
    {
        return $this->belongsTo(VendorBankPayment::class, 'withdrawal_transaction_number_id');
    }
    
    public function operation_type()
    {
        return $this->belongsTo(OperationType::class, 'operation_type_id')->withTrashed();
    }
    
    public function transaction_type()
    {
        return $this->belongsTo(TimeWorkType::class, 'transaction_type_id');
    }
    
    public function transaction_number()
    {
        return $this->belongsTo(TimeEntry::class, 'transaction_number_id');
    }

    public function expense_category()
    {
        return $this->belongsTo(TimeEntry::class, 'expense_category_id');
    }
    
}
