<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Streaming;

class StreamingController extends Controller
{
	private $streaming;

	public function __construct(Streaming $streaming)
	{
		$this->streaming = $streaming;
	}

    public function index()
    {
    	return [
    		'message' => 'Fetched',
    		'data' => $this->streaming->newQuery()->orderBy('id','desc')->first()
    	];
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'url' => 'required',
    		'active_date_time' => 'required'
    	]);

    	$data = $request->all();
    	$data['user_id'] = $request->user()->id;
    	$streaming = $this->streaming->create($data);

    	return [
    		'message' => 'Created',
    		'data' => $streaming
    	];
    }

    public function update(Request $request, $id)
    {
    	$request->validate([
    		'url' => 'required',
    		'active_date_time' => 'required'
    	]);

    	$data = $request->all();
    	$streaming = $this->streaming->find($id);
    	$streaming->fill($data);
    	$streaming->save();

    	return [
    		'message' => 'Updated',
    		'data' => $streaming
    	];
    }

    public function destroy($id)
    {
    	$this->streaming->destroy($id);

    	return [
    		'message' => 'Deleted',
    	];
    }
}
