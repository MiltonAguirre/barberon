<div class="container-avatar">
  @if(Auth::user()->image)
    <img src="{{route('user.avatar',['filename'=>Auth::user()->image])}}"class="avatar">
  @else
    <img src="/img/empty_pic.png" alt="">
  @endif
</div>
