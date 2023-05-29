@extends('layouts/admin')

@section('content')
<h3>Add Type</h3>
<div class="container p-5">
  <form action="{{route('admin.types.store')}}" method="POST">
    @csrf
  
    <div class="row mb-3">
      <label for="name">Name Type</label>
      <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{old('name')}}">
      {{-- espongo messaggio di errore --}}
      @error('name')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>
  
    <div class="row mb-3">
      <label for="description">Description</label>
      <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{old('description')}}</textarea>
      @error('description')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>
  
    <div class="button-section mt-5">
      <button class="btn btn-secondary" type="submit">Add!</button>
    </div>
  </form>

</div>

@endsection