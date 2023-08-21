@extends('layouts.app',['title' => 'Edit Profile'])
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Edit Profile</span> </h4>
@include('layouts.flash')
<div class="row">
	<!-- Basic -->
	<div class="col-md-12">
		@if(auth()->user()->role == 1)
		<div class="card mb-4">
			<h5 class="card-header">Profile Details</h5>
			<!-- Account -->
			<form id="formAccountSettings" method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data" >
				@csrf
				<input type="hidden" name="user_id" value="{{$user->id}}">
				<div class="card-body">
					<div class="d-flex align-items-start align-items-sm-center gap-4">
						@if($user->photo)
						<img src="{{asset('uploads')}}/image/{{$user->photo}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
						@else
						<img src="{{asset('assets')}}/admin/assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
						@endif
						<div class="button-wrapper">
							<label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
								<span class="d-none d-sm-block">Upload new photo</span>
								<i class="bx bx-upload d-block d-sm-none"></i>
								<input
								type="file"
								id="upload"
								class="account-file-input"
								name="image"
								hidden
								/>
							</label>
							<button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
								<i class="bx bx-reset d-block d-sm-none"></i>
								<span class="d-none d-sm-block">Reset</span>
							</button>

							<p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
						</div>
					</div>
				</div>
				<hr class="my-0" />
				<div class="card-body">

					<div class="row">
						<div class="mb-3 col-md-6">
							<label for="name" class="form-label">Name</label>
							<input class="form-control" type="text" id="name" name="name" value="{{$user->name}}" autofocus />
						</div>
						
						<div class="mb-3 col-md-6">
							<label for="email" class="form-label">E-mail</label>
							<input class="form-control" type="email" id="email" name="email" value="{{$user->email}}" />
							@if ($errors->has('email'))
							<span class="invalid-feedback" role="alert" style="display: block;">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
							@endif
						</div>
						<div class="mb-3 col-md-6">
							<label for="organization" class="form-label">Phone Number</label>
							<input class="form-control" type="text" id="phone_number" name="phone_number" value="{{$user->phone_number}}"  />
						</div>
						<div class="mb-3 col-md-6">
							<label class="form-label" for="phoneNumber">Pancard Number</label>
							<div class="input-group input-group-merge">
								<input class="form-control" type="text" id="pancard_number" name="pancard_number" value="{{$user->pancard_number}}"/>
							</div>
						</div>
						<div class="mb-3 col-md-6">
							<label for="address" class="form-label">Address</label>
							<input type="text" class="form-control" id="address" name="address" value="{{$user->address}}"/>
						</div>
						<div class="mb-3 col-md-6">
							<label for="state" class="form-label">Aadhar Number</label>
							<input class="form-control" type="text" id="aadhar_number" name="aadhar_number" value="{{$user->aadhar_number}}"/>
						</div>
						<div class="mb-3 col-md-6">
							<label for="zipCode" class="form-label">Gender</label>
							<br>
							<div class="form-check form-check-inline mt-3">
								<input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" <?php if($user->gender == 'male'){ echo "checked"; } ?> />
								<label class="form-check-label" for="inlineRadio1">Male</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female" <?php if($user->gender == 'female'){ echo "checked"; } ?> />
								<label class="form-check-label" for="inlineRadio2">Female</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="others" <?php if($user->gender == 'others'){ echo "checked"; } ?> />
								<label class="form-check-label" for="inlineRadio3">Others</label>
							</div>
						</div>
						<div class="mb-3 col-md-6">
							<label class="form-label" for="country">Date of Birth</label>
							<input class="form-control" type="date" name="dob" value="{{$user->dob}}" id="html5-date-input" />
						</div>
						
					</div>
					<div class="mt-2">
						<button type="submit" class="btn btn-primary me-2">Save changes</button>
						<button type="reset" class="btn btn-outline-secondary">Cancel</button>
					</div>
				</div>
			</form>
			<!-- /Account -->
		</div>
		@endif
		@if(auth()->user()->role == 0)
		<div class="card mb-4">
			<h5 class="card-header">Update Password</h5>
			<div class="card-body demo-vertical-spacing demo-only-element">
				<form id="formAccountSettings" method="POST" action="{{route('profile.updateadmin')}}" enctype="multipart/form-data" >
					@csrf

					<input type="hidden" name="id" value="{{auth()->user()->id}}">
					<div class="row">
						<div class="mb-3 col-md-6">
							<label for="name" class="form-label">Name</label>
							<input class="form-control" type="text" id="name" name="name" value="{{auth()->user()->name}}" autofocus />
						</div>
						<div class="mb-3 col-md-6">
							<label for="email" class="form-label">E-mail</label>
							<input class="form-control" type="email" id="email" name="email" value="{{auth()->user()->email}}" />
							@if ($errors->has('email'))
							<span class="invalid-feedback" role="alert" style="display: block;">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
							@endif
						</div>
						<div class="mt-2">
							<button type="submit" class="btn btn-primary me-2">Save changes</button>
							<button type="reset" class="btn btn-outline-secondary">Cancel</button>

						</div>
					</div>
				</form>


			</div>
		</div>
		@endif
		<div class="card">
			<h5 class="card-header">Update Password</h5>
			<div class="card-body demo-vertical-spacing demo-only-element">
				<form id="formAccountSettings" method="POST" action="{{route('profile.updatepassword')}}" enctype="multipart/form-data" >
					@csrf

					<input type="hidden" name="id" value="{{auth()->user()->id}}">
					<div class="form-password-toggle">
						<label class="form-label" for="basic-default-password12">Password</label>
						<div class="input-group">
							<input type="password" class="form-control" name="password" id="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password2" />
							@if ($errors->has('password'))
							<span class="invalid-feedback" role="alert" style="display: block;">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="form-password-toggle">
						<label class="form-label" for="basic-default-password12">Confirm Password</label>
						<div class="input-group">
							<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password2" />
							@if ($errors->has('confirm_password'))
							<span class="invalid-feedback" role="alert" style="display: block;">
								<strong>{{ $errors->first('confirm_password') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="mt-2">
						<button type="submit" class="btn btn-primary me-2">Submit</button>

					</div>
				</form>


			</div>
		</div>
	</div>

</div>
@endsection