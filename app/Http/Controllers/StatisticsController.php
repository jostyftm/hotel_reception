<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Reservation;

class StatisticsController extends Controller
{
	public function index()
	{
    	return View('statistics.index');
	}

}
