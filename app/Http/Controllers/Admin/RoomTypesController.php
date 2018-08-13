<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\RoomType;
use Illuminate\Http\Request;

class RoomTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $roomtypes = RoomType::where('number', 'LIKE', "%$keyword%")
                ->orWhere('room_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $roomtypes = RoomType::latest()->paginate($perPage);
        }

        return view('admin/room_types.room-types.index', compact('roomtypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin/room_types.room-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'number' => 'required',
			'room_id' => 'required'
		]);
        $requestData = $request->all();
        
        RoomType::create($requestData);

        return redirect('admin/room-types')->with('flash_message', 'RoomType added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $roomtype = RoomType::findOrFail($id);

        return view('admin/room_types.room-types.show', compact('roomtype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $roomtype = RoomType::findOrFail($id);

        return view('admin/room_types.room-types.edit', compact('roomtype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'number' => 'required',
			'room_id' => 'required'
		]);
        $requestData = $request->all();
        
        $roomtype = RoomType::findOrFail($id);
        $roomtype->update($requestData);

        return redirect('admin/room-types')->with('flash_message', 'RoomType updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        RoomType::destroy($id);

        return redirect('admin/room-types')->with('flash_message', 'RoomType deleted!');
    }
}
