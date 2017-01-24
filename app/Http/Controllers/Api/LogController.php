<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    public $fields	= [];

	public function write(Request $request)
	{
		foreach ($this->fields as $field) {
		}
	}
}
