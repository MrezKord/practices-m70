@extends('layouts.layout')

@section('main')
    <div class="w-[500px] text-center mx-auto mt-[27vh] flex flex-col gap-4">
        <div>
            {{ $reserve->track_code }}
        </div>
        <div>
            <a href="{{ route('reserve.index') }}"
                class="text-white w-[200px] text-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
        </div>
    </div>
@endsection