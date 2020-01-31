@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            @if (Auth::check())
                <div class="card-header">Tasks List</div>
                <div class="card-body">
                    <a href="/task" class="btn btn-primary">Add new Task</a>
                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th colspan="2">Tasks</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($user->tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->content }}</td>
                                <td>
                                    <a href="/task/{{$task->id}}" type="submit" name="edit" class="btn btn-primary">Edit</a>
                                    <a href="/delete/task/{{ $task->id }}" type="submit" name="edit" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            {{ csrf_field() }}
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="card-body">
                    <h3>Todo List</h3>
                </div>
            @endif
        </div>
    </div>
@endsection