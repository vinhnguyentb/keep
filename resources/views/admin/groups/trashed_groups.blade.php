@extends('layouts.admin')
@section('title', 'Trashed Groups')
@section('content')
    <div class="admin-contents-wrapper">
        @if(blank($trashedGroups))
            <div class="text-center text-warning">No trashed group available.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Members</th>
                        <th>Deleted at</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($trashedGroups->chunk(10) as $groupStack)
                            @foreach($groupStack as $group)
                                <tr>
                                    <td>{{ $group->id }}</td>
                                    <td>{{ $group->name }}</td>
                                    <td>{{ count($group->users) }}</td>
                                    <td>{{ full_time($group->deleted_at) }}</td>
                                    <td>
                                        @include('admin.groups.partials._restore_form')
                                        @include('admin.groups.partials._force_delete_form')
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        {!! paginate($trashedGroups) !!}
    </div>
@stop
