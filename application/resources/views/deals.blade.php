@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <h1 class="h2">Deals</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{route('import')}}" class="btn btn-sm btn-outline-info">
                <span data-feather="file-text"></span>
                Import CSV file
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Number of transactions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deals as $deal)
            <tr>
                <td>{{$deal->id}}</td>
                <td>{{$deal->deal}}</td>
                <td>{{sizeof($deal->transactions)}}</td>
            </tr>    
            @endforeach
        </tbody>
        </table>
    </div>
    {{$deals->links()}}
@endsection
