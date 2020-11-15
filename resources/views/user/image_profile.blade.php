@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-center">
        <div class="card">
          <div class="card-header color-secondary text-dark">
            Subir nueva foto de perfíl
          </div>
          <div class="card-body">
            <div class="image-container image-detail mb-3">
              @if($user->image)
                <img src="{{route('user.avatar',['filename'=>$user->image])}}" >
              @else
                <img src="/img/empty_pic.png" alt="">
              @endif
            </div>
            <form action="{{route('user.save_img')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group row justify-content-center my-4">
                <label class="col-3 col-form-label text-center" for="image_path">Cargar:</label>
                <div class="col-3 col-form-label">
                  <input class="file-input {{$errors->has('image_path') ? 'is-invalid' : ''}}"
                    id="image_path" type="file" name="image_path" required>
                  @if($errors->has('image_path'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{$errors->first('image_path')}}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                  <input
                    class="btn btn-primary btn-block"
                    type="submit" value="Subir imagen">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
