@extends('layouts/admin')

@section('content')

<h3>Typologies</h3>

<table class="table table-dark table-hover">
  <thead>
    <th>Name</th>
    <th>Slug</th>
    <th>Description</th>
    <th>N. Projects</th>
    <th>Details</th>
  </thead>

  <tbody>

    @foreach($types as $type)
    <tr>
      <td class="colored">{{$type->name}}</td>
      <td>{{$type->slug}}</td>
      <td>{{$type->description}}</td>
      <td>{{count($type->projects)}}</td>
      <td class="colored"><a href="{{route('admin.types.show', $type->slug)}}"><i class="fa-solid fa-magnifying-glass"></i></a></td>
    </tr>
    @endforeach


  </tbody>
</table>

<button class="btn">
  <a href="{{route('admin.types.create')}}">Add Typology</a>
</button>

@endsection