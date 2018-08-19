<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Reservation;
use Illuminate\Http\Request;

class ReservationsController extends Controller
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
            $reservations = Reservation::where('start_date', 'LIKE', "%$keyword%")
                ->orWhere('end_date', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('deposit_slip', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $reservations = Reservation::latest()->paginate($perPage);
        }

        return view('admin/reservations.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin/reservations.reservations.create');
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
			'start_date' => 'required',
			'end_date' => 'required',
			'status' => 'required',
			'user_id' => 'required'
		]);
        $requestData = $request->all();
        
        Reservation::create($requestData);

        return redirect('admin/reservations')->with('flash_message', 'reservation added!');
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
        $reservation = Reservation::findOrFail($id);

        return view('admin/reservations.reservations.show', compact('reservation'));
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
        $reservation = Reservation::findOrFail($id);

        return view('admin/reservations.reservations.edit', compact('reservation'));
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
			'start_date' => 'required',
			'end_date' => 'required',
			'status' => 'required',
			'user_id' => 'required'
		]);
        $requestData = $request->all();
        
        $reservation = Reservation::findOrFail($id);
        $reservation->update($requestData);

        return redirect('admin/reservations')->with('flash_message', 'reservation updated!');
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
        Reservation::destroy($id);

        return redirect('admin/reservations')->with('flash_message', 'reservation deleted!');
    }
}
