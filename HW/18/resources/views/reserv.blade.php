{{-- @dd($errors) --}}

@extends('layouts.layout')

@section('main')
    <div class="absolute py-10 bg-white opacity-80 rounded-md top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px]">
        <form class="w-full max-w-lg mx-auto" method="POST" action="{{ route('reserve.firstStore') }}">
            @csrf
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                        Service
                    </label>
                    <div class="relative">
                        <select name="service"
                            class="hover:shadow-lg hover:shadow-zinc-900/70 block mb-3 appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-state">
                            <option disabled selected value="">Select...</option>
                            @foreach ($services as $item)
                                <option value="{{ $item->name }}">{{ $item->label_service }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('service')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-6">
                <div class="flex items-center mb-4">
                    <input id="country-option-1" type="radio" name="type-time" value="soon" onclick="check(this)"
                        class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600"
                        checked="">
                    <label for="country-option-1" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        Soon
                    </label>
                </div>
                <div class="flex items-center mb-4">
                    <input id="country-option-2" type="radio" name="type-time" value="after" onclick="check(this)"
                        class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="country-option-2" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        After
                    </label>
                </div>
                @error('type_time')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-wrap -mx-3 mb-6 hidden" id="date">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Day
                    </label>
                    <input name="day" id="input-date" min="{{ date('Y-m-d') }}"
                        max="{{ date('Y-m-d', strtotime('+7 days')) }}" value="{{ date('Y-m-d') }}"
                        class="hover:shadow-lg hover:shadow-zinc-900/70 appearance-none mb-3 block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        type="date">
                    @error('day')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <input type="hidden" value="{{ date('Y-m-d') }}" id="replace">
            </div>
            <div class="flex flex-wrap mb-6" id="submit">
                <button type="submit" id="ok"
                    class="text-white hover:shadow-lg hover:shadow-zinc-900/70 w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Reserve</button>
            </div>

        </form>
        <script src="{{ asset('js/form.js') }}"></script>
    </div>
@endsection
