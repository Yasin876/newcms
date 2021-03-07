@extends('layouts.app')

@section('content')

    <form action="{{isset($tagEdit) ? route('tags.update',$tagEdit->id) : route('tags.store')}}" method="POST" class="form-group">
        @csrf
        @if(isset($tagEdit))
            @method('PUT')
        @endif
        <label for="name"> Tag Name:</label>
        <input type="text" class="form-control" name="name" id="name" value="{{isset($tagEdit) ? $tagEdit->name : ''}}">
        <button type="submit" class="btn btn-primary my-1"> {{isset($tagEdit) ? 'Update' : 'Add'}} </button>
        <a href="{{route('tags.index')}}" class="btn btn-dark float-right my-1">Cancel</a>
    </form>

@endsection


