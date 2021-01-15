@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
          @include('management.inc.sidebar') 
            
        <div class='col-sm-8'>Menu
            <a href="/management/menu/create" class='btn btn-success btn-sm float-right' >Create Menu</a>
            <hr>
            @if(Session()->has('status'))
                {{Session()->get('status')}}
            @endif
            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>Name</th>
                        <th scope='col'>Price</th>
                        <th scope='col'>Image</th>
                        <th scope='col'>Desc</th>
                        <th scope='col'>Category</th>
                        <th scope='col'>Edit</th>
                        <th scope='col'>Delete</th>
                    </tr>
                </thead>
                <tbody>
                 @foreach($menus as $menu)
                 <tr>
                        <th scope='row'>{{$menu->id}}</th>
                        <td>{{$menu->name}}</td>
                        <td>{{$menu->price}}</td>
                        <td> <img src="{{asset('menu_images')}}/{{$menu->image}}" alt="{{$menu->name}}" width="120px" height="100px"></td>
                        <td>{{$menu->desc}}</td>
                        <td>{{$menu->category->name}}</td>
                            <!-- display the name of a category instead of the id -->
                        <td>
                        <a href="/management/menu/{{$menu->id}}/edit" class='btn btn-warning'>Edit</a>
                        </td>
                        <td>
                        <form action="/management/menu/{{$menu->id}}" method="post">
                            @csrf
                            @method('DELETE')
                        <button type="submit" class='btn btn-danger btn-sm'>Delete</button>
                        </form>
                        </td>
                    </tr>
                 @endforeach
                </tbody>
            </table>
            {{$menus->links()}}
        </div>
        </div>

    </div>


@endsection