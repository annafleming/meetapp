@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-push-4 col-sm-8 col-sm-push-4">
            <meeting-list></meeting-list>
        </div>

        <div class="col-md-3 col-md-pull-7 col-md-offset-1 col-sm-4 col-sm-pull-8 col-sm-offset-0">
            <user-list></user-list>
        </div>

    </div>
</div>
@endsection
