@extends('layouts.default')

@section('title', 'Dashboard')

@section('content')
	
	@include('partials.admin-toolbar')
	
	<div class="row app-container">

		<div class="row mg-top" id="total-view">
			<a href="{{ route('user') }}">
				<div class="col s3 total-block">
					<h5 class="black-text">Registered Users</h5>
						
					<div class="total indigo-text">
						{{ $total_users }}
					</div>
					
				</div>	
			</a>
			
			<a href="{{ route('members') }}">
				<div class="col s3 total-block">
					<h5 class="black-text">Admins</h5>
						
					<div class="total indigo-text">
						{{ $total_admins }}
					</div>
					
				</div>
			</a>
			
			<a href="{{ route('application') }}">
				<div class="col s3 total-block">
					<h5 class="black-text">Applications</h5>
						
					<div class="total indigo-text">
						{{ $total_apps }}
					</div>
					
				</div>	
			</a>
			
			<div class="col s3 total-block">
				<h5>Unique Users</h5>
					<div class="total indigo-text">
						{{ $total_token }}
					</div>
			</div>
		</div>

		<div class="row">
			@include('partials.analytic-views', ['isDashboard' => true])
		</div>

		<div class="row">
			<div class="col m6 s12">
				<h4>Most Used Applications</h4>
				<div class="collection white">
					<table class="bordered" id="most_used_app">
						<thead>
							<tr>
								<th width="80%">Name</th>
								<th>Unique Users</th>
							</tr>
						</thead>
						<tbody>
							@foreach($most_used_app as $app)
								<tr>
									<td>
										<a href="{{ route('application.view', $app['id']) }}" class="black-text">{{ $app['name'] }}</a>
										{{-- <p>API Key : {{ $app['key'] }}</p> --}}
									</td>
									<td>{{ $app['users'] }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="col m6 s12">
				<h4>Most Active Applications</h4>
				@if ($most_active_app)
					<div class="collection white">
						<table class="bordered" id="most_active_app">
							<thead>
								<tr>
									<th width="80%">Name</th>
									<th>Total Hits</th>
								</tr>
							</thead>
							<tbody>
								@foreach($most_active_app as $app)
									<tr>
										<td>
											<a href="{{ route('application.view', $app['id']) }}" class="black-text">{{ $app['name'] }}</a>
										</td>
										<td>{{ $app['hit'] }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@endif
			</div>
		</div>

		<div class="row">
			<div class="col m6 s12">
				<h4>Latest Register Users</h4>

				<ul class="collection">
					@foreach ($users as $u)
					<li class="collection-item avatar">
						<img src="{{ $u->getProfileImage() }}" alt="" class="circle">
						<span class="title">{{ $u->name }}</span>
						<p>Registered At : {{ $u->created_at->format('d-M-Y') }}</p>
					</li>
					@endforeach
				</ul>
			</div>

			<div class="col m6 s12">
				<h4>Latest Register Applications</h4>

				<ul class="collection">
					@foreach ($applications as $a)
					<li class="collection-item avatar">
						<a href="{{ route('application.view', $app['id']) }}" class="black-text">
							@if ($a->type == 'android')
							<i class="circle green app-type-text" title="Android">A</i>
							@elseif ($a->type == 'ios')
							<i class="circle blue app-type-text" title="iOS">I</i>
							@else
							<i class="circle red app-type-text" title="Web">W</i>
							@endif
							<span class="title">{{ $a->name }}</span>
							<p>Registered At : {{ $a->created_at->format('d-M-Y') }}</p>
						</a>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
@endsection

@section('foot-js')

	<script type="text/javascript" src="{{ url('js/analytic.js') }}"></script>

	<script>

		fetchData('{{ route('api.analytic.data') }}?thd=true');

		//fetchTotalHits('{{ route('api.analytic.total_hits') }}');

	</script>

@endsection