@extends('layouts.admin')
@section('title', 'Schedule Member Assignment')
@section('assignable-objects')
    <div class="form-group">
        <div class="form-group">
            {!! Form::label('user_list', 'Choose Members', ['class' => 'control-label']) !!}
            {!! Form::select('user_list[]', $users, null, ['id' => 'user_list', 'class' => 'form-control', 'multiple']) !!}
            {!! error_text($errors, 'user_list') !!}
        </div>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary form-wrapper">
                <div class="panel-heading"><strong>Create Member Assignment</strong></div>
                <div class="panel-body">
                    {!! Form::model([$task = new \Keep\Entities\Task, $assignment = new \Keep\Entities\Assignment],
                        ['route' => ['admin::assignments.member.store']]) !!}
                        @include('admin.assignments.partials._main_form', ['assignmentButton' => 'Create Assignment'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
