@extends('layouts._layout')
@section('content')
<div class="container-fluid" style="padding: 30px">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <h5 class="card-header" style="background-color: yellow">Total User Management</h5>
                <div class="card-body">
                    <h2 class="card-title">{{$users}}</h2>
                    <h5 class="card-text">People</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <h5 class="card-header" style="background-color: orange">Total Contact</h5>
                <div class="card-body">
                    <h2 class="card-title">{{$contacts}}</h2>
                    <h5 class="card-text">People</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection