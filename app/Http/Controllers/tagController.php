<?php

namespace App\Http\Controllers;

use App\Models\tagModel;
use Illuminate\Http\Request;

class tagController extends Controller
{
    public function saveTag(Request $request)
    {
        $post = tagModel::create([

            "fashion" => $request->fashion,
            "technology" => $request->technology,
            "personal_blog" => $request->personal_blog,
            "innovation_idea" => $request->innovation_idea,

        ]);
        if($post){
            return $post;
        }
    }
}
