{!! Form::open(array('method' => 'DELETE', 'route' => array('admin::members.active.disable', $account))) !!}
    <button type="submit" class="btn btn-danger btn-circle btn-sm"
        data-toggle="tooltip" data-placement="bottom" title="Disable this account">
        <i class="fa fa-times"></i>
    </button>
{!! Form::close() !!}