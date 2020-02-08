@extends('layouts.app')


<div id="queuediv" style="margin:100px">
	<div><span><b>Paint Job in Progress</b><span></div>
	<div class="aParent" style="width:1200px">
		<div style="width:60%">
			<table class="ptable" style="width:70%">
				<tr>
					<th>Plate No.</th>
					<th>Current Color </th>
					<th>Target Color</th>
					<th>Action</th>
				</tr>
					
				@foreach ($compAction as $item)
				<tr>
					<td>{{$item->platenumber}}</td>
					<td>{{$item->currentcolor}}</td>
					<td>{{$item->targetcolor}}</td>
					<td>Mark as Completed</td>
				</tr>
				@endforeach
					
			</table>
			
			<br><br>
			
			<div style="width:100%">
				<div style="width:100%"><b>Paint Job in Queue</b></div>
				<div style="width:100%">
					<table class="ptable"  width="50%">
						<tr>
							<th>Plate No.</th>
							<th>Current Color </th>
							<th>Target Color</th>
						</tr>
						
						@foreach ($unAction as $item)
							<tr>
								<td>{{$item->platenumber}}</td>
								<td>{{$item->currentcolor}}</td>
								<td>{{$item->targetcolor}}</td>
							</tr>
						@endforeach		
					</table>
				</div>
			</div>
		</div>
		<div>
			<div style="background-color:red;color:white;width:100%">Shop Performance :</div>
			
			<table style="width:100%;background-color:#eaeae1">
				<tr>
					<td>Total Cars Painted</td>
					<td><b>{{$totalPainted}}</b></td>
				</tr>
				<tr>
					<td>Breakdown : </td>
				</tr>
				<tr>
					<td>Blue :</td>
					<td><b>{{$totalBlue}}</b></td>
				</tr>
				<tr>
					<td>Red:</td>
					<td><b>{{$totalRed}}</b></td>
				</tr>
				<tr>
					<td>Green :</td>
					<td><b>{{$totalGreen}}</b></td>
				</tr>
				</table>
		</div>
	</div>
	
</div>


