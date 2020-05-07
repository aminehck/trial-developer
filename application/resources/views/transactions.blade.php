@extends('layouts.app')

@section('content')
    <div class="row mt-2 mb-3">
        <div class="col-12 mb-2">
            <h1 class="h2">Transactions</h1>
        </div>
        
        <form id="filterForm" class="col-12" method="GET">
            <div class="row" >
                <div class="col-lg-3 col-md-6">
                    <select id="client" name="client" class="form-control">
                        <option value="">Client ID </option>
                        @foreach ($clients as $client)
                            <option {{($client->id == $clientId) ? 'selected' : ''}} value="{{$client->id}}">
                                {{$client->id}} - {{$client->client}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-6">
                    <select id="deal" name="deal" class="form-control">
                        <option value="">Deal ID </option>
                        @foreach ($deals as $deal)
                            <option {{($deal->id == $dealId) ? 'selected' : ''}} value="{{$deal->id}}">
                                {{$deal->id}} - {{$deal->deal}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-6">
                    <input id="dates" type="text" name="dates" class="form-control" placeholder="Date range" value="{{$dates}}">
                </div>
                <div class="col-lg-2 col-md-6">
                    <select id="group_by" name="group_by" class="form-control">
                        <option value="">Group by</option>
                        <option {{(!strcmp($groupBy, 'month')) ? 'selected' : ''}} value="month">Group by Month</option>
                        <option {{(!strcmp($groupBy, 'day')) ? 'selected' : ''}} value="day">Group by Day</option>
                        <option {{(!strcmp($groupBy, 'hour')) ? 'selected' : ''}} value="hour">Group by Hour</option>
                    </select>
                </div>
                <div class="col-lg-1 col-md-6">
                    <input type="submit" class="btn btn-info btn-block" value="Filter">
                </div>
            </div>
        </form>
        
    </div>

    @if(sizeof($transactions))
    <div class="table-responsive">
        <table class="table table-striped table-sm">
        <thead class="bg-info text-white">
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Deal</th>
                <th>
                    {{(empty($groupBy)) ? 'Created @' : $groupBy}}
                </th>
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
                <td>
                    @switch($groupBy)
                        @case('month')
                            {{date('F', strtotime($transaction->created_at))}}
                            @break
                        @case('day')
                        {{date('M, d-Y', strtotime($transaction->created_at))}}
                            @break
                        @case('hour')
                            {{date('H:s', strtotime($transaction->created_at))}}
                            @break;
                        @default
                            {{date('m-d-y H:s', strtotime($transaction->created_at))}}
                    @endswitch

                </td>
                <td>{{$transaction->accepted}}</td>
                <td>{{$transaction->refused}}</td>
            </tr>
            @endforeach
        </tbody>
        </table>
        
        {{$transactions->appends(['client' => $clientId, 'deal' => $dealId, 'dates' => $dates, 'group_by' => $groupBy])->links()}}
        
    </div>
    @else 
    <p class="mt-5 text-center">No record found !</p>
    @endif

    {{-- Init Date Picker --}}
    <script>
        $('input[name="dates"]').daterangepicker({
            autoUpdateInput: false,
            autoApply: true,
            locale: {
                cancelLabel: 'Clear'
            }
        });
        $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    </script>


    {{-- Ignore Empty $_GET in the url --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $("#filterForm").submit(function() {
                if($("#client").val()=="") {
                        $("#client").remove();
                }
                if($("#deal").val()=="") {
                        $("#deal").remove();
                }
                if($("#dates").val()=="") {
                        $("#dates").remove();
                }
                if($("#group_by").val()=="") {
                        $("#group_by").remove();
                }
            });
        });
    </script>
@endsection
