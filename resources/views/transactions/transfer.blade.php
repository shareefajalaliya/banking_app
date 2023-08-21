@extends('layouts.app',['title' => 'Transfer'])
@section('content')
<div class="row">
	@include('layouts.flash')
	<!-- Basic -->
	<div class="col-md-2"></div>
	<div class="col-md-8">
		
		<div class="card mb-4">
			<h5 class="card-header">Transfer</h5>
			<!-- Account -->
			<form id="formAccountSettings" method="POST" action="{{route('transfer.amount')}}" autocomplete="off" enctype="multipart/form-data" >
				@csrf
				
				<hr class="my-0" />
				<div class="card-body">

					<div class="row">
						<div class="mb-3 col-md-12">
							<label for="name" class="form-label">Email</label>
							<input class="form-control" type="email" id="email" name="email" placeholder="Enter email" />
							@if ($errors->has('email'))
							<span class="invalid-feedback" role="alert" style="display: block;">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
							@endif
						</div>
						
						
					</div>

					<div class="row">
						<div class="mb-3 col-md-12">
							<label for="name" class="form-label">Amount</label>
							<input class="form-control" type="text" id="amount" name="amount" placeholder="Enter amount to withdraw" />
							@if ($errors->has('amount'))
							<span class="invalid-feedback" role="alert" style="display: block;">
								<strong>{{ $errors->first('amount') }}</strong>
							</span>
							@endif
						</div>
						
						
					</div>
					<div class="row">
						<div class="mb-3 col-md-12 form-password-toggle">
							<label for="name" class="form-label">Security Pin</label>
							<div class="input-group input-group-merge">
								<input class="form-control" type="password" id="security_pin" name="security_pin" placeholder="Enter security pin" />
								<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
								@if ($errors->has('security_pin'))
								<span class="invalid-feedback" role="alert" style="display: block;">
									<strong>{{ $errors->first('security_pin') }}</strong>
								</span>
								@endif
							</div>
						</div>
						
						
					</div>

					<div class="mt-2">
						<button type="submit" class="btn btn-primary me-2">Transfer</button>
						<button type="reset" class="btn btn-outline-secondary">Cancel</button>
					</div>
				</div>
			</form>
			<!-- /Account -->
		</div>
	</div>
	<div class="col-md-2"></div>
</div>
@endsection