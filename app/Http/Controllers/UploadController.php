<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Storage;
use Response;

class UploadController extends Controller
{
    public function usersDisplayImage(Request $request) 
    {
    	try {
    		if ($request->hasFile('file')) {
    			$user = Auth::guard('web')->user();
    			$filename = "u" . $user->id . \Carbon\Carbon::now()->timestamp . "." . $request->file('file')->getClientOriginalExtension();
    			
    			if (Storage::disk('display_image')->put($filename, \File::get($request->file('file')))) {
    				$user->display_image = $filename;
    				$user->save();

    				return Response::json(['message' => 'upload success',  'filename' => $filename], 200, array(), JSON_PRETTY_PRINT);
    			} else {
    				return Response::json(['message' => 'upload error', 'errors' => $e->getMessage()], 202, array(), JSON_PRETTY_PRINT);
    			}
    		}
    	} catch (\Exception $e) {
    		return Response::json(['message' => 'upload error', 'errors' => "something went wrong"], 202, array(), JSON_PRETTY_PRINT);	
    	}
    }
}
