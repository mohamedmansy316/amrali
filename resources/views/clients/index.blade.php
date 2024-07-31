@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 style="margin-top: 10px;">@lang('auth.All Clients') </h1>
        <a class="btn btn-success" href="{{ route('clients.create') }}"> @lang('auth.Add Client')</a>

        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">@lang('auth.Name')</th>
                    <th scope="col">@lang('auth.Phone')</th>
                    <th scope="col"> @lang('auth.Email Address')</th>
                    <th scope="col">@lang('auth.Address')</th>
                    <th scope="col">@lang('auth.Type')</th>
                    <th scope="col">@lang('auth.book name')</th>
                    <th scope="col">@lang('auth.Control')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td> {{ $client->username }}
                            @if ($client->booked == 1)
                                @if (session('clientContacted') && session('client_id'))
                                <p class="btn btn-dark"> clientContacted</p>
                                @else
                                <a class="btn btn-warning" href="{{ route('clients.edit', $client->id) }}">@lang('auth.need contact') </a>
                                @endif

                            @endif
                        </td>
                        <td> {{ $client->phone }} </td>
                        <td> {{ $client->email }} </td>
                        <td> {{ $client->address }} </td>
                        <td> {{ $client->type }} </td>
                        <td> {{ $client->book_name }} </td>
                        <td>
                            <form method="POST" action="{{ route('clients.destroy', $client->id) }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger" value="@lang('auth.delete')">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
