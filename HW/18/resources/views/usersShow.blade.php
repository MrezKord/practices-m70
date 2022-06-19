@extends('layouts.layout')

@section('main')
    <div class="flex flex-col w-fit mx-auto mt-[12vh] opacity-90 p-7 rounded-md bg-white gap-2 justify-center">
        <div class="w-[800px] p-4 mx-auto ">
            <div class="flex flex-wrap gap-5 justify-center items-center">
                @foreach ($users as $item)
                    <a href="{{ route('user.show', $item) }}"
                        class="w-[45%] h-[200px]
                        hover:shadow-lg
                        {{ $item->rangeColor() == 'red' ? 'bg-red-400' : '' }}
                        {{ $item->rangeColor() == 'green' ? 'bg-green-400' : '' }}
                        {{ $item->rangeColor() == 'orange' ? 'bg-orange-400' : '' }} 
                        {{ $item->rangeColor() == 'red' ? 'hover:bg-red-500 hover:shadow-red-900/70' : '' }}
                        {{ $item->rangeColor() == 'green' ? 'hover:bg-green-500 hover:shadow-green-900/70' : '' }}
                        {{ $item->rangeColor() == 'orange' ? 'hover:bg-orange-500 hover:shadow-orange-900/70' : '' }} 
                        flex flex-col items-center rounded-lg md:flex-row md:max-w-x dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-white dark:text-white">{{ $item->name }}</h5>
                            <p class="mb-3 font-normal text-white dark:text-gray-400">Number of services received in the last three months : {{ $item->getTimeReseve()->count() }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="flex flex-col gap-4 mx-auto">
            {{ $users->links() }}
        </div>
    </div>
@endsection
