@extends('layouts.app')

@section('content')
    @include('flash::message')
    <div class="row">
        <div class="col-md-12">
            <h1 class="pull-left">
              {{ trans('general.list') }}
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Namn</th>
                        <th>Epost</th>
                        <th>Telefon</th>
                        <th>Registrerad</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>
                            <a href="{{ route('app.users.show', ['id' => $row->id]) }}">
                                {{ $row->full_name }}
                            </a>
                        </td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->phone }}</td>
                        <td>{{ $row->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection