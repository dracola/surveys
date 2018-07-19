@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="text-center">
                                <a href="{{ route('users.index') }}" class="btn btn-primary">Users</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-center">
                                <a href="{{ route('surveys.index') }}" class="btn btn-success">Surveys</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
