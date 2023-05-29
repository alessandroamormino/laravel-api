@extends('layouts/admin')

@section('content')
<h3>Add new Project</h3>
<div class="container p-5">
  <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
  
    <div class="row mb-3">
      <label for="title">Title</label>
      <input class="form-control @error('title') is-invalid @enderror" type="text" id="title" name="title" value="{{old('title')}}">
      {{-- espongo messaggio di errore --}}
      @error('title')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>
  
    <div class="row mb-3">
      <label for="content">Description</label>
      <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{{old('content')}}</textarea>
      @error('content')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>
  
    <div class="row mb-3">
      <label for="thumb">Thumbnail</label>
      <input class="form-control @error('thumb') is-invalid @enderror" type="file" id="thumb" name="thumb">
      {{-- espongo messaggio di errore --}}
      @error('thumb')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>
  
    {{-- <div class="row mb-3">
      <label for="languages">Linguaggi</label>
      <input class="form-control @error('languages') is-invalid @enderror" type="text" id="languages" name="languages" value="{{old('languages')}}">

      @error('languages')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div> --}}

    {{-- tipologia di progetto --}}

    <div class="row mb-3">
      <label for="type_id">Type</label>
      <select name="type_id" class="form-select @error('type_id') is-invalid @enderror" type="text" id="type_id" value="{{old('type_id')}}">
        <option value="">None</option>
        @foreach($types as $type)
          <option value="{{$type->id}}" {{$type->id == old('type_id') ? 'selected' : ''}}>{{$type->name}}</option>
        @endforeach
      </select>
      {{-- espongo messaggio di errore --}}
      @error('type_id')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    {{-- tecnologie utilizzate --}}
    <div class="row mb-3 form-group">
      <h6>Technologies</h6>

      @foreach($technologies as $tech)
        <div class="form-check">
          <input type="checkbox" id="tech-{{$tech->id}}" name="technologies[]" value="{{$tech->id}}" @checked(in_array($tech->id, old('technologies', [])))>
          <label for="tech-{{$tech->id}}">{{$tech->name}}</label>
        </div>
      @endforeach

    </div>
  
    <div class="row mb-3">
      <label for="repo">Repository</label>
      <input class="form-control @error('repo') is-invalid @enderror" type="text" id="repo" name="repo" value="{{old('repo')}}">
      {{-- espongo messaggio di errore --}}
      @error('repo')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="website">Website</label>
      <input class="form-control @error('website') is-invalid @enderror" type="text" id="website" name="website" value="{{old('website')}}">
      {{-- espongo messaggio di errore --}}
      @error('website')
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