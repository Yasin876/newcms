@extends('layouts.app')

@section('content')

    <a href="{{route('tags.create')}}" class="button btn btn-primary" >Add Tag</a>

    <div class="card my-2">
        <table class="table">
            <th>
                <tr>
                    <th>#</th>
                    <th>Tag Name</th>
                    <th>Related Post Count</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </th>

            <tbody>
            <?php $i=0; ?>
            @foreach ($tags as $tag)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$tag->name}}</td>
                    <td>{{$tag->posts->count()}}</td>
                    <td> <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-primary btn-sm">Edit</a></td>
                    <td>
                        <form action="{{route('tags.destroy',$tag->id)}}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">Delete</button>

                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>

        </table>
    </div>

@endsection


