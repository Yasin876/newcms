@extends('layouts.app')

@section('content')

    <form action="{{isset($categoryEdit) ? route('categories.update',$categoryEdit->id) : route('categories.store')}}" method="POST" class="form-group">
        @csrf
        @if(isset($categoryEdit))
            @method('PUT')
        @endif
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" id="name" value="{{isset($categoryEdit) ? $categoryEdit->name : ''}}">
        <button type="submit" class="btn btn-primary my-1">{{isset($categoryEdit) ? 'Update' : 'Add'}} </button>
    </form>

@endsection

