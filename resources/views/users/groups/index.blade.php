@extends('layouts.app')

@section('meta-description', 'All groups associated with ' . Auth::user()->name)

@section('title', 'Groups')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="list-group">
                <a href="#" class="list-group-item active">Your current Groups</a>
                @foreach($groups as $group)
                    <a href="{{ route('member::groups.show', [Auth::user(), $group]) }}" class="list-group-item">
                        {{ $group->name }}
                    </a>
                @endforeach
            </div>
            <div class="text-center">{!! $groups->render() !!}</div>
        </div>
    </div>
@stop