<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function update(Request $request)
    {
    	$request->validate([
    		'name' => 'required',
    		'username' => 'required',
    		'email' => 'required',
    		'phone' => 'required',
    	]);

    	$data = $request->all();

    	if ($request->has('password')) {
    		$data['password'] = bcrypt($request->password);
    	}

    	$updated = $request->user()->update($data);

    	if ($updated) {
    		return [
    			'message' => 'Updated',
                'data' => $request->user(),
    		];
    	}

    	return [
    		'message' => 'User update failed'
    	];
    }
}
