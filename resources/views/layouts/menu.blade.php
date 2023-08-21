<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="index.html" class="app-brand-link">

			<span class="app-brand-text demo menu-text fw-bolder ms-2">ABC Bank</span>
		</a>

		<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">
		<!-- Dashboard -->
		<li class="menu-item active">
			<a href="{{route('dashboard')}}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div data-i18n="Analytics">Dashboard</div>
			</a>
		</li>
		@if(auth()->user()->role == 1)
		<!-- Layouts -->
		<li class="menu-item">
			<a href="{{route('deposit')}}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-import"></i>
				<div data-i18n="Layouts">Deposit</div>
			</a>

			
		</li>

		<li class="menu-item">
			<a href="{{route('withdraw')}}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-export"></i>
				<div data-i18n="Layouts">Withdraw</div>
			</a>

			
		</li>

		<li class="menu-item">
			<a href="{{route('transfer')}}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-transfer-alt"></i>
				<div data-i18n="Layouts">Transfer</div>
			</a>

			
		</li>
		<li class="menu-item">
			<a href="{{route('security_pin.reset')}}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-import"></i>
				<div data-i18n="Layouts">Reset Securitypin</div>
			</a>

			
		</li>
		@endif
		@if(auth()->user()->role == 0)
		<li class="menu-item">
			<a href="{{route('users')}}" class="menu-link">
				<i class="menu-icon tf-icons bx bxs-user"></i>
				<div data-i18n="Layouts">Users</div>
			</a>

			
		</li>
		@endif
		<li class="menu-item">
			<a href="{{route('statements')}}" class="menu-link">
				<i class="menu-icon tf-icons bx bxs-report"></i>
				<div data-i18n="Layouts">Statement</div>
			</a>

			
		</li>

		
	</ul>
</aside>