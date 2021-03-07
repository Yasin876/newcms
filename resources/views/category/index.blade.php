@extends('layouts.app')

@section('content')

    <a href="{{route('categories.create')}}" class="button btn btn-primary">Add Category</a>

    <div class="card my-2">
        <table class="table">
            <th>
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Related Post Count</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </th>

            <tbody>
            <?php $i = 0; ?>
            @foreach ($categories as $category)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$category->name}}</td>
                    <td>
                        {{$category->posts->count()}}
                    </td>
                    <td><a href="{{route('categories.edit',$category->id)}}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('categories.destroy',$category->id)}}" method="POST">
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

