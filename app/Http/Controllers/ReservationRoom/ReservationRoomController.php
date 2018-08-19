<?php

namespace App\Http\Controllers\ReservationRoom;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ReservationRoom;
use Illuminate\Http\Request;

class ReservationRoomController extends Controller
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
            $reservationroom = ReservationRoom::where('reservation_id', 'LIKE', "%$keyword%")
                ->orWhere('room_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $reservationroom = ReservationRoom::latest()->paginate($perPage);
        }

        return view('reservation-room.index', compact('reservationroom'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('reservation-room.create');
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
			'reservation_id' => 'required',
			'room_id' => 'required'
		]);
        $requestData = $request->all();
        
        ReservationRoom::create($requestData);

        return redirect('reservation-room')->with('flash_message', 'ReservationRoom added!');
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
        $reservationroom = ReservationRoom::findOrFail($id);

        return view('reservation-room.show', compact('reservationroom'));
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
        $reservationroom = ReservationRoom::findOrFail($id);

        return view('reservation-room.edit', compact('reservationroom'));
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
			'reservation_id' => 'required',
			'room_id' => 'required'
		]);
        $requestData = $request->all();
        
        $reservationroom = ReservationRoom::findOrFail($id);
        $reservationroom->update($requestData);

        return redirect('reservation-room')->with('flash_message', 'ReservationRoom updated!');
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
        ReservationRoom::destroy($id);

        return redirect('reservation-room')->with('flash_message', 'ReservationRoom deleted!');
    }
}
