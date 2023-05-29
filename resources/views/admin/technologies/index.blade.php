@extends('layouts/admin')

@section('content')

<h3>All Technologies</h3>

<table class="table table-dark table-hover">
  <thead>
    <th>Name</th>
    <th>Color</th>
    <th>Slug</th>
    <th>N. Projects</th>
    <th>Details</th>
  </thead>

  <tbody>

    @foreach($technologies as $tech)
    <tr>
      <td class="colored">{{$tech->name}}</td>
      <td>
        <span style="background-color: {{$tech->color}}; padding: .2em; border-radius: 5px;">{{$tech->color}}</span>
      </td>
      <td>{{$tech->slug}}</td>
      <td>{{count($tech->projects)}}</td>
      <td class="colored"><a href="{{route('admin.technologies.show', $tech)}}"><i class="fa-solid fa-magnifying-glass"></i></a></td>
    </tr>
    @endforeach


  </tbody>
</table>

<button class="btn">
  <a href="{{route('admin.technologies.create')}}">Add Technology</a>
</button>

@endsection