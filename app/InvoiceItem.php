<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InvoiceItem
 *
 * @package App
 * @property string $invoice_number
 * @property string $bill_number
 * @property string $credit_note_number
 * @property string $debit_note_number
 * @property string $clearance_and_forwarding_number
 * @property string $quotation_number
 * @property string $purchase_order_number
 * @property string $item_description
 * @property decimal $unit_price
 * @property double $qty
 * @property string $unit
 * @property decimal $total
*/
class InvoiceItem extends Model
{
    use SoftDeletes;

    protected $fillable = ['item_description', 'unit_price', 'qty', 'unit', 'total', 'invoice_number_id', 'bill_number_id', 'credit_note_number_id', 'debit_note_number_id', 'clearance_and_forwarding_number_id', 'quotation_number_id', 'purchase_order_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        InvoiceItem::observe(new \App\Observers\UserActionsObserver);
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
    public function setBillNumberIdAttribute($input)
    {
        $this->attributes['bill_number_id'] = $input ? $input : null;
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
    public function setDebitNoteNumberIdAttribute($input)
    {
        $this->attributes['debit_note_number_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setClearanceAndForwardingNumberIdAttribute($input)
    {
        $this->attributes['clearance_and_forwarding_number_id'] = $input ? $input : null;
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
    public function setUnitPriceAttribute($input)
    {
        $this->attributes['unit_price'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setUnitAttribute($input)
    {
        $this->attributes['unit'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setQtyAttribute($input)
    {
        if ($input != '') {
            $this->attributes['qty'] = $input;
        } else {
            $this->attributes['qty'] = null;
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setTotalAttribute($input)
    {
        $this->attributes['total'] = $input ? $input : null;
    }
    
    public function invoice_number()
    {
        return $this->belongsTo(IncomeCategory::class, 'invoice_number_id');
    }
    
    public function bill_number()
    {
        return $this->belongsTo(ExpenseCategory::class, 'bill_number_id');
    }
    
    public function credit_note_number()
    {
        return $this->belongsTo(CreditNote::class, 'credit_note_number_id');
    }
    
    public function debit_note_number()
    {
        return $this->belongsTo(DebitNote::class, 'debit_note_number_id');
    }
    
    public function clearance_and_forwarding_number()
    {
        return $this->belongsTo(ClearanceAndForwarding::class, 'clearance_and_forwarding_number_id')->withTrashed();
    }
    
    public function quotation_number()
    {
        return $this->belongsTo(Quotation::class, 'quotation_number_id');
    }
    
    public function purchase_order_number()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_number_id');
    }
    
}
