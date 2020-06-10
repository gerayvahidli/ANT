@extends('layouts.backend')

@section('mainSectionTitle', 'Şərtlərin siyahısı')

@section('mainSection')
    <h3>
        <a href="{{ route('admin.terms.create') }}"> <i data-feather="plus"></i> Yeni şərt yarat</a>
    </h3>
        {{--<h3>--}}
            {{--Meqalelerin siyahisi--}}
            {{--<small class="text-muted"><a href="{{ route('terms.create') }}">Yeni meqale elave et</a></small>--}}
        {{--</h3>--}}
    @if(count($terms))
        <table class="table table-striped table-hover" id="data-list">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Link</th>
                <th scope="col">Başlıq</th>
                <th scope="col">Proqram</th>
                <th scope="col">Şərtin növü</th>
                <th scope="col">Dəyiş</th>
                <th scope="col">Sil</th>
            </tr>
            </thead>
            <tbody>
            @foreach($terms as $term)
            <tr>
                <th scope="row"><a href="{{ route('admin.terms.edit', $term->id) }}">{{ $term->id }}</a></th>
                <td><a href="{{ route('admin.terms.edit', $term->id) }}">{{ $term->slug }}</a></td>
                <td><a href="{{ route('admin.terms.edit', $term->id) }}">{{ $term->title }}</a></td>
                <td>{{ $term->programType->Name }}</td>
                <td>{{ $term->termType->title }}</td>
                <td>
                    <button class="btn">
                        <a href="{{ route('admin.terms.edit', $term->id) }}"><i data-feather="edit"></i></a>
                    </button>
                </td>
                <td>
                    {{ Form::open([
                        'method' => 'delete',
                        'route' => ['admin.terms.destroy', $term->id]
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
            Bazada Məlumat yoxdur!
        </div>
    @endif
@endsection