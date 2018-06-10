@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    @if ($account)
                    <div class="panel-heading"><h1> {{ $account->title }} Account</h1></div>
                    @endif

                    <div class="panel-body">
                        @if (session('status'))
                        <div class="alert {{ session('status-class') }}">
                            {{ session('status') }}
                        </div>
                        @endif
                    </div>
                    @if ($account && $transactions)
                        @foreach ($transactions as $transaction)
                            <p> {{ $transaction->payee }} </p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
