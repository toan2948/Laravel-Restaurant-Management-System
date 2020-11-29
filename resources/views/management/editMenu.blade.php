@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
        @include('management.inc.sidebar')         
        <div class='col-sm-8'> Edit Menu
            <hr>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        
            <form action="/management/menu/{{$menu->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class='form-group'>
                    <label for="menuName">Menu Name</label>
                    <input type="text" name="name" class="form-control" value ="{{$menu->name}}">
                </div>

                <label for="menuPrice">Menu Price</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                    </div>
                    <input type="text" name="price" value ="{{$menu->price}}"  class="form-control" aria-label="Amount (to the nearest dollar)">
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                </div>

                <label for="menuImage">Image</label>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                     </div>
                     <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="inputGroupFile1" >
                        <label class="custom-file-label" for="inputGroupFile1">Choose file...</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Description">Description</label>
                    <input type="text" name="desc" value ="{{$menu->desc}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="Description">CategoryID</label>
                    <select name="category_id" class="form-control">
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}"  {{$menu->category_id===$category->id ? 'selected' :''}}> {{$category->name}}   
                    </option>
                        
                    @endforeach
                    </select>
                </div>

                <button type="submit" class='btn btn-primary btn-sm'>Update</button>
            </form>
        </div>
        </div>

    </div>


@endsection