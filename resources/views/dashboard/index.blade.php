@extends('layouts.app',['title'=>'Dashboard'])
@section('content')
<div class="row">
	@include('layouts.flash')
	@if(auth()->user()->role == 1)
	@if(!$user->security_pin)
	<div class="alert alert-danger" role="alert">Please create your security pin  
		<a href="{{route('security_pin.reset')}}">
			Click Here
		</a>
	</div>

	@endif
	@endif
	<div class="col-lg-8 mb-4 order-0">
		<div class="card">
			<div class="d-flex align-items-end row">
				
				<div class="card-body">
					<h5 class="card-title text-primary">Welcome {{$user->name}}</h5>
					<p class="mb-4">
						<div class="row">
							<div class="col-4">
								Email ID 
							</div>
							<div class="col-4">
								:
							</div>
							<div class="col-4">
								{{$user->email}}
							</div>
						</div>
						@if(auth()->user()->role == 1)
						<hr>
						<div class="row">
							<div class="col-4">
								Account Number 
							</div>
							<div class="col-4">
								:
							</div>
							<div class="col-4">
								{{$user->account_number}}
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-4">
								Pancard Number 
							</div>
							<div class="col-4">
								:
							</div>
							<div class="col-4">
								{{$user->pancard_number}}
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-4">
								Aadhar Number 
							</div>
							<div class="col-4">
								:
							</div>
							<div class="col-4">
								{{$user->aadhar_number}}
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-4">
								Address 
							</div>
							<div class="col-4">
								:
							</div>
							<div class="col-4">
								{{$user->address}}
							</div>
						</div>

						@endif
					</p>
					<?php
					if(auth()->user()->role == 1){
						$id = encrypt($user->user_id);
					}else{
						$id = encrypt(auth()->user()->id);
					} 
					?>

					<a href="{{route('profile.edit',$id)}}" class="btn btn-sm btn-outline-primary">Edit Profile</a>
				</div>
				
				
			</div>
		</div>
	</div>
	@if(auth()->user()->role == 1)
	<div class="col-lg-4 col-md-4 order-1">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-12 mb-12">
				<div class="card">
					<div class="card-body">
						
						<span class="fw-semibold d-block mb-1">Balance</span>
						<h3 class="card-title mb-2">${{$user->balance}}</h3>
						
					</div>
				</div>
			</div>
			
		</div>
	</div>
	@endif
	@if(auth()->user()->role == 0)
	<div class="col-lg-4 col-md-4 order-1">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-12 mb-12">
				<div class="card">
					<div class="card-body">
						
						<span class="fw-semibold d-block mb-1">Users</span>
						<h3 class="card-title mb-2">{{$total_users}}</h3>
						
					</div>
				</div>
			</div>
			
		</div>
	</div>
	@endif
</div>



@endsection


