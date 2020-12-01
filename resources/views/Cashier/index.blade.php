@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="table-detail">
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-5">
            <button type="submit" class="btn btn-primary btn-block" id="btn-show-tables">Display tables</button>
            <div id="selected-table"></div>
            <div id="order-detail"></div>
        </div>
        <div class="col-sm-7">
                <nav class="nav nav-tabs" role='tablist' >
                @foreach($categories as $category)
                        <!-- embed category-id via data-id-->
                        <a class="nav-link nav-item" data-id="{{$category->id}}" data-toggle="tab">{{$category->name}}</a>
                @endforeach
                </nav>
                <div id="menu-list" class="row mt-2"></div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    //make tables hidden
    $('#table-detail').hide();

    //show tables

    $('#btn-show-tables').click(function(){
        if( $('#table-detail').is(":hidden"))
        {
            $.get("/cashier/getTable",function(data){
            $('#table-detail').html(data);
            $('#table-detail').slideDown('fast');
            $('#btn-show-tables').html('Hide tables')
             });
        }
        else 
        {
            $('#table-detail').slideUp('fast');
            $('#btn-show-tables').html('Display tables')
        }   
    });

    //load Menu by category-id
     $('.nav-link').click(function(){
        $.get("/cashier/getMenuByCategory/" + $(this).data("id"),function(data){
             $("#menu-list").hide();   
             $("#menu-list").html(data);  
             $("#menu-list").fadeIn('fast');   
 
        });
    });

    var selected_table_id="";
    var selected_table_name="";
    //show the name of table
    $('#table-detail').on("click",".table-content",function(){
        selected_table_id=$(this).data("id");
        selected_table_name=$(this).data("name");

        $('#selected-table').html('<br> <h3>table: '+ selected_table_name + '</h3><hr>');
    });

    // add menus to a table
    $('#menu-list').on("click",".btn-menu",function(){
        if(selected_table_id==""){
            alert('choose a table first');
        }
        else{
            var menu_id=$(this).data("id");
           // alert(selected_table_id);
            $.ajax({
                type:"POST",
                data: {
                    "_token" : $('meta[name="csrf-token"]').attr('content'),
                    "menu_id":menu_id,
                    "table_id":selected_table_id,
                    "table_name":selected_table_name,
                    "quantity":1
                },
                url:"/cashier/orderFood",
                success: function(data){
                    $('#order-detail').html(data);
                }

            });
        }
    });
});

</script>

@endsection
