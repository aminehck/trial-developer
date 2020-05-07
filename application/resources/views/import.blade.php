@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mt-5">
        <h1 class="h2 mx-auto">Import CSV File</h1>
    </div>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <form method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <img src="{{asset('images/csv.png')}}" class="mb-4 mx-auto d-block" width="80" alt="csv">
                    <div class="custom-file">
                        <input type="file" name="csv" required class="custom-file-input"  accept=".csv" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose CSV file</label>
                    </div>
                    <button type="submit" class="btn btn-info mx-auto mt-2 mb-3 d-block">Import</button>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-info" role="alert">
                            <strong>{{ $message }}</strong>
                          </div>
                    @endif
                </div>
            </form>
        </div>
    </div>

@endsection
