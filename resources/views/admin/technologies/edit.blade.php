@extends('layouts/admin')

@section('content')
<h3>Edit Technology</h3>
<div class="container p-5">
  <form action="{{route('admin.technologies.update', $technology)}}" method="POST">
    @csrf

    {{-- inserisco il metodo PUT --}}
    @method('PUT')
  
    <div class="row mb-3">
      <label for="name">Name</label>
      <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{old('name') ?? $technology->name}}">
      {{-- espongo messaggio di errore --}}
      @error('name')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="row col-1 mb-3">
      <label for="color">Color</label>
      <input class="form-control @error('color') is-invalid @enderror" type="color" id="color" name="color" value="{{old('color') ?? $technology->color}}">
      {{-- espongo messaggio di errore --}}
      @error('color')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>
  
    <div class="button-section mt-5">
      <button class="btn btn-secondary" type="submit">Save changes</button>
    </div>
  </form>

</div>

@endsection