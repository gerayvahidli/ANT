@extends('layouts.backend')

@section('mainSectionTitle')
    {{ ($term->exists) ? $term->title . ' - şərti redaktə olunur.' : 'Yeni şərt yarat' }}
    @endsection
@section('mainSection')
<div class="jumbotron">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{ Form::model($term,
        [
            'method' => $term->exists ? 'put' : 'post',
            'route' => $term->exists ? ['admin.terms.update', $term->id] : ['admin.terms.store'],
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
                 ['class' => $errors->has('program_type_id') ? 'form-control is-invalid' : 'form-control', 'id' => 'program_type_id', 'placeholder' => 'Proqram']
                 ) }}
                @if ($errors->has('program_type_id'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('program_type_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="term_type_id" class="col-sm-2 col-form-label">Şərtin növü</label>
            <div class="col-sm-10">
                {{ Form::select('term_type_id',
                 $termTypes, null,
                 ['class' => $errors->has('term_type_id') ? 'form-control is-invalid' : 'form-control', 'id' => 'term_type_id', 'placeholder' => 'Şərtin növünü seç']
                 ) }}
                @if ($errors->has('term_type_id'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('term_type_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Başlıq</label>
            <div class="col-sm-10">
                {{ Form::text('title', null, ['class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control' , 'id' => 'title', 'placeholder' => 'Başlıq']) }}
                @if ($errors->has('title'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="slug" class="col-sm-2 col-form-label">Link</label>
            <div class="col-sm-10">
                {{ Form::text('slug', null, ['class' => $errors->has('slug') ? 'form-control is-invalid' : 'form-control', 'id' => 'slug', 'placeholder' => 'Link']) }}
                @if ($errors->has('slug'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('slug') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="body" class="col-sm-2 col-form-label">Mətn</label>
            <div class="col-sm-10">
                {{ Form::textarea('body', null, ['class' => $errors->has('body') ? 'form-control is-invalid' : 'form-control', 'id' => 'body']) }}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                {{ Form::submit( $term->exists ? 'Yadda saxla' : 'Yeni şərt yarat', [ 'class' => 'btn btn-primary']) }}
            </div>
        </div>
    {{ Form::close() }}
</div>
@endsection