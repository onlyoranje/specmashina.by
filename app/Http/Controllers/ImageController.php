<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class ImageController extends Controller
{
    public function index()
    {
        return view('image');
    }
    public function store(Request $request)
    {
        if($request->hasFile('profile_image')) {
            //get filename with extension
            $filenamewithextension = $request->file('profile_image')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //small thumbnail name
            $smallthumbnail = $filename.'_small_'.time().'.'.$extension;

            //medium thumbnail name
            $mediumthumbnail = $filename.'_medium_'.time().'.'.$extension;

            //large thumbnail name
            $largethumbnail = $filename.'_large_'.time().'.'.$extension;

            //Upload File
            $request->file('profile_image')->storeAs('public/profile_images', $filenametostore);
            $request->file('profile_image')->storeAs('public/profile_images/thumbnail', $smallthumbnail);
            $request->file('profile_image')->storeAs('public/profile_images/thumbnail', $mediumthumbnail);
            $request->file('profile_image')->storeAs('public/profile_images/thumbnail', $largethumbnail);

            //create small thumbnail
            $smallthumbnailpath = public_path('storage/profile_images/thumbnail/'.$smallthumbnail);
            $this->createThumbnail($smallthumbnailpath, 150, 93);

            //create medium thumbnail
            $mediumthumbnailpath = public_path('storage/profile_images/thumbnail/'.$mediumthumbnail);
            $this->createThumbnail($mediumthumbnailpath, 300, 185);

            //create large thumbnail
            $largethumbnailpath = public_path('storage/profile_images/thumbnail/'.$largethumbnail);
            $this->createThumbnail($largethumbnailpath, 550, 340);

            return redirect('image')->with('success', "Image uploaded successfully.");
        }
    }
}

