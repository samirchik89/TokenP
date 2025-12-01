<div class="site-sidebar">
	<div class="custom-scroll custom-scroll-light">
		<ul class="sidebar-menu">
			<li class="menu-title">@lang('admin.include.dashboard')</li>
			<li>
				<a href="{{ route('admin.home') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-anchor"></i></span>
					<span class="s-text">@lang('admin.include.dashboard')</span>
				</a>
			</li>

			<li class="menu-title">Earnings</li>
			<li>
				<a href="{{ route('admin.earnings') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-anchor"></i></span>
					<span class="s-text">List Earnings</span>
				</a>
			</li>

			<li class="menu-title">Wallets</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Wallets</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.deposit.history', 'investor') }}">User Deposit History</a></li>
					<li><a href="{{ route('admin.wallets', 'investor') }}">User Wallet</a></li>
					<li><a href="{{ url('/admin/wallet', [Setting::get('admin_address_matic') ? Setting::get('admin_address_matic') : '0xA58bc3f7A0fc7Fab85b8fdA78BD7AF119070B96D', 'COIN', 'MATIC']) }}">Admin Wallet</a></li>
				</ul>
			</li>

			<li class="menu-title">@lang('admin.include.users')</li>
			<li>
				<a href="{{ url('/admin/users','all') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-anchor"></i></span>
					<span class="s-text">@lang('admin.include.list_users')</span>
				</a>

				<!-- <form action="{{ url('/admin/2fa/urlform') }}" method="POST">
					<input type="hidden" name="route_url" value="/admin/user/index" />
					<button type="submit">@lang('admin.include.list_users')</button>
				</form> -->
			</li>

			<li class="menu-title">Database Management</li>
			<li>
				<a href="{{ route('admin.database.import.form') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-anchor"></i></span>
					<span class="s-text">Database Management</span>
				</a>

			</li>

			<li class="menu-title">Page Visibility</li>
			<li>
				<a href="{{ route('admin.page-visibility.index') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-anchor"></i></span>
					<span class="s-text">Page Visibility</span>
				</a>

			</li>


			<li class="menu-title">Liquid Tokenization</li>
			{{--<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Token Type</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.token.index') }}">List Tokens</a></li>
					<!-- <li><a href="{{ route('admin.token.create') }}">Add New Token</a></li> -->
				</ul>
			</li>--}}

			{{-- <li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Liquid Tokenization</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.tokenizerindex') }}">List of Tokens</a></li>
				</ul>

			</li> --}}

			<li class="with-sub">
				{{-- <a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">User Token</span>
				</a> --}}
				<ul>
					<li><a href="{{ route('admin.usertoken.index') }}">User Token</a></li>
					<li><a href="{{ route('admin.usertoken.transaction') }}">Token Transaction</a></li>
					{{-- <li><a href="{{ route('admin.dividend') }}">Dividend</a></li> --}}
				</ul>
			</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Requested Token</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.requestedtoken', ['type' => 1]) }}">Property</a></li>
					<li><a href="{{ route('admin.requestedtoken', ['type' => 2]) }}">Asset</a></li>
					<li><a href="{{ route('admin.requestedtoken', ['type' => 3]) }}">Utility</a></li>
				</ul>


			</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Deployed Assets</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.assetfund', ['type' => 1]) }}">Property </a></li>
					<li><a href="{{ route('admin.assetfund', ['type' => 2]) }}">Asset </a></li>
					<li><a href="{{ route('admin.assetfund', ['type' => 3]) }}">Utility </a></li>
					</ul>


			</li>

			<li class="menu-title">Property</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Property</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.property.showasset') }}">Asset Type</a></li>
				</ul>
			</li>

			{{-- <li class="menu-title">@lang('admin.include.coins')</li>
			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">@lang('admin.include.coins')</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.coin.index') }}">@lang('admin.include.list_coins')</a></li>
					<li><a href="{{ route('admin.coin.create') }}">@lang('admin.include.add_coin')</a></li>
				</ul>
			</li>

			<li class="menu-title">@lang('admin.include.prospectus_doc')</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">@lang('admin.include.doc')</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.prospectusdocument.index') }}">@lang('admin.include.list_doc')</a></li>
					<li><a href="{{ route('admin.prospectusdocument.create') }}">@lang('admin.include.add_doc')</a></li>
				</ul>
			</li> --}}

			<li class="menu-title">@lang('admin.include.kyc_doc')</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Kyc @lang('admin.include.doc')</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.document.index') }}">@lang('admin.include.list_doc')</a></li>
					<li><a href="{{ route('admin.document.create') }}">@lang('admin.include.add_doc')</a></li>
				</ul>
			</li>

			{{-- <li class="menu-title">Stripe Details</li>

<li class="with-sub">
	<a href="#" class="waves-effect  waves-light">
		<span class="s-caret"><i class="fa fa-angle-down"></i></span>
		<span class="s-icon"><i class="ti-view-grid"></i></span>
		<span class="s-text">Stripe</span>
	</a>
	<ul>
		<li><a href="{{ route('admin.user.stripe-history') }}">History</a></li>
	</ul>
</li> --}}

			{{-- <li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text"> Corp - @lang('admin.include.doc')</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.corpdocument.index') }}">@lang('admin.include.list_doc')</a></li>
					<li><a href="{{ route('admin.corpdocument.create') }}">@lang('admin.include.add_doc')</a></li>
				</ul>
			</li> --}}

			<!-- <li class="menu-title">@lang('admin.History')</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">@lang('admin.include.transactions')</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.history') }}">@lang('admin.include.list_history')</a></li>
					<li><a href="{{ route('admin.fiatHistory') }}">@lang('admin.include.fiat_history')</a></li>
					<li><a href="{{ route('admin.walletHistory') }}">@lang('admin.include.wallet_history')</a></li>

				</ul>
			</li>

			<li class="menu-title">@lang('admin.include.setting')</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">@lang('admin.include.setting')</span>
				</a>
				<ul>
					<li>
						<a href="{{ url('/admin/2fa/urlform') }}?route_url='admin.settings.index'">	@lang('admin.include.site_setting')</a>
					</li>
				</ul>
			</li>

			<li class="menu-title">Admin Wallet</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Admin Wallet</span>
				</a>
				<ul>
					<li>
						<a href="{{ route('admin.wallet.details') }}?route_url='admin.wallet.details'">Admin Wallets</a>
					</li>
				</ul>
			</li>

			<li class="menu-title">Deposit Crypto</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Deposit Crypto</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.crypto.deposit') }}">Deposit Request</a></li>
					<li><a href="{{ route('admin.crypto.deposit.history') }}">Deposit History</a></li>
				</ul>
			</li>

			<li class="menu-title">Gas fee Request</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Gas fees Request</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.gas.request') }}">Gas Request</a></li>
					{{-- <li><a href="{{ route('admin.crypto.deposit.history') }}">Deposit History</a></li> --}}
				</ul>
			</li>

			<li class="menu-title">Deposit Fiat</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Deposit Fiat</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.addbankfields') }}">Add Bank</a></li>
					{{-- <li><a href="{{ route('admin.addbankDetails') }}">Add Bank Details</a></li> --}}
					<li><a href="{{ route('admin.depositeRequest') }}">Deposit Request</a></li>
					<li><a href="{{ route('admin.depositeHistory') }}">Deposit History</a></li>
				</ul>
			</li>

			<li class="menu-title">Fiat Withdraw Request</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Usd Withdraw Request</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.withdraw.request') }}">Withdraw Request</a></li>
					<li><a href="{{ route('admin.withdraw.history') }}">Withdraw History</a></li>
				</ul>
			</li>

			<li class="menu-title">Crypto Withdraw Request</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Crypto Withdraw Request</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.crypto.withdraw.request') }}">Withdraw Request</a></li>
					{{-- <li><a href="{{ route('admin.crypto.withdraw.history') }}">Withdraw History</a></li> --}}
				</ul>
			</li>

			{{-- <li class="menu-title">White List</li>

<li class="with-sub">
	<a href="#" class="waves-effect  waves-light">
		<span class="s-caret"><i class="fa fa-angle-down"></i></span>
		<span class="s-icon"><i class="ti-view-grid"></i></span>
		<span class="s-text">White List</span>
	</a>
	<ul>
		<li><a href="{{ url('admin/whitelist_request') }}">White List Request</a></li>
		<li><a href="{{ route('admin.depositeHistory') }}">Deposit History</a></li>
	</ul>
</li> --}}

			<li class="menu-title">@lang('admin.include.vote')</li>
			<li>
				<a href="{{ url('admin/vote') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-help"></i></span>
					<span class="s-text">@lang('admin.include.vote')</span>
				</a>
			</li>

			<!-- <li class="menu-title">Fund Type</li>
			<li>
				<a href="{{ url('admin/fund') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-help"></i></span>
					<span class="s-text">Fund Types</span>
				</a>
			</li> -->

			<!-- <li class="menu-title">Investor Type</li>
			<li>
				<a href="{{ url('admin/investor') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-help"></i></span>
					<span class="s-text">Investor Types</span>
				</a>
			</li>

			<li class="menu-title">Worth Status</li>
			<li>
				<a href="{{ url('admin/worthstatus') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-help"></i></span>
					<span class="s-text">Worth Status</span>
				</a>
			</li> -->


			<li class="menu-title">@lang('admin.include.cms')</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">@lang('admin.include.cms')</span>
				</a>
				<ul>
					<li>
						<a href="{{ route('admin.support') }}"><span class="s-icon"></span> About Us </a>


					</li>
					<li>
						<a href="{{ route('admin.privacy') }}" class="waves-effect waves-light">
							<span class="s-icon"></span>
							<span class="s-text">@lang('admin.include.privacy_policy')</span>
						</a>
					</li>
					<li>
						<a href="{{ route('admin.terms') }}" class="waves-effect waves-light">
							<span class="s-icon"></span>
							<span class="s-text">@lang('admin.include.terms')</span>
						</a>
					</li>

				</ul>

			</li>


			<li class="menu-title">Nodes</li>
			<li>
				<a href="{{ route('admin.node.details') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">List Node</span>
				</a>
			</li>



			<!-- <li><a href="{{ route('admin.addtoken') }}"><span class="s-icon"><i class="ti-help"></i></span>Token Tickets </a></li>
			<li>
				<a href="{{ route('admin.about') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-help"></i></span>
					<span class="s-text">@lang('admin.include.about')</span>
				</a>
			</li> -->



			<!-- <li>
				<a href="{{route('admin.translation') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-smallcap"></i></span>
					<span class="s-text">@lang('admin.include.translations')</span>
				</a>
			</li> -->



			<li class="menu-title">@lang('admin.include.acc')</li>
			<!-- <li>
				<a href="{{ route('admin.profile') }}" class="waves-effect  waves-light">
					<span class="s-icon"><i class="ti-user"></i></span>
					<span class="s-text">@lang('admin.include.acc_setting')</span>
				</a>
			</li> -->
			<li>
				<a href="{{ route('admin.password') }}" class="waves-effect  waves-light">
					<span class="s-icon"><i class="ti-exchange-vertical"></i></span>
					<span class="s-text">@lang('user.profiles.change_password')</span>
				</a>
			</li>

			<li class="compact-hide">


				<a href="{{ route('adminlogout') }}"
				onclick="event.preventDefault();
				document.getElementById('logout-form').submit();">
				<span class="s-icon"><i class="ti-power-off"></i></span>@lang('user.profiles.logout')
			</a>

			<form id="logout-form" action="{{ route('adminlogout') }}" method="POST" style="display: none;">
				{{ csrf_field() }}
			</form>


		</li>

	</ul>
</div>
</div>