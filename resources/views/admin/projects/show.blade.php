@extends('layouts/admin')

@section('content')

<div class="main">
  <h1>Project: {{$project->title}}</h1>
  <hr>
  <div class="card-projects">
    <img src="{{asset('storage/' . $project->thumb)}}" alt="{{$project->title}} image">
    <div class="content">
      <h1>{{$project->title}}</h1>
      <h6>Type: {{$project->type?->name}}</h6>
      <hr>
      <p>{{$project->content}}</p>
      <div class="d-flex mt-2"> 
        @foreach($project->technologies as $tech)
          <span class="badge rounded-pill mx-1" style="border: 1px solid {{$tech->color}}">{{$tech->name}}</span>
        @endforeach
      </div>
      <div class="links">
        @if($project->repo)
          <a href="{{$project->repo}}" target="_blank">Source Code</a>
        @endif
        @if($project->website)
          <a href="{{$project->website}}" target="_blank">Website</a>
        @endif
      </div>
    </div>
  </div>

  {{-- Sezione bottoni --}}

  <div class="button-section">
    {{-- Aggiungo un bottone per modificare il progetto --}}
    <button class="btn btn-secondary"><a href="{{route('admin.projects.edit', $project)}}">Edit Project</a></button>
  
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProject">
      Delete Project
    </button>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="deleteProject" tabindex="-1" aria-labelledby="deleteProjectLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Project</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this project? 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form action="{{route('admin.projects.destroy', $project)}}" method="POST">
            @csrf
            @method('DELETE')
  
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-5">
    <a href="{{route('admin.projects.index')}}">Go back to all projects</a>
  </div>
  
</div>
@endsection