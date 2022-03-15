@extends('layouts.app')

	@section('content')
	<div class="col-md-12">
		<h1 class="pull-left">{!! trans('general.dinner_at') . ' ' . $dinner->user->getFullName() !!}</h1>

		<div class="col-md-12">
			<h2>
				{!! trans('general.host') !!}
				@if($dinner->hasInformedHost())
					<span class="label label-success">
						{!! trans('general.confirmation_email_sent_to_host') !!}
					</span>
				@endif

			</h2>
		</div>

		@include('dinners.show_fields')
	</div>

	@include('matches.index')

	@include('dinners.emails')
@endsection
