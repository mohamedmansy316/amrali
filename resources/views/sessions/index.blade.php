@extends('layouts.app')
@section('content')
{{-- {{$sessions}} --}}
<div class="container">
    <h1 style="margin-top: 10px"> Sessions page </h1>
    <a class="btn btn-success" href="{{route('sessions.create')}}">Add new session </a>

    <table class="table" style="margin-top: 10px">
        <thead>
          <tr>

            <th scope="col">Session type</th>
            <th scope="col">Price Online</th>
            <th scope="col">Price Offline</th>
            <th scope="col"> Control</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($sessions as $session )
            <tr>
                <td>{{$session->session_type}}</td>
                <td>{{$session->price_online}}</td>
                <td>{{$session->price_offline}}</td>
                <td  style="width: 0px;"> <a class="btn btn-warning" href="{{route('sessions.edit',$session->id)}}">@lang('auth.edit')</a> </td>
                <td style="width: 0px;">
                 <form method="POST" action="{{ route('sessions.destroy', $session->id) }}">
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
