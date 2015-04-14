@extends('layouts.admin')

@section('title', 'Trashed Tasks')

@section('content')
    <div class="admin-contents-wrapper">
        @if ($trashedTasks->isEmpty())
            <div class="well text-center">Currently, there is no trashed task.</div>
        @else
            <div class="panel panel-default">
                <div class="panel-heading">Trashed Tasks Table</div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Deleted Date</th>
                            <th>Deleted by</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Starting</th>
                            <th>Ending</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trashedTasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td class="text-center">{{ $task->present()->formatTime($task->deleted_at) }}</td>
                                <td class="text-center">{{ $task->destroyer->name }}</td>
                                <td class="text-center">{{ $task->owner->name }}</td>
                                <td class="text-navy">{{ $task->title }}</td>
                                <td class="text-center">{{ $task->present()->formatTime($task->starting_date) }}</td>
                                <td class="text-center">{{ $task->present()->formatTime($task->finishing_date) }}</td>
                                <td class="text-center">
                                    @include('admin.tasks.partials.restore_form')
                                    @include('admin.tasks.partials.force_delete_form')
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        <div class="text-center">{!! $trashedTasks->render() !!}</div>
    </div>
@stop