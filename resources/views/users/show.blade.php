@extends('layouts.app')

@section('content')
	<div class="col-md-12">

		<h1 class="pull-left">{!! $user->getFullName() !!}</h1>
		@if($user->isActive())
			<a class="btn btn-primary pull-right" style="margin-top: 25px; margin-left: 5px;" href="{!! route('app.users.dinners.create', $user->id) !!}">{!! trans('general.new_dinner') !!}</a>
			<a class="btn btn-success pull-right" style="margin-top: 25px; margin-left: 5px;" href="{!! route('app.users.matches', $user->id) !!}">{!! trans('general.find_dinners') !!}</a>
		@endif
		<a class="btn btn-default pull-right" style="margin-top: 25px; margin-left: 5px;" href="{!! route('app.users.dinners', $user->id) !!}">{!! trans('general.all_dinners') !!}</a>
		<a class="btn btn-primary btn-info pull-left" style="margin-top: 25px; margin-left: 5px;" href="{!! route('app.users.edit', $user->id) !!}">{!! trans('general.edit') !!}</a>
		@if($user->isActive())
			<a class="btn btn-default pull-left open-modal" style="margin-top: 25px; margin-left: 5px;" data-toggle="modal" data-target="#modal-{!! $user->id !!}" href>{!! trans('general.inactivate') !!}</a>
		@else
			<a class="btn btn-default pull-left" style="margin-top: 25px; margin-left: 5px;" href="{!! route('app.users.activate', $user->id) !!}">{!! trans('general.activate') !!}</a>
		@endif
		<a class="btn btn-default pull-left" style="margin-top: 25px; margin-left: 5px;" onclick="return confirm('Är du säker på att du vill ta bort deltagaren?')" href="{!! route('app.users.delete', $user->id) !!}">{!! trans('general.delete') !!}</a>

	</div>
	<div class="col-md-12">
		@include('users.show_fields')
	</div>

	@include('partials.modal', ['content' => 'users.inactivate', 'modalName' => $user->id])
	@include('users.emails')
@endsection

@push('scripts')
	@include('scripts.datetimepicker')
	@include('scripts.select2')
@endpush