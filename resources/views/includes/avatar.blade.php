@if(Auth::user()->image)
  <div class="container-avatar">
    <img src="{{route('user.avatar',['filename'=>Auth::user()->image->image_path])}}"class="avatar">
  </div>
@endif
