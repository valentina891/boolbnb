@extends('layouts.app')

@section('title', 'Crea un nuovo appartamento')
@section('content')
<div class="container apartment-create col-md-8">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h2>Diventa un Host - Aggiungi un nuovo appartamento</h2>
<form id="myForm" class="create-page-form" action="{{route('apartments.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')



  <div class="form-group">
    <label for="title">Titolo</label>
    <input required name="title" type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Inserisci titolo appartamento" value="{{old('title')}}">
  </div>
  <div class="form-group">
    <label for="rooms">Camere</label>
    <input min="0" oninput="validity.valid||(value='');" required name="rooms" type="number" class="form-control number-check" id="rooms" placeholder="Numero camere" value="{{old('rooms')}}">
  </div>
  <div class="form-group">
    <label for="beds">Letti</label>
    <input min="1" oninput="validity.valid||(value='');" required name="beds" type="number" class="form-control number-check" id="beds" placeholder="Numero letti" value="{{old('beds')}}">
  </div>
  <div class="form-group">
    <label for="bathrooms">Bagni</label>
    <input min="1" oninput="validity.valid||(value='');" required name="bathrooms" type="number" class="form-control number-check" id="bathrooms" placeholder="Numero bagni" value="{{old('bathrooms')}}">
  </div>
  <div class="form-group">
    <label for="square_meters">Dimensione</label>
    <input min="0" oninput="validity.valid||(value='');" required name="square_meters" type="number" class="form-control number-check" id="square_meters" placeholder="Metri quadrati" value="{{old('square_meters')}}">
  </div>
  <div class="form-group">
    <label for="description">Descrizione</label>
    <textarea required name="description" class="form-control" id="description" placeholder="Descrizione" rows="3">{{old('description')}}</textarea>
  </div>
  <div class="form-group">
    <label for="city">Città</label>
    <input required name="city" class="form-control" id="city" placeholder="Città" value="{{old('city')}}">
  </div>
  <div class="form-group">
    <input name="latitude" hidden class="form-control" id="latitude" placeholder="Latitudine" value="{{old('latitude')}}">
  </div>
  <div class="form-group">
    <input name="longitude" hidden class="form-control" id="longitude" placeholder="Longitudine" value="{{old('longitude')}}">
  </div>
  <div class="form-group">
    <label for="image">Foto</label>
    <input required type="file" class="form-control-file" id="image" name="image" accept="image/*">
  </div>
  <div class="form-group">
      {{-- MODIFICA "disponibile?" --}}
    <label for="available">Disponibile?</label>
    <input name="available" type="checkbox" id="available" name="available"
        {{old('available') ? 'checked' : ''}}>
  </div>

{{-- Inserimento categoria --}}
    <div class="form-group">
        <label for="category_id">Categoria</label>
        <select name="category_id" id="category_id">

            @foreach ($categories as $category)
                @if ($errors->any())
                    @if ($category->id != old('category_id'))
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @else
                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                    @endif
                @else
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endif
            @endforeach
        </select>
    </div>

{{-- Inserimento servizi --}}
    <div class="form-group">
        @foreach ($services as $service)
            <label class="service" for="{{$service->name}}">{{$service->name}} <input  type="checkbox" name="services[{{$service->id}}]" value="{{$service->id}}" id="{{$service->name}}"
              @if (is_array(old('services')) && in_array($service->id, array_keys(old('services'))))
                checked
              @endif></label>

        @endforeach
    </div>
    <div id="error" style="display: none" class="alert alert-danger">
        <ul>
          <li>Inserire una città valida</li>
        </ul>
</div>
  <button id="myButton" type="button" class="btn bool-btn-pink">Salva</button>
  {{-- <button type="submit" class="btn bool-btn-pink">Salva</button> --}}
</form>
</div>
@endsection


@section('script')
  <script src="{{asset('js/getCoordinates.js')}}"></script>
@endsection
