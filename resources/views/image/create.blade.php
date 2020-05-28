@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-10 row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                Subir nueva foto para la barbería
              </div>
              <div class="card-body">
                <form action="{{route('user.save_img')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="image_path">Cargar imagen</label>
                    <div class="col-md-4">
                      <input id="image_path" type="file" name="image_path" class="form-control {{$errors->has('image_path') ? 'is-invalid' : ''}}" >
                      @if($errors->has('image_path'))
                        <span class="invalid-feeback" role="alert">
                          <strong>{{$errors->first('image_path')}}</strong>
                        </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <div class="col-md-2">
                        <input type="submit" class="btn btn-primary" value="Subir imagen">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
