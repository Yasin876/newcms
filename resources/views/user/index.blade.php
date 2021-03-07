@extends('layouts.app')


@section('content')

    <div class="card my-2">
        <table class="table">
            <th>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>User Name</th>
                    <th>Role</th>
                    <th></th>

                </tr>
            </th>

            <tbody>
            <?php $i = 0; ?>
            @foreach ($user as $user)
                <tr>
                    <td>{{++$i}}</td>
                    <td><img width="120px" height="80px"
                             src="{{Gravatar::src($user->email,['width'=>100,'height'=>400])}}" class="img-thumbnail">
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->role}}</td>
                    <td>
                        @if(!$user->isAdmin()) {{-- User model class'ında bulunan tüm fonksiyonları kullanabilirim --}}
                        <form action="{{route('users.update',$user->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <button type="submit" class="btn btn-primary btn-sm">Make Admin</button>
                        </form>
                        @endif
                    </td>

                </tr>
            @endforeach

            </tbody>

        </table>
    </div>

@endsection
