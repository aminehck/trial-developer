@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{route('import')}}" class="btn btn-sm btn-outline-info">
                <span data-feather="file-text"></span>
                Import CSV file
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card-counter primary">
                <i class="fa fa-cart-plus"></i>
                <span class="count-numbers">{{$transactions}}</span>
                <span class="count-name">Transactions</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-counter info">
                <i class="fa fa-handshake-o"></i>
                <span class="count-numbers">{{$accepted}}</span>
                <span class="count-name">Accepted</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-counter danger">
                <i class="fa fa-ban"></i>
                <span class="count-numbers">{{$refused}}</span>
                <span class="count-name">Refused</span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-counter warning">
                <i class="fa fa-ticket"></i>
                <span class="count-numbers">{{$deals}}</span>
                <span class="count-name">Deals</span>
            </div>
        </div>
    
        <div class="col-md-4">
            <div class="card-counter success">
                <i class="fa fa-users"></i>
                <span class="count-numbers">{{$clients}}</span>
                <span class="count-name">Clients</span>
            </div>
        </div>
    </div>

@endsection
