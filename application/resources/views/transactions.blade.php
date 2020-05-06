@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <h1 class="h2">Transactions</h1>
        {{-- <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button>
        </div> --}}
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
        <thead class="bg-info text-white">
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Deal</th>
                <th>Hour</th>
                <th>Accepted</th>
                <th>Refused</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <td>{{$transaction->id}}</td>
                <td>{{$transaction->client->client}}</td>
                <td>{{$transaction->deal->deal}}</td>
                <td>{{date('m-d-y H:s', strtotime($transaction->created_at))}}</td>
                <td>{{$transaction->accepted}}</td>
                <td>{{$transaction->refused}}</td>
            </tr>
            @endforeach
        </tbody>
        </table>
        
        {{$transactions->links()}}
        
    </div>
    
@endsection
