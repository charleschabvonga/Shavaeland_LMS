<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class Quotation
 *
 * @package App
 * @property string $client
 * @property string $contact_person
 * @property string $sales_person
 * @property string $quotation_number
 * @property string $date
 * @property string $due_date
 * @property enum $status
 * @property decimal $subtotal
 * @property double $vat
 * @property decimal $vat_amount
 * @property decimal $total_amount
 * @property string $prepared_by
*/
class Quotation extends Model
{
    protected $fillable = ['quotation_number', 'date', 'due_date', 'status', 'subtotal', 'vat', 'vat_amount', 'total_amount', 'prepared_by', 'client_id', 'contact_person_id', 'sales_person_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Quotation::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_status = ["Draft" => "Draft", "Sent" => "Sent", "Confirmed" => "Confirmed", "Unconfirmed" => "Unconfirmed", "Invoiced" => "Invoiced", "Expired" => "Expired"];

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
    public function setSalesPersonIdAttribute($input)
    {
        $this->attributes['sales_person_id'] = $input ? $input : null;
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

    public function getStatusAttribute($input)
    {
        $status = "Draft";
        foreach($this->invoice as $item){
            $status = "Invoiced";
        }        
        return $status;
    }
    
    public function client()
    {
        return $this->belongsTo(TimeProject::class, 'client_id');
    }
    
    public function contact_person()
    {
        return $this->belongsTo(ClientContact::class, 'contact_person_id')->withTrashed();
    }
    
    public function sales_person()
    {
        return $this->belongsTo(Employee::class, 'sales_person_id')->withTrashed();
    }
    
    public function invoice_items() {
        return $this->hasMany(InvoiceItem::class, 'quotation_number_id');
    }

    public function invoice() {
        return $this->hasMany(IncomeCategory::class, 'quotation_number_id');
    }
}
