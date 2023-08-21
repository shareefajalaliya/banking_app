@extends('layouts.app',['title' => 'Reset Security Pin'])
@section('content')
<div class="row">
	@include('layouts.flash')
	<!-- Basic -->
	<div class="col-md-2"></div>
	<div class="col-md-8">
		
		<div class="card mb-4">
			<h5 class="card-header">Reset Security Pin</h5>
			<!-- Account -->
			<form id="formAccountSettings" method="POST" action="{{route('securitypin.update')}}" autocomplete="off" enctype="multipart/form-data" >
				@csrf
				
				<hr class="my-0" />
				<div class="card-body">

					
					<div class="row">
						<div class="mb-3 col-md-12 form-password-toggle">
							<label for="name" class="form-label">Security Pin</label>
							<div class="input-group input-group-merge">
								<input class="form-control" type="password" id="security_pin" name="security_pin" placeholder="Enter Security pin" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
								<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
								@if ($errors->has('security_pin'))
								<span class="invalid-feedback" role="alert" style="display: block;">
									<strong>{{ $errors->first('security_pin') }}</strong>
								</span>
								@endif
							</div>
						</div>
						
						
					</div>
					<div class="row">
						<div class="mb-3 col-md-12 form-password-toggle">
							<label for="name" class="form-label">Confirm Security Pin</label>
							<div class="input-group input-group-merge">
								<input class="form-control" type="password" id="confirm_security_pin" name="confirm_security_pin" placeholder="Enter Security pin" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
								<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
								@if ($errors->has('confirm_security_pin'))
								<span class="invalid-feedback" role="alert" style="display: block;">
									<strong>{{ $errors->first('confirm_security_pin') }}</strong>
								</span>
								@endif
							</div>
						</div>
						
						
					</div>

					<div class="mt-2">
						<button type="submit" class="btn btn-primary me-2">Reset</button>
						
					</div>
				</div>
			</form>
			<!-- /Account -->
		</div>
	</div>
	<div class="col-md-2"></div>
</div>
@endsection