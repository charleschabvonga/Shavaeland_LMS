<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class PurchaseOrder
 *
 * @package App
 * @property string $vendor
 * @property string $contact_person
 * @property string $buyer
 * @property string $purchase_order_number
 * @property string $date
 * @property string $request_date
 * @property string $procurement_date
 * @property string $quotation_number
 * @property decimal $subtotal
 * @property enum $status
 * @property double $vat
 * @property decimal $vat_amount
 * @property decimal $total_amount
 * @property string $prepared_by
 * @property string $requested_by
 * @property tinyInteger $hod
 * @property tinyInteger $gm
 * @property tinyInteger $accounts
*/
class PurchaseOrder extends Model
{
    protected $fillable = ['purchase_order_number', 'date', 'request_date', 'procurement_date', 'quotation_number', 'subtotal', 'status', 'vat', 'vat_amount', 'total_amount', 'prepared_by', 'requested_by', 'hod', 'gm', 'accounts', 'vendor_id', 'contact_person_id', 'buyer_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        PurchaseOrder::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_status = ["Requested" => "Requested", "Confirmed" => "Confirmed", "Approved" => "Approved", "Purchased" => "Purchased"];

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
    public function setBuyerIdAttribute($input)
    {
        $this->attributes['buyer_id'] = $input ? $input : null;
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
     * Set attribute to date format
     * @param $input
     */
    public function setRequestDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['request_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['request_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getRequestDateAttribute($input)
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
    public function setProcurementDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['procurement_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['procurement_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getProcurementDateAttribute($input)
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
    
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id')->withTrashed();
    }
    
    public function contact_person()
    {
        return $this->belongsTo(VendorContact::class, 'contact_person_id')->withTrashed();
    }
    
    public function buyer()
    {
        return $this->belongsTo(Employee::class, 'buyer_id')->withTrashed();
    }
    
    public function invoice_items() {
        return $this->hasMany(InvoiceItem::class, 'purchase_order_number_id');
    }
}
