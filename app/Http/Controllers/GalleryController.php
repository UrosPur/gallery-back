<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Gallery;
use App\User;
use App\Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Gallery::with('images')->with('user')->get();
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Image
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
            'name' => 'required|string|min:2',
            'description' => 'string|max:1000',
        ]);


        $images = $request['inputs'];

//        foreach ($images as $image) {
//            $request->validate([
//                'image_url' => 'string|required'
//            ]);
//        }

        $gallery = new Gallery();
        $gallery->name = $request['name'];
        $gallery->description = $request['description'];
        $gallery->user_id = (int)$request['USERID'];
        $gallery->save();

        foreach ($images as $image) {
            $img = new Image();
            $img->url = $image['one'];
            $img->gallery_id = $gallery->id;
            $img->save();
            $result[] = $img;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Gallery::where('id', $id)->with('images', 'user')->first();
    }

    public function singleUserGalleries($id)
    {

        $user = User::find($id);

        $user = auth()->user();

        return Gallery::where('user_id', $id)->with('images', 'user')->get();
    }

    public function singleAuthorGalleries($id)
    {


        return Gallery::where('user_id', $id)->with('images', 'user')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd(200);
    }

    public function delete($id)
    {
//        return response()->json(compact('You do not have permissions todelete this gallery'));
//
//        if($request['USERID']){
//
//        $gallery = Gallery::find($request['id']);
//        $gallery->delete();
//        return response()->json(compact('deleted'));
//
//        }

        $gallery = Gallery::find($id);
        $gallery->delete();

        return new JsonResponse(true);



    }
}
