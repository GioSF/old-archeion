<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
	<div class="container">
		<a class="navbar-brand" href="{{ url('/') }}">
			{{ config('app.name', 'Laravel') }}
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav mr-auto">
				@can('isAdmin')
					<li class="nav-link"><a href="#dashboard"></a>dashboard</li>
					<li class="nav-link"><a href="#new-post"></a>new post</li>
					<li class="nav-link"><a href="#edit"></a>edit</li>
					<li class="nav-link"><a href="#delete"></a>delete</li>
				@endcan
					
				@can('isEditor')
					<li class="nav-link"><a href="#dashboard"></a>dashboard</li>
					<li class="nav-link"><a href="#new-post"></a>new post</li>
					<li class="nav-link"><a href="#edit"></a>edit</li>
				@endcan
					<!-- Visitante -->
					<li class="nav-link"><a href="{{  url('/acervo')  }}">Acervo</a></li>
					<li class="nav-link"><a href="{{  url('/localizacao')  }}">Localização</a></li>
					<li class="nav-link"><a href="{{  url('/sobre')  }}">Sobre o projeto</a></li>

			</ul>
			<!-- End of Left Side Of Navbar -->

			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">
				<!-- Authentication Links -->
				@guest
					<li class="nav-item">
						<a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
					</li>
					@if (Route::has('register'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
						</li>
					@endif
					@else
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('logout') }}"
								onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
									{{ __('Sair') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
								</form>
							</div>
						</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>