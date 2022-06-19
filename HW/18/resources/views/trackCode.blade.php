@extends('layouts.layout')

@section('main')
    <div class="w-[500px] text-center mx-auto mt-[27vh] flex flex-col gap-4">
        <div class="text-[30px] font-bold text-green-600">
            Your request has been successfully submitted
        </div>
        <div class="text-[20px] font-bold">
            Tracking Code : {{ $reserve->track_code }}
        </div>
    </div>
@endsection