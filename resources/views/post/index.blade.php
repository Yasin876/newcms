@extends('layouts.app')

@section('content')
    <a href="{{route('posts.create')}}" class="button btn btn-primary">Add Post</a>
    <div class="card my-2">
        <table class="table">
            <th>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Post Title</th>
                    <th>Edit</th>
                    <th>Trash</th>
                </tr>
            </th>

            <tbody>
            <?php $i = 0; ?>
            @foreach ($posts as $post)
                <tr>
                    <td>{{++$i}}</td>
                    <td><img width="120px" height="80px" src="{{asset('storage/'.$post->image_path)}}"  class="img-thumbnail">
                    </td>
                    <td>{{$post->title}}</td>
                    <td>
                        <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button  class="btn btn-danger btn-sm">Trash</button>
                        </form>
                    </td>

                </tr>
            @endforeach

            </tbody>

        </table>
    </div>

@endsection



