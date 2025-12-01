<aside id="layout-menu" class="layout-menu menu-vertical menu" data-bg-class="bg-menu-theme">
	<div class="app-brand demo">
		<a href="{{ url('dashboard') }}" class="app-brand-link">
		<span class="app-brand-logo demo">
			<span class="text-primary">
			  <img src="{{ $logo }}" alt="{{$project_name}}" width="80">
			{{-- <svg
				width="25"
				viewBox="0 0 25 42"
				version="1.1"
				xmlns="http://www.w3.org/2000/svg"
				xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				<path
					d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
					id="path-1"></path>
				<path
					d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
					id="path-3"></path>
				<path
					d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
					id="path-4"></path>
				<path
					d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
					id="path-5"></path>
				</defs>
				<g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
				<g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
					<g id="Icon" transform="translate(27.000000, 15.000000)">
					<g id="Mask" transform="translate(0.000000, 8.000000)">
						<mask id="mask-2" fill="white">
						<use xlink:href="#path-1"></use>
						</mask>
						<use fill="currentColor" xlink:href="#path-1"></use>
						<g id="Path-3" mask="url(#mask-2)">
						<use fill="currentColor" xlink:href="#path-3"></use>
						<use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
						</g>
						<g id="Path-4" mask="url(#mask-2)">
						<use fill="currentColor" xlink:href="#path-4"></use>
						<use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
						</g>
					</g>
					<g
						id="Triangle"
						transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
						<use fill="currentColor" xlink:href="#path-5"></use>
						<use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
					</g>
					</g>
				</g>
				</g>
			</svg> --}}
			</span>
		</span>
		<span class="app-brand-text demo menu-text fw-bold ms-2">{{$project_name}}</span>
		</a>

		{{-- <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
		<i class="icon-base bx bx-chevron-left"></i>
		</a> --}}
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">
			<li class="menu-header small">
				<span class="menu-header-text">
					@lang('admin.include.dashboard')
				</span>
			</li>
			<li class="menu-item {{ Route::is('admin.home') ? 'active' : '' }}" >
				<a href="{{ route('admin.home') }}" class="menu-link">
					<span class="s-icon"><i class="ti-anchor"></i></span>
					<span class="s-text">@lang('admin.include.dashboard')</span>
				</a>
			</li>

			<li class="menu-header small">
				<span class="menu-header-text">
					Earnings
				</span>
			</li>
			<li class="menu-item {{ Route::is('admin.earnings') ? 'active' : '' }}" >
				<a href="{{ route('admin.earnings') }}" class="menu-link">
					<span class="s-icon"><i class="ti-anchor"></i></span>
					<span class="s-text">List Earnings</span>
				</a>
			</li>

			<li class="menu-header small">
				<span class="menu-header-text">
					Wallets
				</span>
			</li>

			<li class="menu-item {{ Route::is('admin.wallets*') || Route::is('admin.deposit.history*') || Route::is('admin.wallet*') ? 'active open' : '' }}" >
				<a href="#" class="menu-link menu-toggle">
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Wallets</span>
				</a>
				<ul class="menu-sub">
					<li class="menu-item {{ Route::is('admin.deposit.history*') ? 'active' : '' }}" >
						<a href="{{ route('admin.deposit.history', 'investor') }}" class="menu-link">
							<span class="s-icon"><i class="ti-anchor"></i></span>
							<span class="s-text">User Deposit History</span>
						</a>
					</li>
					<li class="menu-item {{ Route::is('admin.wallets*') ? 'active' : '' }}" >
						<a href="{{ route('admin.wallets', 'investor') }}" class="menu-link">
							<span class="s-icon"><i class="ti-anchor"></i></span>
							<span class="s-text">User Wallet</span>
						</a>
					</li>
					<li class="menu-item {{ Request::is('admin/wallet/'.(Setting::get('admin_address_matic') ? Setting::get('admin_address_matic') : '0xA58bc3f7A0fc7Fab85b96D')) ? 'active' : '' }}" >
						<a href="{{ url('/admin/wallet', [Setting::get('admin_address_matic') ? Setting::get('admin_address_matic') : '0xA58bc3f7A0fc7Fab85b96D', 'COIN', 'MATIC']) }}" class="menu-link">
							<span class="s-icon"><i class="ti-anchor"></i></span>
							<span class="s-text">Admin Wallet</span>
						</a>
					</li>
				</ul>
			</li>

			<li class="menu-header small">
				<span class="menu-header-text">
					@lang('admin.include.users')
				</span>
			</li>
			<li class="menu-item {{ Request::is('admin/users/all') ? 'active' : '' }}" >
				<a href="{{ url('/admin/users','all') }}" class="menu-link">
					<span class="s-icon"><i class="ti-anchor"></i></span>
					<span class="s-text">@lang('admin.include.list_users')</span>
				</a>

			</li>

			<li class="menu-header small">
				<span class="menu-header-text">
					Database Management
				</span>
			</li>
			<li class="menu-item {{ Route::is('admin.database.import.form') ? 'active' : '' }}" >
				<a href="{{ route('admin.database.import.form') }}" class="menu-link">
					<span class="s-icon"><i class="ti-anchor"></i></span>
					<span class="s-text">Database Management</span>
				</a>

			</li>

			<li class="menu-header small">
				<span class="menu-header-text">
					Page Visibility
				</span>
			</li>
			<li class="menu-item {{ Route::is('admin.page-visibility*') ? 'active' : '' }}" >
				<a href="{{ route('admin.page-visibility.index') }}" class="menu-link">
					<span class="s-icon"><i class="ti-anchor"></i></span>
					<span class="s-text">Page Visibility</span>
				</a>

			</li>


			<li class="menu-header small">
				<span class="menu-header-text">
					Liquid Tokenization
				</span>
			</li>


			{{-- <li class="menu-item {{ Route::is('admin.usertoken*') ? 'active' : '' }}" >
				<a href="{{ route('admin.usertoken.index') }}" class="menu-link">
					<span class="s-icon"><i class="ti-anchor"></i></span>
					<span class="s-text">User Token</span>
				</a>
			</li>
			<li class="menu-item {{ Route::is('admin.usertoken.transaction') ? 'active' : '' }}" >
				<a href="{{ route('admin.usertoken.transaction') }}" class="menu-link">
					<span class="s-icon"><i class="ti-anchor"></i></span>
					<span class="s-text">Token Transaction</span>
				</a>
			</li> --}}

			<li class="menu-item {{ Route::is('admin.requestedtoken*') ? 'active open' : '' }}" >
				<a href="#" class="menu-link menu-toggle">
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Requested Token</span>
				</a>
				<ul class="menu-sub">
					<li class="menu-item {{ Request::is('admin/requestedtoken') && request('type') == 1 ? 'active' : '' }}" >
						<a href="{{ route('admin.requestedtoken', ['type' => 1]) }}" class="menu-link">
							Property
						</a>
					</li>
					<li class="menu-item {{ Request::is('admin/requestedtoken') && request('type') == 2 ? 'active' : '' }}" >
						<a href="{{ route('admin.requestedtoken', ['type' => 2]) }}" class="menu-link">
							Asset
						</a>
					</li>
					<li class="menu-item {{ Request::is('admin/requestedtoken') && request('type') == 3 ? 'active' : '' }}" >
						<a href="{{ route('admin.requestedtoken', ['type' => 3]) }}" class="menu-link">
							Utility
						</a>
					</li>
				</ul>
			</li>

			<li class="menu-item {{ Route::is('admin.assetfund*') ? 'active open' : '' }}" >
				<a href="#" class="menu-link menu-toggle">
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Deployed Assets</span>
				</a>
				<ul class="menu-sub">
					<li class="menu-item {{ Route::is('admin.assetfund*') && request('type') == 1 ? 'active' : '' }}" >
						<a href="{{ route('admin.assetfund', ['type' => 1]) }}" class="menu-link">
							Property
						</a>
					</li>
					<li class="menu-item {{ Route::is('admin.assetfund*') && request('type') == 2 ? 'active' : '' }}" >
						<a href="{{ route('admin.assetfund', ['type' => 2]) }}" class="menu-link">
							Asset
						</a>
					</li>
					<li class="menu-item {{ Route::is('admin.assetfund*') && request('type') == 3 ? 'active' : '' }}" >
						<a href="{{ route('admin.assetfund', ['type' => 3]) }}" class="menu-link">
							Utility
						</a>
					</li>
				</ul>
			</li>

			<li class="menu-header small">
				<span class="menu-header-text">
					Property
				</span>
			</li>

			<li class="menu-item {{ Route::is('admin.property.showasset') ? 'active open' : '' }}" >
				<a href="#" class="menu-link menu-toggle">
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Property</span>
				</a>
				<ul class="menu-sub">
					<li class="menu-item {{ Route::is('admin.property.showasset') ? 'active' : '' }}" >
						<a href="{{ route('admin.property.showasset') }}" class="menu-link">
							Asset Type
						</a>
					</li>
				</ul>
			</li>

			<li class="menu-header small">
				<span class="menu-header-text">
					@lang('admin.include.kyc_doc')
				</span>
			</li>

			<li class="menu-item {{ Route::is('admin.document.index') || Route::is('admin.document.create') ? 'active open' : '' }}" >
				<a href="#" class="menu-link menu-toggle">
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Kyc @lang('admin.include.doc')</span>
				</a>
				<ul class="menu-sub">
					<li class="menu-item {{ Route::is('admin.document.index') ? 'active' : '' }}" >
						<a href="{{ route('admin.document.index') }}" class="menu-link">
							@lang('admin.include.list_doc')
						</a>
					</li>
					<li class="menu-item {{ Route::is('admin.document.create') ? 'active' : '' }}" >
						<a href="{{ route('admin.document.create') }}" class="menu-link">
							@lang('admin.include.add_doc')
						</a>
					</li>
				</ul>
			</li>

			<li class="menu-header small">
				<span class="menu-header-text">
					@lang('admin.include.cms')
				</span>
			</li>

			<li class="menu-item {{ Route::is('admin.support') || Route::is('admin.privacy') || Route::is('admin.terms') ? 'active open' : '' }}" >
				<a href="#" class="menu-link menu-toggle">
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">@lang('admin.include.cms')</span>
				</a>
				<ul class="menu-sub">
					<li class="menu-item {{ Route::is('admin.support') ? 'active' : '' }}" >
						<a href="{{ route('admin.support') }}" class="menu-link">
							<span class="s-icon"></span> About Us
						</a>


					</li>
					<li class="menu-item {{ Route::is('admin.privacy') ? 'active' : '' }}" >
						<a href="{{ route('admin.privacy') }}" class="menu-link">
							<span class="s-icon"></span>
							<span class="s-text">@lang('admin.include.privacy_policy')</span>
						</a>
					</li>
					<li class="menu-item {{ Route::is('admin.terms') ? 'active' : '' }}" >
						<a href="{{ route('admin.terms') }}" class="menu-link">
							<span class="s-icon"></span>
							<span class="s-text">@lang('admin.include.terms')</span>
						</a>
					</li>

				</ul>

			</li>


			<li class="menu-header small">
				<span class="menu-header-text">
					Nodes
				</span>
			</li>
			<li class="menu-item {{ Route::is('admin.node.details') ? 'active' : '' }}" >
				<a href="{{ route('admin.node.details') }}" class="menu-link">
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">List Node</span>
				</a>
			</li>



			<li class="menu-header small">
				<span class="menu-header-text">
					@lang('admin.include.acc')
				</span>
			</li>
			<li class="menu-item {{ Route::is('admin.password') ? 'active' : '' }}" >
				<a href="{{ route('admin.password') }}" class="menu-link">
					<span class="s-icon"><i class="ti-exchange-vertical"></i></span>
					<span class="s-text">@lang('user.profiles.change_password')</span>
				</a>
			</li>

			<li class="menu-item">
				<a href="{{ route('adminlogout') }}" onclick="event.preventDefault();
				document.getElementById('logout-form').submit();" class="menu-link">
				<span class="s-icon"><i class="ti-power-off"></i></span>@lang('user.profiles.logout')
				</a>

				<form id="logout-form" action="{{ route('adminlogout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
			</li>
	</ul>
</aside>
