@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<form action="{{ route('surveys.update', $survey) }}" method="post" @submit.prevent="submitEditSurveyForm">
				@csrf
				@method('put')
				<div class="form-group">
					<label for="name">Survey name:
						<input type="text" name="name" ref="surveyName" value="{{ $survey->name }}" class="form-control" id="name">
					</label>
				</div>
				{{-- Just because I am rush I did this :( --}}
				<input type="hidden" value="{{  $survey->id }}" ref="surveyId">
				<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#usersModal">
	  				Specifiy users
				</button>
				<br><br>
				<button type="submit" class="btn btn-primary">Add survey</button>
			</form>
		</div>
	</div>
	<input type="hidden" value="{{ $survey->users()->pluck('id')->toJson() }}" ref="selectedUsers">

	<modal-component id="usersModal" title="Specifiy users">
		<select-users-component :users="{{ $users }}"></select-users-component>
	</modal-component>
@endsection