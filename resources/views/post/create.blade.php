@extends('layouts.app')

@section('content')
    <h3>{{isset($postEdit)?'Edit Post':'Create Post'}}</h3>
    <div class="card bg-light p-2">
        <form action="{{isset($postEdit) ? route('posts.update',$postEdit->id) : route('posts.store')}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            @if(isset($postEdit))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control"
                       value="{{isset($postEdit) ? $postEdit->title : ''}}">
            </div>
            <div class="form-group">
                <label for="post_content">Content:</label>
                <textarea class="form-control" name="post_content"
                          id="post_content"> {{isset($postEdit) ? $postEdit->post_content : ''}} </textarea>
            </div>
            <div class="form-group">
                <label for="published_at">Published At:</label>
                <input type="text" class="form-control" name="published_at" id="published_at"
                       value="{{isset($postEdit) ? $postEdit->published_at : ''}}">
            </div>
            <div class="form-group">
                <label for="category">Choose Category:</label>
                <select class="form-control" id="category" name="category">
                    @foreach($categoryItems as $categoryItem)
                        <option value="{{$categoryItem->id}}"
                                @if(isset($postEdit))
                                @if($categoryItem->id == $postEdit->category_id)
                                selected
                            @endif
                            @endif
                        >{{$categoryItem->name}}</option>
                    @endforeach
                </select>
            </div>
            <!-- tag section -->
            <div class="form-group">
                <label for="tags">Choose Tag:</label>
                <select name="tags[]" id="tags" class="form-control" multiple>
                    @foreach($tagItems as $tagItem)
                        <option value="{{$tagItem->id}}"
                                @if(isset($postEdit)) {{-- bu sayfada aynı zamanda edit islemleri yapiliyor --}}
                                  @if(in_array($tagItem->id,  $postEdit->tags->pluck('id')->toArray()));
                                {{-- pluck dönen dizi icerisinden belli bir özlleiği almaya yarar --}}
                                    selected
                                  @endif
                                @endif
                        >
                            {{$tagItem->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- tag section end -->
            <div class="form-group">
                @if(isset($postEdit))
                    <img width="125px" height="100px" src="{{asset('storage/'.$postEdit->image_path)}}" alt="">
                @endif
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" class="form-control">
                </div>
                <button class="btn btn-primary" type="submit">{{isset($postEdit)?'Save Changes':'Add Post'}}</button>
                <a href="{{route('posts.index')}}" class="btn btn-dark  float-right">Cancel</a>
        </form>
    </div>
@endsection

@section('styles')
    <!-- flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#published_at', {
            enableTime: true
        })
    </script>
@endsection
