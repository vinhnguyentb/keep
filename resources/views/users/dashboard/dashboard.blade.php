@extends('layouts.default')
@section('title', 'Dashboard')
@section('content')
    @inject('counter', 'Keep\Services\UserDashboard')
    <div class="row user-dashboard">
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-6">
                    @include('users.dashboard.partials._urgent')
                    @include('users.dashboard.partials._tag_cloud')
                </div>
                <div class="col-md-6">
                    @include('users.dashboard.partials._deadline')
                    @include('users.dashboard.partials._completed')
                </div>
            </div>
        </div>
        <div class="col-md-5">
            @include('users.dashboard.partials._search_form')
            @include('users.dashboard.partials._chart')
            @include('users.dashboard.partials._sync_failed_tasks')
            @include('users.dashboard.partials._counters')
            @include('users.dashboard.partials._priorities')
        </div>
    </div>
@stop

@section('footer')
    <script>
        @unless(zero($counter->totalTasks()))
            $(function() {
                Keep.charts.showUserDashboardChart(
                    {{ $counter->countCompletedTasks() }},
                    {{ $counter->countFailedTasks() }},
                    {{ $counter->countDueTasks() }},
                    {{ $counter->totalTasks() }}
                );
            });
        @endunless
    </script>
@stop
