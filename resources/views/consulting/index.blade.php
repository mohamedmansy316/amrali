@extends('layouts.app')
@section('content')
<div class="container">
    <h1 style="margin-top: 10px"> Consult page </h1>
    <a class="btn btn-success" href="{{route('consults.create')}}">Add new consult </a>
    <table class="table" style="margin-top: 10px">
        <thead>
          <tr>
            <th scope="col">Consult type</th>
            <th scope="col">Price Online</th>
            <th scope="col">Price Offline</th>
            <th scope="col"> Control</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($consults as $consult )
            <tr>
                <td>{{$consult->consult_type}}</td>
                <td>{{$consult->price_online}}</td>
                <td>{{$consult->price_offline}}</td>
                <td  style="width: 0px;"> <a class="btn btn-warning" href="{{route('consults.edit',$consult->id)}}">@lang('auth.edit')</a> </td>
                <td style="width: 0px;">
                 <form method="POST" action="{{ route('consults.destroy', $consult->id) }}">
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
