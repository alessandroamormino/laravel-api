@extends('layouts/admin')

@section('content')

<div class="main">
  <h1>All Projects made with: "{{$technology->name}}"</h1>

  @if(count($technology->projects) > 0)
    <table class="table table-dark">
      <thead>
        <th>Title</th>
        <th>Slug</th>
        <th>Details</th>
      </thead>
      <tbody>
        @foreach($technology->projects as $project)
          <tr>
            <td>{{$project->title}}</td>
            <td>{{$project->slug}}</td>
            <td>
              <a href="{{route('admin.projects.show', $project)}}"><i class="fa-solid fa-magnifying-glass"></i></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <em>No projects made with this technology</em>
  @endif

  <div class="button-section">
    
      {{-- Aggiungo un bottone per modificare il progetto --}}
      <button class="btn"><a href="{{route('admin.technologies.edit', $technology)}}">Edit Technology</a></button>
    
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTech">
        Delete Technology
      </button>
    
      <!-- Modal -->
      <div class="modal fade" id="deleteTech" tabindex="-1" aria-labelledby="deleteTechLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Technology</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete this technology? 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <form action="{{route('admin.technologies.destroy', $technology)}}" method="POST">
                @csrf
                @method('DELETE')
      
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>

  </div>

  <div class="mt-5">
    <a href="{{route('admin.technologies.index')}}">Go back to all technologies</a>
  </div>
  
</div>
@endsection