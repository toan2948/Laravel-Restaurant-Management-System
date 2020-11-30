@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
          @include('management.inc.sidebar') 
            
        <div class='col-sm-8'>Menu
            <a href="/management/table/create" class='btn btn-success btn-sm float-right' >Create Table</a>
            <hr>
            @if(Session()->has('status'))
                {{Session()->get('status')}}
            @endif
            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>Table</th>
                        <th scope='col'>Status</th>
                        <th scope='col'>Edit</th>
                        <th scope='col'>Delete</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($tables as $table)

                <tr>
                    <th>{{$table->id}} </th>
                    <th>{{$table->name}} </th>
                    <th>{{$table->status}} </th>
                    <th>
                        <a href="/management/table/{{$table->id}}/edit" class='btn btn-warning'>Edit</a>
                    </th>
                    <td>
                        <form action="/management/table/{{$table->id}}" method='post'>
                        @csrf
                        @method('DELETE')
                            <input type="submit" class='btn btn-danger' value='delete'>
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