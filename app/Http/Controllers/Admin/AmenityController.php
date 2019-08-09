<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Amenity;
use Illuminate\Http\Request;
use Imgur;

class AmenityController extends Controller
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
            $amenities = Amenity::latest()->paginate($perPage);
        } else {
            $amenities = Amenity::latest()->paginate($perPage);
        }

        return view('admin/amenities.amenities.index', compact('amenities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin/amenities.amenities.create');
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
            'image' => 'required|image',
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required'
        ]);

        $requestData = $request->all();
        $image = Imgur::upload($request->file('image'));
        $requestData['image'] = $image->link();

        Amenity::create($requestData);

        return redirect('admin/amenities')->with('flash_message', 'Amenity added!');
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
        $amenity = Amenity::findOrFail($id);

        return view('admin/amenities.amenities.show', compact('amenity'));
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
        $amenity = Amenity::findOrFail($id);

        return view('admin/amenities.amenities.edit', compact('amenity'));
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
            'image' => 'required|image',
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required'
        ]);

        $requestData = $request->all();

        $amenity = Amenity::findOrFail($id);

        $image = Imgur::upload($request->file('image'));
        $requestData['image'] = $image->link();
        $amenity->update($requestData);

        return redirect('admin/amenities')->with('flash_message', 'Amenity updated!');
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
        Amenity::destroy($id);

        return redirect('admin/amenities')->with('flash_message', 'Amenity deleted!');
    }
}
