@extends('layouts/admin')

@section('content')
<main class="create">
  <div class="container">
    <form action="{{route('admin.projects.update', $project)}}" method="POST" enctype="multipart/form-data">
      @csrf

      {{-- inserisco il metodo PUT --}}
      @method('PUT')
  
    <div class="row mb-3">
      <label for="title">Title</label>
      <input class="form-control @error('title') is-invalid @enderror" type="text" id="title" name="title" value="{{old('title') ?? $project->title}}">
      {{-- espongo messaggio di errore --}}
      @error('title')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>
  
    <div class="row mb-3">
      <label for="content">Description</label>
      <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{{old('content') ?? $project->content}}</textarea>
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
      <input class="form-control @error('languages') is-invalid @enderror" type="text" id="languages" name="languages" value="{{old('languages') ?? $project->languages}}">

      @error('languages')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div> --}}

    {{-- tipologia --}}

    <div class="row mb-3">
      <label for="type_id">Type</label>
      <select name="type_id" class="form-select @error('type_id') is-invalid @enderror" type="text" id="type_id" value="{{old('type_id')}}">
        <option value="">None</option>
        @foreach($types as $type)
          <option value="{{$type->id}}" {{$type->id == old('type_id', $project->type_id) ? 'selected' : ''}}>{{$type->name}}</option>
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
          @if($errors->any())
            <input type="checkbox" id="tech-{{$tech->id}}" name="technologies[]" value="{{$tech->id}}" @checked(in_array($tech->id, old('technologies', [])))>
          @else
            <input type="checkbox" id="tech-{{$tech->id}}" name="technologies[]" value="{{$tech->id}}" @checked($project->technologies->contains($tech))>
          @endif
          <label for="tech-{{$tech->id}}">{{$tech->name}}</label>
        </div>
      @endforeach

      {{-- espongo messaggio di errore --}}
      @error('technologies')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror

    </div>
  
    <div class="row mb-3">
      <label for="repo">Repository</label>
      <input class="form-control @error('repo') is-invalid @enderror" type="text" id="repo" name="repo" value="{{old('repo') ?? $project->repo}}">
      {{-- espongo messaggio di errore --}}
      @error('repo')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="website">Website</label>
      <input class="form-control @error('website') is-invalid @enderror" type="text" id="website" name="website" value="{{old('website') ?? $project->website}}">
      {{-- espongo messaggio di errore --}}
      @error('website')
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
</main>
@endsection