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
            
        <div class='col-sm-8'> Create Category
            <hr>
            <form action="">
                <div class='form-group'>
                <label for="categoryName">Category Name</label>
                <input type="text" name="name" class="form-control" placeholder='Category...'>
                </div>
                <button type="submit">Save</button>
            </form>
        </div>
        </div>

    </div>


@endsection