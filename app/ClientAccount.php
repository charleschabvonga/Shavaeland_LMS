<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ClientAccount
 *
 * @package App
 * @property string $client
 * @property string $contact_person
 * @property string $account_manager
 * @property string $account_number
 * @property enum $status
*/
class ClientAccount extends Model
{
    use SoftDeletes;

    protected $fillable = ['account_number', 'status', 'client_id', 'contact_person_id', 'account_manager_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        ClientAccount::observe(new \App\Observers\UserActionsObserver);
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
            foreach($this->sales_credit_note as $item){
                if ($item->refund_type == 'Sales refund cashback') {
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
        if ($this->account_balance == 0 && count($this->income_category) == 0){
            $status = 'Not active';
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
    
    //--------------- Invoice Totals calculations ---------------//
    public function getInvTotalDueAttribute(){
        $income = 0;
        foreach($this->income_category as $item){
            $income += $item->total_amount;
        }
        return $income;
    }
    public function getInvTotalPaidAttribute(){
        $income = 0;
        foreach($this->income_category as $item){
            $income += $item->paid_to_date;
        }
        return $income;
    }
    public function getInvTotalBalanceAttribute(){
        $income = 0;
        foreach($this->income_category as $item){
            $income += $item->balance;
        }
        return $income;
    }

    //--------------- Inbound Deposits Totals calculations ---------------//
    public function getTotalInboundDepositAttribute(){
        $income = 0;
        foreach($this->inbound_deposits as $item){
            $income += $item->amount;
        }
        return $income;
    }
    public function getTotalInboundDepositBalanceAttribute(){
        $income = 0;
        foreach($this->inbound_deposits as $item){
            $income += $item->balance;
        }
        return $income;
    }

    //--------------- Inbound Payments Totals calculations ---------------//
    public function getTotalPaymentsAttribute(){
        $income = 0;
        foreach($this->inbound_payments as $item){
            $income += $item->amount;
        }
        return $income;
    }

    //--------------- Sales Credit Note Totals calculations ---------------//
    public function getSalesCreditNoteTotalDueAttribute(){
        $income = 0;
        foreach($this->sales_credit_note as $item){
            $income += $item->total_amount;
        }
        return $income;
    }
    public function getSalesCreditNoteTotalPaidAttribute(){
        $income = 0;
        foreach($this->sales_credit_note as $item){
            $income += $item->paid_to_date;
        }
        return $income;
    }
    public function getSalesCreditNoteTotalBalanceAttribute(){
        $income = 0;
        foreach($this->sales_credit_note as $item){
            $income += $item->balance;
        }
        return $income;
    }

    //--------------- Sales Outbound Deposits Totals calculations ---------------//
    public function getTotalOutboundDepositAttribute(){
        $income = 0;
        foreach($this->outbound_deposit as $item){
            $income += $item->amount;
        }
        return $income;
    }
    public function getTotalOutboundDepositBalanceAttribute(){
        $income = 0;
        foreach($this->outbound_deposit as $item){
            $income += $item->balance;
        }
        return $income;
    }

    //--------------- Outbound Payments Totals calculations ---------------//
    public function getTotalOutboundPaymentsAttribute(){
        $income = 0;
        foreach($this->outbound_payments as $item){
            $income += $item->amount;
        }
        return $income;
    }

    //-------------------- Account Balance --------------------//------------------------------------------------
    public function getAccountBalanceAttribute(){
        $income = 0;
        foreach($this->income_category as $item){
            $income -= $item->total_amount;
        }
        foreach($this->inbound_deposits as $item){
            $income += $item->amount;
        }
        foreach($this->outbound_deposit as $item){
            $income -= $item->amount;
        }
        foreach($this->sales_credit_note as $item){
            if ($item->refund_type != 'Advance pymt refund') {
                $income += $item->total_amount;
            }
        }
        return $income;
    }
    //-------------------- Account Balance --------------------//------------------------------------------------
    
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

    public function income_category() {
        return $this->hasMany(IncomeCategory::class, 'client_id');
    }

    public function inbound_deposits() {
        return $this->hasMany(BankPayment::class, 'client_id');
    }

    public function inbound_payments() {
        return $this->hasMany(Income::class, 'client_id');
    }

    public function sales_credit_note() {
        return $this->hasMany(CreditNote::class, 'client_id');
    }

    public function outbound_deposit() {
        return $this->hasMany(VendorBankPayment::class, 'client_id');
    }

    public function outbound_payments() {
        return $this->hasMany(Expense::class, 'client_id');
    }
    
}
