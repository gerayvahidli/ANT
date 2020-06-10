@extends('layouts.backend')

@section('mainSectionTitle', 'Şərt növləri siyahısı')

@section('mainSection')
    <h3>
        <a href="{{ route('admin.termTypes.create') }}"> <i data-feather="plus"></i> Yeni şərt növü yarat</a>
    </h3>
        {{--<h3>--}}
            {{--Meqalelerin siyahisi--}}
            {{--<small class="text-muted"><a href="{{ route('termTypes.create') }}">Yeni meqale elave et</a></small>--}}
        {{--</h3>--}}
    @if(count($termTypes))
        <table class="table table-striped table-hover" id="data-list">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Link</th>
                <th scope="col">Başlıq</th>
                <th scope="col">Dəyiş</th>
                <th scope="col">Sil</th>
            </tr>
            </thead>
            <tbody>
            @foreach($termTypes as $termType)
            <tr>
                <th scope="row"><a href="{{ route('admin.termTypes.edit', $termType->id) }}">{{ $termType->id }}</a></th>
                <td><a href="{{ route('admin.termTypes.edit', $termType->id) }}">{{ $termType->slug }}</a></td>
                <td><a href="{{ route('admin.termTypes.edit', $termType->id) }}">{{ $termType->title }}</a></td>
                <td>
                    <button class="btn">
                        <a href="{{ route('admin.termTypes.edit', $termType->id) }}"><i data-feather="edit"></i></a>
                    </button>
                </td>
                <td>
                    {{ Form::open([
                        'method' => 'delete',
                        'route' => ['admin.termTypes.destroy', $termType->id]
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