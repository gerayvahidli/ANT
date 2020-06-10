@extends('layouts.backend')

@section('mainSectionTitle', 'Məqalələrin siyahısı')

@section('mainSection')
    <h3>
        <a href="{{ route('admin.articles.create') }}"> <i data-feather="plus"></i> Yeni məqalə yarat</a>
    </h3>
        {{--<h3>--}}
            {{--Meqalelerin siyahisi--}}
            {{--<small class="text-muted"><a href="{{ route('articles.create') }}">Yeni meqale elave et</a></small>--}}
        {{--</h3>--}}
    @if(count($articles))
        <table class="table table-striped table-hover" id="data-list">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Link</th>
                <th scope="col">Başlıq</th>
                <th scope="col">Proqram</th>
                <th scope="col">Tarix</th>
                <th scope="col">Dəyiş</th>
                <th scope="col">Sil</th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $article)
            <tr>
                <th scope="row"><a href="{{ route('admin.articles.edit', $article->id) }}">{{ $article->id }}</a></th>
                <td><a href="{{ route('admin.articles.edit', $article->id) }}">{{ $article->slug }}</a></td>
                <td><a href="{{ route('admin.articles.edit', $article->id) }}">{{ $article->title }}</a></td>
                <td>{{ $article->programType->Name }}</td>
                <td>{{ $article->published_at }}</td>
                <td>
                    <button class="btn">
                        <a href="{{ route('admin.articles.edit', $article->id) }}"><i data-feather="edit"></i></a>
                    </button>
                </td>
                <td>
                    {{ Form::open([
                        'method' => 'delete',
                        'route' => ['admin.articles.destroy', $article->id]
                    ]) }}
                    <button type="submit" class="btn"><i data-feather="trash-2" color="red"></i></button>
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning" role="alert">
            Bazada Melumat yoxdur!
        </div>
    @endif
@endsection