<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use App\Models\Station;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use PhpParser\Node\Stmt\Catch_;

class ReserveController extends Controller
{
    /**
     * Show home page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!empty(Cache::get('request'))) {
            Cache::delete('request');
        }
        return view('reserv');
    }

    /**
     * Show times for reserve
     * 
     * @return \Illuminate\Http\Response
     */

    public function setTime()
    {
        $request = Cache::get('request');
        $price = Reserve::SERVICE_PRICE[$request['service']];
        $stations = Station::all();
        $container = Reserve::getAllStationFreeTime($stations, $request);
        $time = (new Reserve())->table($container, Reserve::SERVICE_TIME[$request['service']]);
        $time = (new Reserve())->uniqeTime($time);
        if ($request['type-time'] === 'soon') {
            $time = array_slice($time, 0, 2);
        }
        return view('time', compact('time', 'request', 'price'));
    }

    /**
     * show form for see factor 
     * 
     * @return \Illuminate\Http\Response
     */

    public function trackCode()
    {
        return view('FactorForm');
    }


    /**
     * check track code for show factor
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function trackCodeCheck(Request $request)
    {
        $reserve = Reserve::where([
            ['phone', $request->phone],
            ['track_code', $request->order_track],
        ])->first();
        if ($reserve->toArray()) {
            return redirect()->route('reserve.show', $reserve);
        }
    }


    /**
     * save data in Cache
     * 
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */

    public function firstStore(Request $request)
    {
        Cache::put('request', $request->all());
        return redirect()->route('reserve.setTime');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $first = Cache::get('request');
        Cache::delete('request');
        $second = collect(['open_time', 'exit_time', 'station_id'])
        ->combine(explode('-', $request->toArray()['time']))->merge($first)->toArray();
        $second['price'] = Reserve::SERVICE_PRICE[$first['service']];
        $second['track_code'] = uniqid();
        $reserve = Reserve::create($second);
        return view('trackCode', compact('reserve'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function show(Reserve $reserve)
    {
        $reserve->CheckTimeForChenge();
        return view('show', compact('reserve'));
    }

    /**
     * Show the form for editing the Name.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserve  $reserve
     */

    public function updateName(Request $request, Reserve $reserve)
    {
        $reserve->update(['name' => $request->name]);
        return redirect()->route('reserve.show', $reserve);
    }


    /**
     * Show the form for editing 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserve  $reserve
     */

    public function firstEdit(Request $request, Reserve $reserve)
    {
        session(['request' => $request->all()]);
        return redirect()->route('reserve.editTime', $reserve);
    }


    public function editTime(Reserve $reserve)
    {
        // dd($reserve);
        $request = session('request');
        $price = Reserve::SERVICE_PRICE[$request['service']];
        $stations = Station::all();
        $container = Reserve::getAllStationFreeTime($stations, $request);
        $time = (new Reserve())->table($container, Reserve::SERVICE_TIME[$request['service']]);
        $time = (new Reserve())->uniqeTime($time);
        if ($request['type-time'] === 'soon') {
            $time = array_slice($time, 0, 2);
        }
        return view('editTime', compact('time', 'request', 'price', 'reserve'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserve $reserve)
    {
        return view('edit', compact('reserve'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserve $reserve)
    {
        $first = session('request');
        session()->forget('request');
        $second = collect(['open_time', 'exit_time', 'station_id'])
        ->combine(explode('-', $request->toArray()['time']))->merge($first)->toArray();
        $second['price'] = Reserve::SERVICE_PRICE[$first['service']];
        $reserve->update($second);
        return redirect()->route('reserve.show', $reserve);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserve $reserve)
    {
        $reserve->delete();
        return redirect()->route('reserve.index');
    }
}
