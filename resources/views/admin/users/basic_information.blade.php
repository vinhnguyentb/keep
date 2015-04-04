<div class="panel panel-primary">
    <div class="panel-heading">
        @if($user->isAdmin())
            <span class="pull-right label label-danger">Admin</span>
        @endif
        {{ $user->name }}
    </div>
    <ul class="list-group">
        <li class="list-group-item">
            <div class="text-center">
                @include('users.partials.avatar', ['size' => 120])
            </div>
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Date of Birth</h6>
            {{ $user->present()->printAttribute($user->present()->formatUserTime($user->birthday)) }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">E-Mail Address</h6>
            {{ $user->email }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Address</h6>
            {{ $user->address }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Company</h6>
            {{ $user->present()->printAttribute($user->company) }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Personal Website</h6>
            {{ $user->present()->printAttribute($user->website) }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Phone Number</h6>
            {{ $user->present()->printAttribute($user->phone) }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">About Yourself</h6>
            {{ $user->present()->printAttribute($user->about) }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Joined Date</h6>
            {{ $user->present()->formatUserTime($user->created_at) }}
        </li>
    </ul>
</div>