<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Present;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;

class PresentController extends Controller
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
    		$this->present->paginate(10),
    	];
    }

    public function show($code)
    {
        $presence = $this->present->where('qr_code', $code)->first();

        if ($presence) {
            $qr = new BaconQrCodeGenerator;
            $url = route('user-presence.store', $presence->qr_code);
            return $qr->size(500)->generate($url);
        }
    	return [
    		'message' => 'Failed',
    		'data' => 'Code not found'
    	];
    }

    public function store(Request $request)
    {
        $request->validate([
    		'qr_code' => 'required',
    	]);

    	$data['qr_code'] = $request->qr_code;
    	$data['user_id'] = $request->user()->id;

    	$present = $this->present->create($data);

    	return [
    		'message' => 'Created',
    		'data' => $present
    	];
    }

    public function update(Request $request, $id)
    {
    	$request->validate([
    		'qr_code' => 'required',
    	]);

    	$data['qr_code'] = $request->qr_code;

    	$present = $this->present->find($id);
    	$present->fill($data);
    	$present->save();

    	return [
    		'message' => 'Updated',
    		'data' => $present
    	];
    }

    public function destroy($id)
    {
    	$this->present->destroy($id);

    	return [
    		'message' => 'Deleted',
    	];
    }
}
