<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Http\RequestInterface;
use CodeIgniter\Http\ResponseInterface;
use Config\Services;


class LoginFilter implements FilterInterface{

	public function before(RequestInterface $request){
		if(!session()->has('logged_in')){
			return redirect()->to(base_url('login'));
		}
	}

	public function after(RequestInterface $request, ResponseInterface $response){

	}
}