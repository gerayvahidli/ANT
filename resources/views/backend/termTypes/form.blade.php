@extends('layouts.backend')

@section('mainSectionTitle')
    {{ ($termType->exists) ? $termType->title . ' - şərt növü redaktə olunur.' : 'Yeni şərt növü yarat' }}
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
    {{ Form::model($termType,
        [
            'method' => $termType->exists ? 'put' : 'post',
            'route' => $termType->exists ? ['admin.termTypes.update', $termType->id] : ['admin.termTypes.store'],
            'class' => 'form-horizontal',
            'role'  => 'form',
            'files' => true
        ]
    ) }}

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
            <div class="col-sm-10">
                {{ Form::submit( $termType->exists ? 'Yadda saxla' : 'Yeni şərt növü yarat', [ 'class' => 'btn btn-primary']) }}
            </div>
        </div>
    {{ Form::close() }}
</div>
@endsection