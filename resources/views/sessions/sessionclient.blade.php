@extends('layouts.app')
@section('content')
    {{-- {{$sessions}} --}}
    <div class="container">
        <h1 style="margin-top: 10px"> Session Client page </h1>
        {{-- {{$session_clients}} --}}
        <table class="table table-striped" style="margin-top: 10px">
            <thead>
                <tr>

                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Type</th>
                    <th scope="col">Session type</th>
                    <th scope="col">Session time</th>
                    <th scope="col"> Control</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($session_clients as $session)
                    <tr>
                        <td>{{ $session->name }}</td>
                        <td>
                            @if ($session->booked == 0)
                            @if (session('sessionContacted') && session('id'))
                                <p class="btn btn-dark"> clientContacted</p>
                            @else
                                <a class="btn btn-warning" href="{{route('connectClient',$session->id)}}">@lang('auth.need contact') </a>
                            @endif
                        @endif
                        </td>
                        <td>{{ $session->email }}</td>
                        <td>{{ $session->phone }}</td>
                        <td>{{ $session->type }}</td>
                        <td>{{ $session->session_type }}</td>
                        <td>{{ $session->session_time }}</td>
                        <td>
                            <a href="{{route('deleteClient',$session->id)}}" class="btn btn-danger">@lang('auth.delete')</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
