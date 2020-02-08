<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Car;
use Alert;
use DB;
class CarsController extends Controller
{
    //
	
	public function getCar () {
		$currAction = DB::select("select * from cars where action like 'queue' LIMIT 5");
		$countQueue = DB::select("select * from cars where action like 'queue'");
		
		$count = count($countQueue);
		
		return view('home',compact('currAction','count'));
	}
	
	public function getDetails() {
		$compAction = DB::select("select * from cars where action like 'complete'");
		$unAction = DB::select("select * from cars where action like 'queue'");
		$countBlue = DB::select("select * from cars where action like 'complete' and targetcolor like 'blue'");
		$countRed = DB::select("select * from cars where action like 'complete' and targetcolor like 'red'");
		$countGreen = DB::select("select * from cars where action like 'complete' and targetcolor like 'green'");
		
		$totalPainted = count($compAction);
		$totalBlue = count($countBlue);
		$totalRed = count($countRed);
		$totalGreen = count($countGreen);
		
		
		return view('paintjob',compact('compAction','unAction','totalPainted','totalBlue','totalGreen','totalRed'));
	}
	
	public function addCar (request $request) {
		
		DB::table('cars')->insert([
			'platenumber' =>strtoupper($request->plateno),
			'currentcolor' => $request->currcolor,
			'targetcolor' => $request->tarcolor,
			'action' => 'queue'
		]); 

		$currAction = DB::select("select * from cars where action like 'queue' LIMIT 5");
		$queueAction = DB::select("select * from cars where action like 'queue'");
		
		$count = count($queueAction);
		
		$carDetails = array('data1'=>$currAction,
							'data2'=>$count);
		
		echo json_encode($carDetails);
		
	}
	
	public function updateCar (request $request) {
		DB::table('cars')->where('id',$request->upaction)->update([
			'action' => "complete"
		]);
		
		$currAction = DB::select("select * from cars where action like 'queue' LIMIT 5");
		
		$queueAction = DB::select("select * from cars where action like 'queue'");
		
		$count = count($queueAction);
		
		$carDetails = array('data1'=>$currAction,
							'data2'=>$count);
		
		echo json_encode($carDetails);
	}
	
}
