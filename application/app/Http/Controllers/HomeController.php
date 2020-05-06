<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Client;
use App\Deal;

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

    public function transactions()
    {
        $transactions = Transaction::orderBy('created_at')->paginate(15);
        return view('transactions', ['transactions' => $transactions]);
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
}
