@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class='col-sm-4'>
                <div class='list-group'>
                    <a href="/management/category" class='list-group-item list-group-item-action'>Category</a>
                    <a href="" class='list-group-item'>Manu</a>
                    <a href="" class='list-group-item'>Table</a>
                    <a href="" class='list-group-item'>User</a>

                </div>
            </div>
            
        <div class='col-sm-8'>Category
            <a href="/management/category/create" class='btn btn-success btn-sm float-right' >Create Category</a>
            <hr>
            @if(Session()->has('status'))
                {{Session()->get('status')}}
            @endif
        </div>
        </div>

    </div>


@endsection