@extends('layouts.app')

@section('content')
    <h3>Trashed</h3>
    <div class="card my-2">
        <table class="table">
            <th>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Post Title</th>
                    <th>Restore</th>
                    <th>Delete</th>
                </tr>
            </th>

            <tbody>
            <?php $i = 0; ?>
            @foreach ($trashedPost as $trashedPost)

                <tr>
                    <td>{{++$i}}</td>
                    <td><img width="120px" height="80px" src="{{asset('storage/'.$trashedPost->image_path)}}"  class="img-thumbnail">
                    </td>
                    <td>{{$trashedPost->title}}</td>
                    <td>
                        <form action="{{route('posts.restore',$trashedPost->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary btn-sm">Restore</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{route('posts.destroy',$trashedPost->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button  class="btn btn-danger btn-sm">Permanently Delete</button>
                        </form>
                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>
    </div>

@endsection




