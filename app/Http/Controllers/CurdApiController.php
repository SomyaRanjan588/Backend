<?php

namespace App\Http\Controllers;

use App\Models\UserDetails;
use Illuminate\Http\Request;
use Validator;

class CurdApiController extends Controller
{
    /**
     * Getapi
     */
    public function showData()
    {

        $posts = UserDetails::all();
        return $posts;
    }
    /**
     * POST api
     */
    public function saveData(Request $request)
    {

        $validate = Validator::make($request->all(), [
            "title" => "required",
            "desc" => "required",
            "image" => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            "postid" =>"required",

        ]);
        if ($validate->fails()) {

            return response()->json([
                'validation_errors' =>
                $validate->errors(), 422]);
        } else {

            $image = $request->image->store('images', 'public');
            $post = UserDetails::create([
                "title" => $request->title,
                "description" => $request->desc,
                "image" => $image,
                "postid" =>$request->postid,

            ]);
            return "data added successfully";

        }

    }
    public function editData($id)
    {
        $product = UserDetails::find($id);
        if ($product) {
            return response()->json([
                'product' => $product,
                'status' => 200,
            ]);
        } else {
            return "product not found";
        }
    }
    /**
     * PUT api
     */
    public function getUpdate(Request $request, $id)
    {

        $validate = Validator::make($request->all(), [
            "title" => "required",
            "desc" => "required",
            "image" => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048",

        ]);
        if ($validate->fails()) {

            return response()->json([
                'validation_errors' =>
                $validate->errors(), 422]);
        } else {
            $image = $request->image->store('images', 'public');

            $post = UserDetails::where('id', $id)->update([
                "title" => $request->title,
                "description" => $request->desc,
                "image" => $image,

            ]);

            if ($post) {
                return "data updated successfully";
            } else {
                return "data not added successfully";
            }

        }

    }
    /**
     * DELETE api
     */
    public function getDelete($id)
    {
        $post = UserDetails::destroy($id);
        if ($post) {

            return "Data deleted sucessfully";
        } else {
            return "Sorry ! data can not be deleted";
        }
    }
    public function eachData($id)
    {
        $post = UserDetails::where('id', $id)->get();
        if ($post) {
            return $post;
        } else {
            return "unable to show the data";
        }
    }
}
