@extends('layouts/admin')

@section('content')

<h3>Tutti i progetti</h3>

<table class="table table-dark table-hover">
  <thead>
    <th>Title</th>
    <th>Description</th>
    <th>Slug</th>
    <th>Thumbnail</th>
    <th>Type</th>
    <th>Technology</th>
    <th>Repo</th>
    <th>Website</th>
    <th>Details</th>
  </thead>

  <tbody>

    @foreach($projects as $project)
    <tr>
      <td class="colored">{{$project->title}}</td>
      <td>{{$project->content}}</td>
      <td>{{$project->slug}}</td>
      <td>{{$project->thumb}}</td>
      <td>{{$project->type?->name}}</td>
      <td>
        @php
          $techNames = [];
          foreach($project->technologies as $tech){
            $techNames[] = $tech->name;
          }
          echo implode(', ', $techNames);
        @endphp
      </td>
      <td>{{$project->repo}}</td>
      <td>{{$project->website}}</td>
      <td class="colored"><a href="{{route('admin.projects.show', $project->slug)}}"><i class="fa-solid fa-magnifying-glass"></i></a></td>
    </tr>
    @endforeach


  </tbody>
</table>

<button class="btn">
  <a href="{{route('admin.projects.create')}}">Aggiungi Progetto</a>
</button>

@endsection