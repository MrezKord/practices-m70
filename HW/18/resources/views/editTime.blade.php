@extends('layouts.layout')

@section('meta')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
@endsection

@section('main')
    <form action="{{ route('reserve.update', $reserve) }}" method="POST"
        class="flex bg-white px-10 flex-col gap-3 items-center mx-auto mt-[6vh] w-[800px] rounded-md opacity-90">
        @method('PUT')
        @csrf
        <div class="flex flex-col gap-3 text-center">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Date : {{ str_replace('-', '/', $request['day']) }}
            </h5>
            <p class="text-[20px] font-normal text-gray-700 dark:text-gray-400">
                Price : {{ $price }}
            </p>
        </div>
        @error('time')
            <p class="text-red-500 italic">{{ $message }}</p>
        @enderror
        <div class="mb-4 w-full shadow-zinc-900/70 relative overflow-x-auto shadow-lg sm:rounded-lg flex flex-col gap-5" id="test-list">
            <div class="p-4">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                        class="search bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search for start time">
                </div>
            </div>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Start
                        </th>
                        <th scope="col" class="px-6 py-3">
                            End
                        </th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($time as $item)
                        <tr
                            class=" bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input type="radio" name="time"
                                        value="{{ $item[0] . '-' . $item[1] . '-' . $item['station_id'] }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <td class="name px-6 py-4 text-black">
                                {{ $item[0] }}
                            </td>
                            <td class="px-6 py-4 text-black">
                                {{ $item[1] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex justify-center mb-3">
                <ul class="pagination inline-flex -space-x-px"></ul>
            </div>
        </div>

        <div class="flex justify-between flex-wrap mb-6 w-full gap-4" id="submit">
            <a href="{{ route('reserve.edit', $reserve) }}"
                class="text-white hover:shadow-lg hover:shadow-zinc-900/70 w-[200px] text-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
            <button type="submit" id="ok"
                class="text-white hover:shadow-lg hover:shadow-zinc-900/70 w-[200px] bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Reserve</button>
        </div>
    </form>
    <script>
        var monkeyList = new List('test-list', {
            valueNames: ['name'],
            page: 4,
            pagination: true
        });
    </script>
    <script src="{{ asset('js/reserve.js') }}"></script>
@endsection
