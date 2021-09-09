@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 <Dashboard :userlist="{{ $user->toJson() }}" :rolelist="{{ $role->toJson() }}"/>     
            </div>
        </div>
    </div>
</div>
@endsection
