@extends('layouts.layout')

@section('main')
    <div
        class="opacity-90 overflow-auto mx-auto mt-[10vh] p-4 w-[700px] bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between items-center mb-4">
            <h5 class="px-3 text-xl font-bold leading-none text-gray-900 dark:text-white">{{ $user->name }}</h5>
        </div>
        <div class="flow-root h-[500px]">
            <ul role="list" class="">
                @foreach ($user->reserves as $item)
                    <li class="p-3 rounded-md sm:py-4 hover:shadow-lg hover:shadow-zinc-900/70 hover:bg-gray-100">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    {{ $item->service }}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    {{ $item->date_for_admin }}
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                ${{ $item->price }}
                            </div>
                        </div>
                    </li>
                @endforeach
                <li class="px-3 sm:py-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                Total
                            </p>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                            ${{ $user->total_price }}
                        </div>
                    </div>
                </li>
                <li class="px-3 sm:py-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                Last Reserve
                            </p>
                        </div>
                        <div class="inline-flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $user->last_reserve }}
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection
