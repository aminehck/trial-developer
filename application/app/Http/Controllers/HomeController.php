<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Client;
use App\Deal;
use DB;

use App\Imports\TransactionsImport;
use Maatwebsite\Excel\Facades\Excel;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transactions = Transaction::all()->count();
        $accepted = Transaction::all()->sum('accepted');
        $refused = Transaction::all()->sum('refused');
        $clients = Client::all()->count();
        $deals = Deal::all()->count();
        return view('home', ['transactions' => $transactions, 'deals' => $deals, 'clients' => $clients,
                            'refused' => $refused, 'accepted' => $accepted]);
    }

    public function transactions(Request $request)
    {
        //Get the eventual url parameters (from filter)
        $clientId = (isset($request->client) ? $request->client : null);
        $dealId = (isset($request->deal) ? $request->deal : null);
        $dates = (isset($request->dates) ? $request->dates : null);
        $groupBy = (isset($request->group_by) ? $request->group_by : null);
        // Compose the query 
        $transactions = Transaction::select('id', 'client_id', 'deal_id', 
        DB::raw('sum(accepted) as accepted'), DB::raw('sum(refused) as refused'),  'created_at');
        //Group By
        switch ($groupBy) {
            case 'hour':
                $transactions = $transactions->groupBy(DB::raw('HOUR(created_at)'), 'client_id');
                break;
            case 'day':
                $transactions = $transactions->groupBy(DB::raw('DAY(created_at)'));
                break;
            case 'month':
                $transactions = $transactions->groupBy(DB::raw('MONTH(created_at)'), 'client_id');
                break;
            default :
                $transactions = $transactions->groupBy(DB::raw('created_at'));
                break;
        }
        $transactions = $transactions->where(function ($query) use ($clientId, $dealId, $dates) {
            if($clientId) {
                $query->where('client_id', '=', $clientId);
            }
            if($dealId) {
                $query->where('deal_id', '=', $dealId);
            }
            if($dates) {
                //Get $from & $to date range
                $range = explode(' -', $dates);
                //Format $from & $to date range in 'YYYY-mm-dd'
                $range[0] = date('Y-m-d', strtotime($range[0]));
                $range[1] = date('Y-m-d', strtotime($range[1]));
                $query->whereBetween('created_at', $range);
            }
        })->paginate(15);
        $clients = Client::all();
        $deals = Deal::all();
        return view('transactions', ['transactions' => $transactions, 'clientId' => $clientId, 'dealId' => $dealId,
                    'dates' => $dates, 'groupBy' => $groupBy, 'clients' => $clients, 'deals' => $deals]);
    }

    public function clients()
    {
        $clients = Client::orderBy('created_at')->paginate(15);
        return view('clients', ['clients' => $clients]);
    }

    public function deals()
    {
        $deals = Deal::orderBy('created_at')->paginate(15);
        return view('deals', ['deals' => $deals]);
    }

    public function import(Request $request)
    {
        return view('import');
    }

    public function importCsv(Request $request)
    {   
            $request->validate([
                'csv' => 'required'
            ]);
            Excel::import(new TransactionsImport, request()->file('csv'));
            return redirect()->route('import')->with('success', 'File imported successfully.');
        
    }

}
