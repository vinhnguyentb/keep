{!! Form::open(['method' => 'PUT', 'route' => ['admin.members.disabled.restore', $member]]) !!}
    <button type="submit"
            class="btn btn-info btn-xs"
            data-toggle="tooltip"
            data-placement="bottom"
            title="Restore account">
        <i class="fa fa-arrow-left"></i>
    </button>
{!! Form::close() !!}