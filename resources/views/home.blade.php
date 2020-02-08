@extends('layouts.app')

@section('content')
			<div class="header" >
				<h2>JUAN'S AUTO PAINT</h2>
			</div>
			<div class="option">
				<table style="width:25%">
					<tr>
						<td><a href="#">New Paint Jobs</a></td>
						<td><a href="{{url('paintjobs')}}">Paint Jobs</a></td>
					</tr>
				</table>
			</div>
			<br>
            <div class="content">
                <div class="title"><b>New Paint Job</b></div>
            </div>
			<div class="carpaint">
				<table width="100%">
					<tr>
						<td class="defaultimg">
							<img src="images/default.png">
						</td>
						<td>
							<img src="images/arrow.png">
						</td>
						<td class="targetcolor">
							<img src="images/default.png">
						</td>
					</tr>
				</table>
			</div>
			<br><br>
			<div class="aParent" style="width:100%">
				<div class="caropt" style="width:35%;margin-left:50px;">
					<span><b>Car Details</b></span>
					<br>
					<form id="cardetails" autocomplete="off">
					
						<table style="text-align:left">
							<tr>
								<td>
									<span>Plate No. </span>
								</td>
								<td>
									<input type="text" width="100px" class="plateno" name="plateno"  style="text-transform:uppercase" required>
								</td>
							</tr>
							<tr>
							
								<td> Current Color </td>
								<td> 
									<select id="currcolor" name="currcolor" required>
										<option disabled selected value> -- select an option -- </option>
										<option value="red">Red</option>
										<option value="green">Green</option>
										<option value="blue">Blue</option>
									</select>
								</td>
							</tr>
							<tr>
								<td> Target Color </td>
								<td> 
									<select id="tarcolor" name="tarcolor" required>
										<option disabled selected value> -- select an option -- </option>
										<option value="red">Red</option>
										<option value="green">Green</option>
										<option value="blue">Blue</option>
									</select>
								</td>
							</tr>
							
						</table>
						<div>
							<input type="submit" value="ADD JOB" class="subbtn"/></td>
							{{ csrf_field() }}
						</div>
					</form>
				</div>

				<div>
					<div id="countjob"><b>Queue Jobs : {{$count}}</b></div>
					<br>
					<table id="currtable" class="ptable" style="width:110%">
						<thead style="text-align:left">
						<tr>
							<th> Plate Number </th>
							<th> Current Color </th>
							<th> Target Color </th>
							<th> Status </th>
							<th> Action </th>
						</tr>
						</thead>
						@foreach ($currAction as $details)
					
						<tr>
							<td>
								{{$details->platenumber}}
							</td>
							<td>
								{{$details->currentcolor}}
							</td>
							<td>
								{{$details->targetcolor}}
							</td>
							<td>
								{{$details->action}}
							</td>
							<td>
								<input type="button" value="Complete" class="compbtn" data-href="{{$details->id}}">
							</td>
						</tr>
						
						@endforeach
					
					</table>
					<div style="width:100%" >
						<form action="{{url('paintjobs')}}">
							<input type="submit" value="SUBMIT" class="subbtn" style="width:110%"/>
						</form>
					</div>
				</div>
			</div>
			<br><br><br>

@endsection