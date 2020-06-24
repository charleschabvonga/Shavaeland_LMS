<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class VendorAccount
 *
 * @package App
 * @property string $vendor
 * @property string $contact_person
 * @property string $account_manager
 * @property string $account_number
 * @property enum $status
*/
class VendorAccount extends Model
{
    use SoftDeletes;

    protected $fillable = ['account_number', 'status', 'vendor_id', 'contact_person_id', 'account_manager_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        VendorAccount::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_status = ["Not active" => "Not active", "Payment due" => "Payment due", "Up to date" => "Up to date", "Paid off" => "Paid off", "Credit available" => "Credit available", "Refund pymt due" => "Refund pymt due", "Closed" => "Closed"];
    
    //--------------- Get status attribute ---------------//
    public function getStatusAttribute($input)
    {
        $status = "Not active";
        if ($this->account_balance < 0){
            $status = 'Payment due';
        }
        if ($this->account_balance > 0){
            $status = 'Credit available';
            foreach($this->debit_notes as $item){
                if ($item->refund_type == 'Purchase refund cashback') {
                    $status = 'Refund pymt due';
                }
                else {
                    $status = 'Credit available';
                }
            }
        }
        if ($this->account_balance == 0){
            $status = 'Paid off';
        }
        if ($this->account_balance == 0 && count($this->expense_category) == 0){
            $status = 'Not active';
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

    //--------------- Credit Note Totals calculations ---------------//
    public function getCreditNoteTotalDueAttribute(){
        $expense = 0;
        foreach($this->expense_category as $item){
            $expense += $item->total_amount;
        }
        return $expense;
    }
    public function getCreditNoteTotalPaidAttribute(){
        $expense = 0;
        foreach($this->expense_category as $item){
            $expense += $item->paid_to_date;
        }
        return $expense;
    }
    public function getCreditNoteTotalBalanceAttribute(){
        $expense = 0;
        foreach($this->expense_category as $item){
            $expense += $item->balance;
        }
        return $expense;
    }

    //--------------- Sales Outbound Deposits Totals calculations ---------------//
    public function getTotalOutboundDepositAttribute(){
        $expense = 0;
        foreach($this->outbound_deposit as $item){
            $expense += $item->amount;
        }
        return $expense;
    }
    public function getTotalOutboundDepositBalanceAttribute(){
        $expense = 0;
        foreach($this->outbound_deposit as $item){
            $expense += $item->balance;
        }
        return $expense;
    }

    //--------------- Outbound Payments Totals calculations ---------------//
    public function getTotalOutboundPaymentsAttribute(){
        $expense = 0;
        foreach($this->outbound_payments as $item){
            $expense += $item->amount;
        }
        return $expense;
    }

    //--------------- Debit Note Totals calculations ---------------//
    public function getDebitNoteTotalDueAttribute(){
        $expense = 0;
        foreach($this->debit_notes as $item){
            $expense += $item->total_amount;
        }
        return $expense;
    }
    public function getDebitNoteTotalPaidAttribute(){
        $expense = 0;
        foreach($this->debit_notes as $item){
            $expense += $item->paid_to_date;
        }
        return $expense;
    }
    public function getDebitNoteTotalBalanceAttribute(){
        $expense = 0;
        foreach($this->debit_notes as $item){
            $expense += $item->balance;
        }
        return $expense;
    }

    //--------------- Inbound Deposits Totals calculations ---------------//
    public function getTotalInboundDepositAttribute(){
        $expense = 0;
        foreach($this->inbound_deposits as $item){
            $expense += $item->amount;
        }
        return $expense;
    }
    public function getTotalInboundDepositBalanceAttribute(){
        $expense = 0;
        foreach($this->inbound_deposits as $item){
            $expense += $item->balance;
        }
        return $expense;
    }

    //--------------- Inbound Payments Totals calculations ---------------//
    public function getTotalInboundPaymentsAttribute(){
        $expense = 0;
        foreach($this->inbound_payments as $item){
            $expense += $item->amount;
        }
        return $expense;
    }






    //-------------------- Account Balance --------------------//------------------------------------------------
    public function getAccountBalanceAttribute(){
        $expense = 0;
        foreach($this->expense_category as $item){
            $expense -= $item->total_amount;
        }
        foreach($this->outbound_deposit as $item){
            $expense += $item->amount;
        }
        foreach($this->inbound_deposits as $item){
            $expense -= $item->amount;
        }
        
        foreach($this->debit_notes as $item){
            if ($item->refund_type != 'Advance pymt refund') {
                $expense += $item->total_amount;
            }
        }
        
        return $expense;
    }
    //-------------------- Account Balance --------------------//------------------------------------------------
    
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


    public function expense_category() {
        return $this->hasMany(ExpenseCategory::class, 'vendor_id');
    }

    public function outbound_deposit() {
        return $this->hasMany(VendorBankPayment::class, 'vendor_id');
    }

    public function outbound_payments() {
        return $this->hasMany(Expense::class, 'vendor_id');
    }

    public function debit_notes() {
        return $this->hasMany(DebitNote::class, 'vendor_id');
    }

    public function inbound_deposits() {
        return $this->hasMany(BankPayment::class, 'vendor_id');
    }

    public function inbound_payments() {
        return $this->hasMany(Income::class, 'vendor_id');
    }    
    
}
