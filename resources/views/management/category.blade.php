@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
          @include('management.inc.sidebar') 
            
            <div class='col-sm-8'>Category
                <a href="/management/category/create" class='btn btn-success btn-sm float-right' >Create Category</a>
                <hr>
                @if(Session()->has('status'))
                    {{Session()->get('status')}}
                @endif
                <table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th scope='col'>ID</th>
                            <th scope='col'>Category</th>
                            <th scope='col'>Edit</th>
                            <th scope='col'>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                    <tr>
                            <th scope='row'>{{$category->id}}</th>
                            <td>{{$category->name}}</td>
                            <td>
                                <a href="/management/category/{{$category->id}}/edit" class='btn btn-warning'>Edit</a>
                            </td>
                            <td>
                                <form action="/management/category/{{$category->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class='btn btn-danger btn-sm'>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>

    </div>

@endsection