<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Http\RequestInterface;
use CodeIgniter\Http\ResponseInterface;
use Config\Services;


class Throttle implements FilterInterface{

	public function before(RequestInterface $request){
		$throttler = Services::throttler();

		if($throttler->check($request->getIPAddress(),20, MINUTE) === false){
			return Services::response()->setStatusCode(429);
		}
	}

	public function after(RequestInterface $request, ResponseInterface $response){

	}
}