<nav class="navbar navbar-expand-lg navbar-light bg-light">
  

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{url('/home')}}">dashboard </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" target="_blank" href="{{url('/')}}">Trang Chủ <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('slider.index')}}">Slider</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('category.index')}}">Danh mục game</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('accessories.index')}}">Phụ kiện</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('nick.index')}}">Nick game</a>
      </li>
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>