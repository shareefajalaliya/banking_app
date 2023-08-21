@extends('layouts.app',['title' => 'Users'])
@section('content')
<div class="card">
	<h5 class="card-header">Users</h5>
	<div class="table-responsive text-nowrap">
		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Account Number</th>
					<th>Pancard Number</th>
					<th>Aadhar Number</th>
				</tr>
			</thead>
			<tbody class="table-border-bottom-0">
				@foreach($users as $user)
				<tr>
					<td>{{$user->name}}</td>
					<td>{{$user->email}}</td>
					<td>{{$user->account_number}}</td>
					<td>{{$user->pancard_number}}</td>
					<td>{{$user->aadhar_number}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection