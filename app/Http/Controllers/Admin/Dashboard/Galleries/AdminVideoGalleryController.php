<?php

namespace App\Http\Controllers\Admin\Dashboard\Galleries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;


class AdminVideoGalleryController extends Controller
{

    public function index()
    {
        return view("admin.dashboard.galleries.video-gallery.index", [
            "videos"=>Video::orderBy("id", "desc")->paginate(10)
        ]);
    }


    public function create()
    {
        return view("admin.dashboard.galleries.video-gallery.create");
    }


    public function store(Request $request)
    {
        $videoFormData=$request->validate([
            "video_id"=>["required"],
            "owner"=>["required"],
            "caption"=>["required"]
         ]);
        Video::create($videoFormData);

        return to_route("admin.video-gallery.index")->with("success", "Video is created successfully");
    }



    public function edit(Video $video)
    {
        return view("admin.dashboard.galleries.video-gallery.edit", [
            "video"=>$video,
            "page"=>request('page'),
        ]);
    }


    public function update(Request $request, Video $video)
    {
        $videoFormData=$request->validate([
            "video_id"=>["required"],
            "owner"=>["required"],
            "caption"=>["required"]
         ]);

        $video->update($videoFormData);

        return to_route("admin.video-gallery.index", "page=".request("page"))->with("success", "Video is updated successfully");
    }


    public function destroy(Video $video)
    {
        $video->delete();
        return to_route("admin.video-gallery.index", "page=".request("page"))->with("success", "Video is deleted successfully");
    }
}
