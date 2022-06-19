@extends('layouts.layout')

@section('main')
    <div class="opacity-90 p-8 bg-white rounded-md w-[600px] mx-auto mt-[14vh]">

        <div
            class="shadow-lg shadow-zinc-900/70 w-full h-full bg-white rounded-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5 flex flex-col gap-7">

                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Factor
                </h5>

                <div class="flex flex-col gap-5">
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        {{ $reserve->date }}
                    </p>


                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        Phone : {{ $reserve->user->phone }}
                    </p>

                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        Service : {{ $reserve->service }}
                    </p>

                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        Price : {{ $reserve->price }}
                    </p>

                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        Tracking Code : {{ $reserve->track_code }}
                    </p>
                </div>
                @if ($reserve->CheckTimeForChenge())
                    <div class="flex justify-between">
                        <a href="{{ route('reserve.edit', $reserve) }}"
                            class="hover:shadow-lg hover:shadow-zinc-900/70 w-[200px] inline-flex justify-center items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <span>Edit</span>
                        </a>
                        <form class="w-fit" action="{{ route('reserve.destroy', $reserve) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button
                                class="hover:shadow-lg hover:shadow-zinc-900/70 w-[200px] inline-flex items-center justify-center py-2 px-3 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                <span>Delete</span>
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
