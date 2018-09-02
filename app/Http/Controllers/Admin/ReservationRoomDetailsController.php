<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ReservationRoomDetail;
use Illuminate\Http\Request;

class ReservationRoomDetailsController extends Controller
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
            $reservationroomdetails = ReservationRoomDetail::where('reservation_id', 'LIKE', "%$keyword%")
                ->orWhere('room_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $reservationroomdetails = ReservationRoomDetail::latest()->paginate($perPage);
        }

        return view('admin.reservation-room-details.index', compact('reservationroomdetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.reservation-room-details.create');
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
        
        ReservationRoomDetail::create($requestData);

        return redirect('admin/reservation-room-details')->with('flash_message', 'ReservationRoomDetail added!');
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
        $reservationroomdetail = ReservationRoomDetail::findOrFail($id);

        return view('admin.reservation-room-details.show', compact('reservationroomdetail'));
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
        $reservationroomdetail = ReservationRoomDetail::findOrFail($id);

        return view('admin.reservation-room-details.edit', compact('reservationroomdetail'));
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
        
        $reservationroomdetail = ReservationRoomDetail::findOrFail($id);
        $reservationroomdetail->update($requestData);

        return redirect('admin/reservation-room-details')->with('flash_message', 'ReservationRoomDetail updated!');
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
        ReservationRoomDetail::destroy($id);

        return redirect('admin/reservation-room-details')->with('flash_message', 'ReservationRoomDetail deleted!');
    }
}
