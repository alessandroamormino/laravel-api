<div class="explorer">
  <h6>EXPLORER</h6>
  <div>
    <div class="drop">
      <i class="fa-solid fa-angle-down"></i>
      <span>Portfolio</span>
    </div>
    <div class="files">
      <div class="dashboard flex">
        <img src="{{Vite::asset('resources/img/json_icon.svg')}}" alt="" class="explorer-img">
        <a href="{{route('admin.dashboard.home')}}">dashboard</a>
      </div>
      <div class="projects flex">
        <img src="{{Vite::asset('resources/img/json_icon.svg')}}" alt="" class="explorer-img">
        <a href="{{route('admin.projects.index')}}">projects</a>
      </div>
      <div class="types flex">
        <img src="{{Vite::asset('resources/img/json_icon.svg')}}" alt="" class="explorer-img">
        <a href="{{route('admin.types.index')}}">types</a>
      </div>
      <div class="technologies flex">
        <img src="{{Vite::asset('resources/img/json_icon.svg')}}" alt="" class="explorer-img">
        <a href="{{route('admin.technologies.index')}}">technologies</a>
      </div>
    </div>
  </div>
</div>