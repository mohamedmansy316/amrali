@extends('layouts.app')
@section('content')
<div class="container">
    <h1 style="margin-top: 10px">All online Courses page </h1>
    <a class="btn btn-success" href="{{route('courses.create')}}">Add new Course </a>
    <table class="table table-striped"  style="margin-top: 10px">
        <thead>
          <tr>
            <th scope="col">Course name</th>
            <th scope="col">Online price</th>
            <th scope="col">Offline price</th>
            <th scope="col">Control</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
            <tr>
                <td> {{$course->course_name}} </td>
                <td  style="width: 100px"> {{$course->price_online}} </td>
                <td   style="width: 100px"> {{$course->price_offline}} </td>
               <td> <a class="btn btn-warning" href="{{route('courses.edit',$course->id)}}">@lang('auth.edit')</a> </td>
               <td>
                <form method="POST" action="{{ route('courses.destroy', $course->id) }}">
                  @csrf
                  @method('DELETE')
                <input type="submit" class="btn btn-danger" value="@lang('auth.delete')">
                </form>
            </td>

            </tr>

            @endforeach

        </tbody>
      </table>
    {{-- <form   >
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="margin-top: 20px;width:50%">
        <button class="btn btn-success" type="submit" style="margin-top: 10px; ">Search</button>
      </form> --}}


</div>
@endsection
