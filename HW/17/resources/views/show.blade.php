@extends('layouts.layout')

@section('main')
    <div class="w-[600px] mx-auto mt-[16vh]">

        <div
            class="w-full h-full bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5 flex flex-col gap-7">

                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Factor
                </h5>

                <div class="flex flex-col gap-5">
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        {{ $reserve->date }}
                    </p>

                    <div class="flex gap-4 items-center">
                        <p class="font-normal text-gray-700 dark:text-gray-400">
                            Name : {{ $reserve->name }}
                        </p>

                        <!-- Modal HTML embedded directly into document -->
                        <div id="ex1" class="modal">
                            <form method="POST" action="{{ route('reserve.updateName', $reserve) }}" class="w-full max-w-sm">
                                @method('PUT')
                                @csrf
                                <div class="flex items-center border-b border-teal-500 py-2">
                                    <input
                                        name="name"
                                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                                        type="text" placeholder="Jane Doe" aria-label="Full name">
                                    <button
                                        class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                                        type="submit">
                                        Edit Name
                                    </button>
                                    <button
                                        onclick="clearValue(this)"
                                        class="flex-shrink-0 border-transparent border-4 text-teal-500 hover:text-teal-800 text-sm py-1 px-2 rounded"
                                        type="button">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                            {{-- <a href="#" rel="modal:close">Close</a> --}}
                        </div>

                        <!-- Link to open the modal -->
                        <a class="w-fit" href="#ex1" rel="modal:open">
                            <svg class="h-5 w-5 text-blue-500" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                <line x1="16" y1="5" x2="19" y2="8" />
                            </svg>
                        </a>
                    </div>

                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        Phone : {{ $reserve->phone }}
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
                            class="w-[200px] inline-flex justify-center items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <span>Edit</span>
                        </a>
                        <form class="w-fit" action="{{ route('reserve.destroy', $reserve) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button
                                class="w-[200px] inline-flex items-center justify-center py-2 px-3 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                <span>Delete</span>
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
