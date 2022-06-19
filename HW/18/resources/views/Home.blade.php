@extends('layouts.layout')

@section('main')
    <div
        class="opacity-80 mx-auto mt-[10vh] p-4 w-[700px] bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex gap-2 items-center mb-4">
            <h5 class="px-3 text-xl font-bold leading-none text-gray-900 dark:text-white">{{ $user->name }}</h5>
            <div class="flex gap-4 items-center">
                <!-- Modal HTML embedded directly into document -->
                <div id="ex1" class="modal">
                    <form method="POST" action="{{ route('reserve.updateName', $user) }}" class="w-full max-w-sm">
                        @method('PUT')
                        @csrf
                        <div class="flex items-center border-b border-teal-500 py-2">
                            <input name="name"
                                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                                type="text" placeholder="Jane Doe" aria-label="Full name">
                            <button
                                class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                                type="submit">
                                Edit Name
                            </button>
                            <button onclick="clearValue(this)"
                                class="flex-shrink-0 border-transparent border-4 text-teal-500 hover:text-teal-800 text-sm py-1 px-2 rounded"
                                type="button">
                                Cancel
                            </button>
                        </div>
                    </form>
                    {{-- <a href="#" rel="modal:close">Close</a> --}}
                </div>

                <!-- Link to open the modal -->
                <a class="w-fit pt-1" href="#ex1" rel="modal:open">
                    <svg class="h-5 w-5 text-blue-500" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                        <line x1="16" y1="5" x2="19" y2="8" />
                    </svg>
                </a>

                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror

            </div>
        </div>
        @if ($admin)
            <div class="flex flex-col gap-5">
                <p class="px-3 font-normal text-gray-700 dark:text-gray-400">
                    Phone : {{ $user->phone }}
                </p>
            </div>
        @else
            <div class="flow-root">
                <ul role="list" class="">
                    @foreach ($user->reserves as $item)
                        <a href="{{ route('reserve.show', $item) }}">
                            <li class="p-3 rounded-md sm:py-4 hover:shadow-lg hover:shadow-zinc-900/70 hover:bg-gray-200">

                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-black truncate dark:text-white">
                                            {{ $item->service }}
                                        </p>
                                        <p class="text-sm text-gray-700 truncate dark:text-gray-400">
                                            {{ $item->date_for_admin }}
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        ${{ $item->price }}
                                    </div>
                                </div>
                            </li>
                        </a>
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
                </ul>
            </div>
        @endif
    </div>
@endsection
