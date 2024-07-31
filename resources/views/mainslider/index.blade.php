@extends('layouts.app')
@section('content')
{{-- {{$sessions}} --}}
<div class="container">
    <h1 style="margin-top: 10px"> {{$page}} </h1>
    <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#addsModal">
        {{ 'اضافة' }}
    </button>

    <!-- adds companies Modal -->
    <div class="modal fade" id="addsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ 'اضافة صورة' }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('mainslider.store')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="{{$type}}">
                    <div class="form-group mt-2">
                        <label for="exampleInputEmail1">الصورة  </label>
                        <input type="file" class="form-control mt-2" id="exampleInputPassword1" name="image" required>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">{{ 'اغلاق' }}</button>
                <button type="submit" class="btn btn-success">{{ 'حفظ' }}
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

    <table class="table" style="margin-top: 10px">
        <thead>
          <tr>
            <th scope="col">الصورة</th>
            <th scope="col"> تحكم</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $slider )
            <tr>
                <td ><img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="" style="height: 216px;max-width:100%" > </td>
                <td style="width: 0px;">
                    <form method="POST" action="{{ route('mainslider.destroy', $slider->id) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="@lang('auth.delete')">
                    </form>
                </td>
            </tr>
            {{-- <tr>
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
              </tr> --}}

            @endforeach

        </tbody>
      </table>
</div>
@endsection

