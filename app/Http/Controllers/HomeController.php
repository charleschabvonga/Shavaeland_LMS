<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $quotations = \App\Quotation::latest()->limit(5)->get(); 
        $purchaseorders = \App\PurchaseOrder::latest()->limit(5)->get(); 
        $roadfreights = \App\RoadFreight::latest()->limit(5)->get(); 
        $timeentries = \App\TimeEntry::latest()->limit(5)->get(); 
        $inhousejobcards = \App\InhouseJobCard::latest()->limit(5)->get(); 

        return view('home', compact( 'quotations', 'purchaseorders', 'roadfreights', 'timeentries', 'inhousejobcards' ));
    }
}
