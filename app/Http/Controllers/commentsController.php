<?php

namespace App\Http\Controllers;

use App\Models\commentsModel;
use Illuminate\Http\Request;
use Validator;

class commentsController extends Controller
{
    public function saveComment(Request $request)
    {

        $validate = Validator::make($request->all(), [
            "comment" => "required",
        ]);
        if ($validate->fails()) {

            return response()->json([
                'validation_errors' =>
                $validate->errors(), 422]);
        } else {
            $post = commentsModel::create([

                "comment" => $request->comment,

            ]);
            if ($post) {
                return "Comment added successfully";
           } else {
               return "unable to insert the data";
           }
           

        }

    }
    public function showComment()
    {
        $post = commentsModel::get();
        if ($post) {
             return $post;
        } else {
            return "unable to show the data";
        }
    }
}
