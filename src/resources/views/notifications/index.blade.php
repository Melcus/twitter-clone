@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="w-3/12">nav</div>
        <div class="w-7/12 border border-gray-800 border-t-0 border-b-0">
            <app-notifications/>
        </div>
    </div>
@endsection
