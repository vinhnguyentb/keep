@extends('layouts.admin')
@section('title', 'Active Members')
@section('content')
    <div class="admin-contents-wrapper">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{!! sort_accounts_by('id', 'ID') !!}</th>
                        <th>{!! sort_accounts_by('name', 'Name') !!}</th>
                        <th>{!! sort_accounts_by('email', 'Email') !!}</th>
                        <th>Tasks</th>
                        <th>Groups</th>
                        <th>{!! sort_accounts_by('created_at', 'Joined Date') !!}</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activeMembers->chunk(10) as $memberStack)
                        @foreach($memberStack as $member)
                            <tr>
                                <td>{{ $member->id }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->email }}</td>
                                <td>{{ counting($member->tasks) }}</td>
                                <td>{{ counting($member->groups) }}</td>
                                <td>{{ short_time($member->created_at) }}</td>
                                <td>
                                    @unless($member->isAdmin())
                                        @include('admin.members.partials._delete_form')
                                    @endunless
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! paginate($activeMembers) !!}
    </div>
@stop
