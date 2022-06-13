@extends('layouts.layout')

@section('main')
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[500px]">
        <form class="w-full max-w-lg" method="POST" action="{{ route('reserve.firstStore') }}">
            @csrf
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        Name
                    </label>
                    <input name="name" id="name"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        type="text" placeholder="Jane">
                    {{-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> --}}
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Phone
                    </label>
                    <input name="phone" id="phone"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        type="text" placeholder="09180001111">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                        Service
                    </label>
                    <div class="relative">
                        <select name="service"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-state">
                            <option disabled selected value="">Select...</option>
                            <option value="out_side">Outside Car</option>
                            <option value="in_side">Inside Car</option>
                            <option value="master">Master</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
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
            </div>
            <div class="flex flex-wrap -mx-3 mb-6 hidden" id="date">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Day
                    </label>
                    <input name="day"
                        id="input-date"
                        min="{{ date('Y-m-d') }}"
                        max="{{ date('Y-m-d', strtotime('+7 days')) }}"
                        value="{{ date('Y-m-d') }}"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        type="date">
                </div>
                <input type="hidden" value="{{ date('Y-m-d') }}" id="replace">
            </div>
            <div class="flex flex-wrap mb-6" id="submit">
                <button type="submit" id="ok"
                    class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Reserve</button>
            </div>

        </form>
        <script src="{{ asset('js/form.js') }}"></script>
    </div>
@endsection
