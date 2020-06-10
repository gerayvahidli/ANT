@extends('layouts.backend')

@section('mainSectionTitle')
    {{ ($article->exists) ? $article->title . ' - məqaləsi redaktə olunur.' : 'Yeni məqalə yarat' }}
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

        {{ Form::model($article,
            [
                'method' => $article->exists ? 'put' : 'post',
                'route' => $article->exists ? ['admin.articles.update', $article->id] : ['admin.articles.store'],
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
            <label for="slug" class="col-sm-2 col-form-label">Tarix</label>
            <div class="col-sm-10">
                {{ Form::date('published_at', null, ['class' => $errors->has('published_at') ? 'form-control is-invalid' : 'form-control', 'id' => 'published_at']) }}
                @if ($errors->has('published_at'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('published_at') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                {{ Form::submit( $article->exists ? 'Yadda saxla' : 'Yeni məqalə yarat', [ 'class' => 'btn btn-primary']) }}
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection