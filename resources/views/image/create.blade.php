@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-10 row">
          <div class="col-md-8">
            <div class="card border-info">
              <div class="card-header bg-info">
                Subir nueva foto para la barbería
              </div>
              <div class="card-body">
                <form action="{{route('image.save')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group row justify-content-center my-4">
                    <label class="col-4 form-control col-form-label text-center" for="image_path">Agregar una foto:</label>
                    <div class="col-7 mt-1">
                      <input class="{{$errors->has('image_path') ? 'is-invalid' : ''}}"
                          type="file" name="image_path" required>
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
