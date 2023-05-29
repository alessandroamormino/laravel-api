@extends('layouts/admin')

@section('content')
<h1>Administration page</h1>
<hr>

<div class="_container">
  <a href="{{route('admin.projects.index')}}" class="card-section">
      <div class="_card">
          <h3>Projects</h3>
          <img src="{{Vite::asset('resources/img/projects.png')}}" alt="Projects">
          <div class="text">
              This section shows all the projects on the website.
              <br>
              <br>
              Click on the card for the management.
          </div>
      </div>
  </a>
  <a href="{{route('admin.types.index')}}" class="card-section">
      <div class="_card">
          <h3>Types</h3>
          <img src="{{Vite::asset('resources/img/types.png')}}" alt="Types">
          <div class="text">
              This section shows all the types of projects on the website.
              <br>
              <br>
              Click on the card for the management.
          </div>
      </div>
  </a>
  <a href="{{route('admin.technologies.index')}}" class="card-section">
    <div class="_card">
        <h3>Technologies</h3>
        <img src="{{Vite::asset('resources/img/tech.png')}}" alt="Tech">
        <div class="text">
            This section shows all the technologies used in the projects.
            <br>
            <br>
            Click on the card for the management.
        </div>
    </div>
  </a>
</div>
@endsection