@extends('layouts.backend')

@section('mainSectionTitle', 'Ixtisasların siyahısı')

@section('mainSection')
    <h3>
        <a href="{{ route('admin.specialities.create') }}"> <i data-feather="plus"></i> Yeni ixtisas yarat</a>
    </h3>
        {{--<h3>--}}
            {{--Meqalelerin siyahisi--}}
            {{--<small class="text-muted"><a href="{{ route('specialities.create') }}">Yeni meqale elave et</a></small>--}}
        {{--</h3>--}}
    @if(count($specialities))
        <table class="table table-striped table-hover" id="data-list">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Link</th>
                <th scope="col">Başlıq</th>
                <th scope="col">Proqram</th>
                <th scope="col">Dəyiş</th>
                <th scope="col">Sil</th>
            </tr>
            </thead>
            <tbody>
            @foreach($specialities as $speciality)
            <tr>
                <th scope="row"><a href="{{ route('admin.specialities.edit', $speciality->id) }}">{{ $speciality->id }}</a></th>
                <td><a href="{{ route('admin.specialities.edit', $speciality->id) }}">{{ $speciality->slug }}</a></td>
                <td><a href="{{ route('admin.specialities.edit', $speciality->id) }}">{{ $speciality->title }}</a></td>
                <td>{{ $speciality->programType->Name }}</td>
                <td>
                    <button class="btn">
                        <a href="{{ route('admin.specialities.edit', $speciality->id) }}"><i data-feather="edit"></i></a>
                    </button>
                </td>
                <td>
                    {{ Form::open([
                        'method' => 'delete',
                        'route' => ['admin.specialities.destroy', $speciality->id]
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