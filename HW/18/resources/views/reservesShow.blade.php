@extends('layouts.layout')

@section('main')
    <div
        class="opacity-90 overflow-auto mx-auto mt-[5vh] pb-4 mb-10 p-4 w-[900px] bg-white rounded-lg border shadow-lg shadow-zinc-900/70 sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between items-center mb-4">
            <h5 class="px-3 text-xl font-bold leading-none text-gray-900 dark:text-white">Reserved List</h5>
            <div class="flex gap-4">
                <div class="flex justify-center">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="mb-3 w-[200px]">
                        <select onchange="reserveChenge(this)" name="service" id="service"
                            class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            aria-label="Default select example">
                            <option selected disabled value="">Services</option>
                            <option value="all">All</option>
                            @foreach ($services as $item)
                                <option value="{{ $item->name }}">{{ $item->label_service }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="mb-3 w-[200px]">
                        <select onchange="reserveChenge(this)" name="day" id="day"
                            class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            aria-label="Default select example">
                            <option selected disabled value="">Date</option>
                            <option value="all">All</option>
                            @foreach ($week as $key => $item)
                                <option value="{{ $item }}">{{ $key . ' ' . $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="flow-root h-[500px]">
            <ul id="filtering">
                @foreach ($reserves as $item)
                    <li class="p-3 rounded-md sm:py-4 hover:shadow-lg hover:shadow-zinc-900/70 hover:bg-gray-100">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    {{ $item->user->name }}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
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
            </ul>
            <ul role="list px-3">
                <li class="p-3 sm:py-4 border-t border-gray-200">
                    <div class="flex items-center space-x-4">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                Number of reservations:
                            </p>
                        </div>
                        <div id="count"
                            class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                            {{ $reserves->count() }}
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <script>
        function reserveChenge(e) {
            let _token = $("input[name=_token]").val();
            $.ajax({
                url: "/user/handelServiceTypeReserve",
                type: "POST",
                data: {
                    service: $(e).val(),
                    _token: _token,
                    name: e.name
                },
                success: function(response) {
                    let result = '';
                    for (iterator of response[0]) {
                        result +=
                            '<li class="p-3 rounded-md sm:py-4 hover:shadow-lg hover:shadow-zinc-900/70 hover:bg-gray-100">' +
                            '<div class="flex items-center space-x-4">' +
                            '<div class="flex-1 min-w-0">' +
                            '<p class="text-sm font-medium text-gray-900 truncate dark:text-white">' +
                            iterator.username +
                            '</p>' +
                            '<p class="text-sm text-gray-500 truncate dark:text-gray-400">' +
                            iterator.service +
                            '</p>' +
                            '<p class="text-sm text-gray-500 truncate dark:text-gray-400">' +
                            iterator.date +
                            '</p>' +
                            '</div>' +
                            '<div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">' +
                            '$' + iterator.price +
                            '</div>' +
                            '</div>' +
                            '</li>';
                    }
                    $('#filtering').html(result);
                    $('#count').html(response[0].length);
                    if (e.name === 'service') {
                        $('#day').val('');
                    } else if (e.name === 'day') {
                        $('#service').val('');
                    }
                }
            });
        }
    </script>
@endsection
