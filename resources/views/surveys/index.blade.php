@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<form action="{{ route('surveys.store') }}" method="post" @submit.prevent="submitSurveyForm">
				@csrf
				<div class="form-group">
					<label for="name">Survey name:
						<input type="text" name="name" v-model="survey.name" class="form-control" id="name">
					</label>
				</div>
				<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#usersModal">
	  				Specifiy users
				</button>
				<br><br>
				<button type="submit" class="btn btn-primary">Add survey</button>
			</form>
		</div>
	</div>
	<hr>
	<h3 class="title">Surveys:</h3>
	@forelse($surveys as $survey)
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-lg-10 font-size-16">
						{{ $survey->name }}
					</div>
					<div class="col-lg-2">
						<div class="row">
							<div class="col-lg-6">
								<a href="{{ route('surveys.edit', $survey) }}" class="btn btn-sm btn-info">Edit</a>
							</div>
							<div class="col-lg-6">
								<form action="{{ route('surveys.destroy', $survey) }}" method="post">
									@csrf
									@method('delete')
									<button type="submit" class="btn btn-sm btn-danger">Delete</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-body">
				Users:
				<ul>
					@forelse($survey->users as $user)
						<li>{{ $user->name }} - {{  $user->email}}</li>
					@empty
						<span class="text-danger">
							No users in this survey
						</span>
					@endforelse
				</ul>
			</div>
		</div>
		<br>
	@empty
		No surveys found.
	@endforelse
	
	<modal-component id="usersModal" title="Specifiy users">
		<select-users-component :users="{{ $users }}"></select-users-component>
	</modal-component>
@endsection

@push('scripts')
	
@endpush