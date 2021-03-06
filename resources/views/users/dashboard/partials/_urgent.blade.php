@unless(blank($urgent))
    <div class="panel panel-danger">
        <div class="panel-heading">Urgent</div>
        <ul class="list-group">
            @foreach($urgent as $task)
                <li class="list-group-item">
                    <h5 class="task-title">{{ $task->title }}</h5>
                    <h6 class="text-warning">{{ remaining_days($task->finishing_date) }}</h6>
                    @include('users.dashboard.partials._controls')
                </li>
            @endforeach
        </ul>
    </div>
@endunless