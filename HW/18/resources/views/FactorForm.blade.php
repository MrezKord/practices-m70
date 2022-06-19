@extends('layouts.layout')

@section('main')
    <div class="w-[500px] mx-auto my-[27vh]">
        <div class="w-full h-full">
            <form method="POST" action="{{ route('reserve.trackCodeCheck') }}"
                class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="orderTrack">
                        Order Track
                    </label>
                    <input name="track_code"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="orderTrack" type="text">
                    @error('track_code')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
