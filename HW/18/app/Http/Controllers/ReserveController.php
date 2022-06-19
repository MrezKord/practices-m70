<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveRequest;
use App\Models\Reserve;
use App\Models\Service;
use App\Models\Station;
use App\Models\User;
use App\Rules\TrackCodeForEachUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use PhpParser\Node\Stmt\Catch_;

class ReserveController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show home page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', Auth::id())->first();
        $admin = User::isAdmin();
        return view('Home', compact('user', 'admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        session()->forget('request');
        return view('reserv', compact('services'));
    }

    /**
     * Show times for reserve
     * 
     * @return \Illuminate\Http\Response
     */

    public function setTime()
    {
        $request = session('request');
        $price = Service::price($request['service']);
        $stations = Station::all();
        $container = Reserve::getAllStationFreeTime($stations, $request);
        $time = (new Reserve())->table($container, Service::time($request['service']));
        $time = (new Reserve())->uniqeTime($time);
        if ($request['type-time'] === 'soon') {
            $time = array_slice($time, 0, 2);
        }
        return view('time', compact('time', 'request', 'price'));
    }


    /**
     * save data in Cache
     * 
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */

    public function firstStore(ReserveRequest $request)
    {
        session(['request' => $request->all()]);
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
        $request->validate([
            'time' => 'required'
        ]);
        $first = session('request');
        $second = collect(['open_time', 'exit_time', 'station_id'])
            ->combine(explode('-', $request->toArray()['time']))->merge($first)->toArray();
        $second['price'] = Service::price($first['service']);
        $second['track_code'] = uniqid();
        $second['user_id'] = Auth::id();
        $reserve = Reserve::create($second);
        session()->forget('request');
        return redirect()->route('reserve.showResultRequest', $reserve);
    }

    public function showResultRequest(Reserve $reserve)
    {
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

    public function updateName(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $user->update(['name' => $request->name]);
        return redirect()->route('reserve.index');
    }


    /**
     * Show the form for editing 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserve  $reserve
     */

    public function firstEdit(ReserveRequest $request, Reserve $reserve)
    {
        session(['request' => $request->all()]);
        return redirect()->route('reserve.editTime', $reserve);
    }



    public function editTime(Reserve $reserve)
    {
        $request = session('request');
        $price = Service::price($request['service']);
        $stations = Station::all();
        $container = Reserve::getAllStationFreeTime($stations, $request);
        $time = (new Reserve())->table($container, Service::time($request['service']));
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
        session()->forget('request');
        $services = Service::all();
        return view('edit', compact('reserve', 'services'));
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
        $request->validate([
            'time' => 'required'
        ]);

        $first = session('request');
        $second = collect(['open_time', 'exit_time', 'station_id'])
            ->combine(explode('-', $request->toArray()['time']))->merge($first)->toArray();
        $second['price'] = Service::price($first['service']);
        $reserve->update($second);
        session()->forget('request');
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
