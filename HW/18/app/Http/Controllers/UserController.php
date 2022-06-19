<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('admin', 0)->paginate(4);
        return view('usersShow', compact('users'));
    }


    public function showReserves()
    {
        $reserves = Reserve::all();
        $services = Service::all();
        $week = Reserve::oneWeek();

        return view('reservesShow', compact('reserves', 'services', 'week'));
    }


    public function handelServiceTypeReserve(Request $request)
    {
        if ($request->service == 'all') {
            return response()->json([
                Reserve::all()
                ->map(fn ($val) => $val = [
                    'username' => $val->user->name,
                    'date' => $val->date_for_admin,
                    'service' => $val->service,
                    'price' => $val->price
                ])
                ->toArray()
            ]);
        }

        return response()->json([
            Reserve::where($request->name, $request->service)
                ->get()
                ->map(fn ($val) => $val = [
                    'username' => $val->user->name,
                    'date' => $val->date_for_admin,
                    'service' => $val->service,
                    'price' => $val->price
                ])
                ->toArray()
        ]);
    }


    public function Services()
    {
        $services = Service::all();
        return view('Services', compact('services'));
    }

    public function storeService(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required|unique:services|min:3|max:20',
            'price' => 'required|numeric|min:20|max:150',
            'time' => 'required|numeric|min:10|max:120'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->errors()
            ]);
        }

        Service::create($request->all());
        return response()->json([
            'error' => '',
            'success' => 'Service added successfully'
        ]);
    }


    public function updateService(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required|min:3|max:20|unique:services,name,'.$request->service_id,
            'price' => 'required|numeric|min:20|max:150',
            'time' => 'required|numeric|min:10|max:120'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->errors()
            ]);
        }

        Service::find($request->service_id)->update($request->all());
        return response()->json([
            'error' => '',
            'success' => 'Service added successfully'
        ]);
        
    }

    public function deleteService(Request $request)
    {
        // return $service->name;
        Service::find($request->service_id)->delete();
        return response()->json([
            'error' => '',
            'success' => 'Service deleted successfully'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('userShow', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
