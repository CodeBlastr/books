@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Create Account</h1></div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        well let's look at some accounts
                            @foreach ($accounts as $account)
                                <p>This is account {{ $account->id }}</p>
                            @endforeach

                        <div class="table-responsive">
                            <table class="table table-striped">
                                @foreach ($credentials as $credential)

                                    <tr>
                                        <td>{{ $credential->name }}</td>
                                        <td>{{ $credential->status }}</td>
                                        <td>{{ $credential->data }}</td>
                                    </tr>

                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
