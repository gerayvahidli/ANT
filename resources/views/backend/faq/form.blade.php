@extends('layouts.backend')

@section('mainSectionTitle')
    {{ ($faq->exists) ? $faq->title . ' - məqaləsi redaktə olunur.' : 'Yeni məqalə yarat' }}
    @endsection
@section('mainSection')
<div class="jumbotron">
    {{ Form::model($faq,
        [
            'method' => $faq->exists ? 'put' : 'post',
            'route' => $faq->exists ? ['admin.faq.update', $faq->id] : ['admin.faq.store'],
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
            <label for="slug" class="col-sm-2 col-form-label">Link</label>
            <div class="col-sm-10">
                {{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug', 'placeholder' => 'Link']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="answer" class="col-sm-2 col-form-label">Cavab</label>
            <div class="col-sm-10">
                {{ Form::textarea('answer', null, ['class' => 'form-control', 'id' => 'answer']) }}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                {{ Form::submit( $faq->exists ? 'Yadda saxla' : 'Yeni sual yarat', [ 'class' => 'btn btn-primary']) }}
            </div>
        </div>
    {{ Form::close() }}
</div>
@endsection