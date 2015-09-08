<div class="task-wrapper">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="pull-right">
                <div class="dropdown">
                    <span class="fa fa-angle-down dropdown-toggle" data-toggle="dropdown"></span>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <a href="{{ route('member::tasks.edit', [$user, $task]) }}">
                                <i class="fa fa-pencil-square"></i>&nbsp; Update
                            </a>
                        </li>
                        @include('users.tasks.partials._delete_form')
                        <li>
                            <a href="{{ route('member::dashboard', $user) }}">
                                <i class="fa fa-arrow-circle-left"></i>&nbsp; Dashboard
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <a class="task-title">{{ $task->title }}</a>
            <h6 class="task-time-ago">Created {{ humans_time($task->created_at) }}</h6>
        </div>
        <div class="panel-body">
            <div class="task-labels">
                <span class="label label-primary">
                    {{ short_time($task->starting_date) }} to {{ short_time($task->finishing_date) }}
                </span>
                <span class="label label-primary">{{ remaining_days($task->finishing_date) }}</span>
                @if($task->is_failed)
                    <span class="label label-danger">failed</span>
                @endif
                <span class="label label-info">{{ $task->priority->name }} priority</span>
            </div>
            <div class="well">{!! $task->content !!}</div>
            @unless (empty($task->location))
                <div class="well"><i class="fa fa-map-marker"></i><strong>{{ $task->location }}</strong></div>
            @endunless
            @unless (blank($task->tags))
                <div class="well">
                    <i class="fa fa-tags"></i>
                    @foreach($task->tags as $tag)
                        <a href="{{ route('member::tags.task', [$authUser, $tag]) }}">
                            <span class="label label-default">{{ $tag->name }}</span>
                        </a>
                    @endforeach
                </div>
            @endunless
            @unless($task->is_failed)
                <div class="text-center">
                    @include('users.tasks.partials._complete_form')
                </div>
            @endunless
        </div>
    </div>
</div>