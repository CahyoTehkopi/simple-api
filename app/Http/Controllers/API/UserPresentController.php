<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Present;

class UserPresentController extends Controller
{
	private $present;

	public function __construct(Present $present)
	{
		$this->present = $present;
	}

	public function index()
	{
		return [
			'message' => 'Fetched',
			'data' => $this->present->with(['users'])->paginate(10),
		];
	}

    public function store(Request $request, $code)
    {
    	if (empty($code)) {
    		return ['message' => 'Error empty code'];
    	}

    	$present = $this->present->where('qr_code', $code)->first();
    	$present->users()->sync([$request->user()->id]);

    	return [
    		'message' => 'User has been presence',
    	];
    }
}
