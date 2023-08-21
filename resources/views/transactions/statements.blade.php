@extends('layouts.app',['title'=>'Statements'])
@section('content')
<div class="row">
	@if(auth()->user()->role == 1)
	<!-- Basic -->
	<div class="col-md-12">
		
		<div class="card mb-4">
			<h5 class="card-header">Statements</h5>
			<!-- Account -->
			<form id="formAccountSettings">
				@csrf
				
				<hr class="my-0" />
				<div class="card-body">

					<div class="row">
						
						<div class="mb-3 col-md-6">
							<label for="name" class="form-label">Start Date</label>
							<input class="form-control" type="date" id="start_date" name="start_date" placeholder= "date('Y-m-d')" />
							
						</div>
						
						

						<div class="mb-3 col-md-6">
							<label for="name" class="form-label">End Date</label>
							<input class="form-control" type="date" id="end_date" name="end_date" placeholder="date('Y-m-d')" />
							
						</div>
						
						
					</div>

					<div class="mt-2">
						<button class="btn btn-primary me-2">Filter</button>
					</div>
				</div>
			</form>
			<!-- /Account -->
		</div>
	</div>

	@endif

	<!-- Basic Bootstrap Table -->
	<div class="card">
		<h5 class="card-header">Statements</h5>
		<div class="table-responsive text-nowrap">
			<table class="table">
				<thead>
					<tr>
						<th>Date Time</th>
						<th>Amount</th>
						<th>Type</th>
						<th>Details</th>
						<th>Balance</th>
					</tr>
				</thead>
				<tbody class="table-border-bottom-0">
					@foreach($statements as $details)
					<tr>
						<td><?php echo date('Y-m-d H:i a',strtotime($details->transaction_date)); ?></td>
						<td>{{$details->amount}}</td>
						<td>{{$details->type}}</td>
						<td>{{$details->details}}</td>
						<td>{{$details->balance}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection