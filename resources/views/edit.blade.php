@extends('layouts.app')

@section('content')
	<div class="container">
		<h1>Edit the Task</h1>

		<form method="POST" action="/task/{{ $task->id }}">
			{{ csrf_field() }}

			<div class="form-group">
				<textarea name="content" class="form-control" required="">{{ $task->content }}</textarea>
			</div>


			<div class="form-group">
				<button type="submit" name="update" class="btn btn-primary">Update</button>
			</div>
		</form>
	</div>
@endsection