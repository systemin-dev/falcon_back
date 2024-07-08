<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
	<!--begin::Menu wrapper-->
	<div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
		<!--begin::Menu-->
		<div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
				<!--begin:Menu link-->
				<a href="{{route('index')}}" class="menu-link">
					<span class="menu-title">Tableau de bord</span>
					<span class="menu-arrow d-lg-none"></span></a>
				<!--end:Menu link-->
				<!--begin:Menu sub-->

			</div>
			<!--end:Menu item-->

		</div>
		<!--end::Menu-->
	</div>
	<!--end::Menu wrapper-->
	<!--begin::Navbar-->
	<div class="app-navbar flex-shrink-0">
		<!--begin::Theme mode-->
		<div class="app-navbar-item ms-1 ms-lg-3">
			<!--begin::Menu toggle-->
			<a href="#" class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
				<i class="ki-duotone ki-night-day theme-light-show fs-1">
					<span class="path1"></span>
					<span class="path2"></span>
					<span class="path3"></span>
					<span class="path4"></span>
					<span class="path5"></span>
					<span class="path6"></span>
					<span class="path7"></span>
					<span class="path8"></span>
					<span class="path9"></span>
					<span class="path10"></span>
				</i>
				<i class="ki-duotone ki-moon theme-dark-show fs-1">
					<span class="path1"></span>
					<span class="path2"></span>
				</i>
			</a>
			<!--begin::Menu toggle-->
			<!--begin::Menu-->
			<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
				<!--begin::Menu item-->
				<div class="menu-item px-3 my-0">
					<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
						<span class="menu-icon" data-kt-element="icon">
							<i class="ki-duotone ki-night-day fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
								<span class="path4"></span>
								<span class="path5"></span>
								<span class="path6"></span>
								<span class="path7"></span>
								<span class="path8"></span>
								<span class="path9"></span>
								<span class="path10"></span>
							</i>
						</span>
						<span class="menu-title">Light</span>
					</a>
				</div>
				<!--end::Menu item-->
				<!--begin::Menu item-->
				<div class="menu-item px-3 my-0">
					<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
						<span class="menu-icon" data-kt-element="icon">
							<i class="ki-duotone ki-moon fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</span>
						<span class="menu-title">Dark</span>
					</a>
				</div>
				<!--end::Menu item-->
				<!--begin::Menu item-->
				<div class="menu-item px-3 my-0">
					<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
						<span class="menu-icon" data-kt-element="icon">
							<i class="ki-duotone ki-screen fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
								<span class="path4"></span>
							</i>
						</span>
						<span class="menu-title">System</span>
					</a>
				</div>
				<!--end::Menu item-->
			</div>
			<!--end::Menu-->
		</div>
		<!--end::Theme mode-->
		<!--begin::User menu-->
		<div class="app-navbar-item ms-2 ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
			<!--begin::Menu wrapper-->
			<div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
				<img src="{{ isset(Auth::user()->avatar) ? asset('storage/' . Auth::user()->avatar) : asset('/assets/media/svg/files/blank-image.svg') }}" alt="user" />
			</div>
			<!--begin::User account menu-->
			<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
				<!--begin::Menu item-->
				<div class="menu-item px-3">
					<div class="menu-content d-flex align-items-center px-3">
						<!--begin::Avatar-->
						<div class="symbol symbol-50px me-5">
							<img alt="Logo" src="{{ isset(Auth::user()->avatar) ? asset('storage/' . Auth::user()->avatar) : asset('/assets/media/svg/files/blank-image.svg') }}" />

						</div>
						<!--end::Avatar-->
						<!--begin::Username-->
						<div class="d-flex flex-column">
							<div class="fw-bold d-flex align-items-center fs-5">{{ Auth::user()->name }}
								<span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">{{ Auth::user()->role->name }}</span>
							</div>
							<a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
						</div>
						<!--end::Username-->
					</div>
				</div>
				<!--end::Menu item-->
				<!--begin::Menu separator-->
				<div class="separator my-2"></div>
				<!--end::Menu separator-->
				<!--begin::Menu item-->
				<div class="menu-item px-5">
					<a href="{{ route('profile.edit') }}" class="menu-link px-5">Mon profil</a>
				</div>

				<!--end::Menu item-->


				<div class="separator my-2"></div>
				<!--end::Menu item-->
				<!--begin::Menu item-->
				<div class="menu-item px-5">
					<form method="POST" action="{{ route('logout') }}" style="display: inline;">
						@csrf
						<button type="submit" class="menu-link px-5" style="background: none; border: none; color: inherit; cursor: pointer;">
							Déconnexion
						</button>
					</form>
				</div>

				<!--end::Menu item-->
			</div>
			<!--end::User account menu-->
			<!--end::Menu wrapper-->
		</div>
	</div>
	<!--end::Navbar-->
</div>