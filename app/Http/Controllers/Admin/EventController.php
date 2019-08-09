<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Imgur;
use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
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
            $events = Event::latest()->paginate($perPage);
        } else {
            $events = Event::latest()->paginate($perPage);
        }

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.events.create');
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
        $request->validate([
            'image_url' => 'required|image',
            'event_name' => 'required',
            'description' => 'required'
        ]);

        $requestData = $request->all();

        $image = Imgur::upload($request->file('image_url'));
        $requestData['image_url'] = $image->link();

        Event::create($requestData);

        return redirect('admin/events')->with('flash_message', 'Event added!');
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
        $event = Event::findOrFail($id);

        return view('admin.events.show', compact('event'));
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
        $event = Event::findOrFail($id);

        return view('admin.events.edit', compact('event'));
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
        $request->validate([
            'image_url' => 'sometimes|image',
            'event_name' => 'required',
            'description' => 'required'
        ]);

        $requestData = $request->all();

        $image = Imgur::upload($request->file('image_url'));
        $requestData['image_url'] = $image->link();

        $event = Event::findOrFail($id);
        $event->update($requestData);



        return redirect('admin/events')->with('flash_message', 'Event updated!');
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
        Event::destroy($id);

        return redirect('admin/events')->with('flash_message', 'Event deleted!');
    }
}
