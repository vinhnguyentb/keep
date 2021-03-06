<div class="modal fade" id="cancel-account-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p class="text-center">Once your account is deleted, the system will immediately delete all your tasks, and
                    all other things related to your account.</p>
            </div>
            <div class="modal-footer">
                {!! Form::open(['route' => ['user.account.destroy', $user], 'method' => 'DELETE']) !!}
                    {!! Form::submit('Confirm', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>