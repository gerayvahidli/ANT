@extends('layouts.backend')

@section('mainSectionTitle')
    {{ ($slide->exists) ? $slide->title . ' - slayd redaktə olunur.' : 'Yeni slayd yarat' }}
    @endsection
@section('mainSection')
<div class="jumbotron">
    {{ Form::model($slide,
        [
            'method' => $slide->exists ? 'put' : 'post',
            'route' => $slide->exists ? ['admin.slides.update', $slide->id] : ['admin.slides.store'],
            'class' => 'form-horizontal',
            'role'  => 'form',
            'files' => true
        ]
    ) }}

        <div class="form-group row">
            <label for="program_type_id" class="col-sm-2 col-form-label">Proqram</label>
            <div class="col-sm-10">
                {{ Form::select('program_type_id',
                 $programTypes, null,
                 ['class' => 'form-control', 'id' => 'program_type_id', 'placeholder' => 'Proqram']
                 ) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Başlıq</label>
            <div class="col-sm-10">
                {{ Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Başlıq']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="image" class="col-4 col-form-label">Şəkil</label>
            <div class="col-8">
                {{ Form::file('image', ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="show_in_home_page" class="col-sm-2 col-form-label">Ana səhifədə görünsün</label>
            <div class="col-sm-10">
                {{ Form::checkbox('show_in_home_page', 1, null, ['class' => 'form-control', 'id' => 'show_in_home_page']) }}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                {{ Form::submit( $slide->exists ? 'Yadda saxla' : 'Yeni slayd yarat', [ 'class' => 'btn btn-primary']) }}
            </div>
        </div>
    {{ Form::close() }}
</div>
@endsection