@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 style="margin-top: 10px">certificates Admin page </h1>
        <a class="btn btn-success" href="{{route('certificates.create')}}">Add new Certificate </a>
        <table class="table" style="margin-top: 10px">
            <thead>
                <tr>
                    <th scope="col">Certificate</th>
                    <th scope="col">Control</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($certificates as $certificate)
                    <tr>
                        <td>
                            <img src="{{ asset('certificates/' . $certificate->name) }}" alt="" style="height: 216px;" >
                        </td>
                        <td>
                            <form method="POST" action="{{ route('certificates.destroy', $certificate->id) }}">
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
