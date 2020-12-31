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

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 class="show-totalAmount-modal"></h3>
        <div class="input-group mb-3">
             <h3>Received:</h3>
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            <input type="number" class="form-control received-amount" aria-label="Amount (to the nearest dollar)">
        </div>
        <h3 class="change-to-return">Change:</h3>
                <h3>Payment Method</h3>
                <select id="payment-method" class="form-control">
                <option class="pay-cash">Cash</option>
                <option class="pay-credit">Credit card</option>
                </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-payment">Save Payment</button>
      </div>
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

    //load menus by category
     $('.nav-link').click(function(){
        if($('#menu-list').is(":hidden")){
             $.get("/cashier/getMenuByCategory/" + $(this).data("id"),function(data){
             $("#menu-list").hide();   
             $("#menu-list").html(data);  
             $("#menu-list").fadeIn('fast');   
            });
        }
        else {
             $("#menu-list").slideUp('fast'); 
        } 
        
    });

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

        //show Sale Detail of each table

          //Method 1:
            /*
            $('#selected-table').html('<br> <h3>table: '+ selected_table_name + '</h3><hr>');
            $.ajax({
                    type:"POST",
                    data: {
                        "_token" : $('meta[name="csrf-token"]').attr('content'),
                        "table_id":selected_table_id,
                        "table_name":selected_table_name,
                    },
                    url:"/cashier/getSaleDetailsByTable/"+selected_table_id ,
                    success: function(data){
                        $('#order-detail').html(data);
                    }

                });
            */

         //method 2: need to change the route when applying methods
            /*
            $.ajax({
                    type:"POST",
                    data: {
                        "_token" : $('meta[name="csrf-token"]').attr('content'),
                        "table_id":selected_table_id,
                        "table_name":selected_table_name,
                    },
                    url:"/cashier/getSaleDetailsByTable" ,
                    success: function(data){
                        $('#order-detail').html(data);
                    }

            });
            */

        //method 3: use $.get()

        $.get("/cashier/getSaleDetailsByTable/" +selected_table_id,function(data){
                                  $('#order-detail').html(data);

        });
         
    });

    // add menus to a table and show SaleDetails
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

    //click confirm button
    $('#order-detail').on("click",".goConfirm",function(){
        var sale_id = $(this).data("id");
        $.ajax({
            type: 'post',
            data: {
                    "_token" : $('meta[name="csrf-token"]').attr('content'),
                    "sale_id":sale_id
                },
            url:"/cashier/confirmOrder",
            success: function(data){
                $('#order-detail').html(data);
            }


        });
    });
    // remove a menu from an order
    $('#order-detail').on('click','.remove-menu',function(){
        var saleDetail_id = $(this).data("id");
        var saleDetail_menu_id = $(this).data("menu");
        var sale_id = $(this).data("saleid");//there is no uppercase for declaring data in html
        $.ajax({
            type:'post',
            data: {
                "_token" : $('meta[name="csrf-token"]').attr('content'),
                "saleDetail_id":saleDetail_id,
                "saleDetail_menu_id":saleDetail_menu_id,
                "sale_id":sale_id,
                "quantity":1
            },
            url: "/cashier/removeMenu",
            success: function(data){
                $('#order-detail').html(data);
            }

        })
    });
    //show total amount after click 'go Payment'
    $('#order-detail').on('click','.goPay',function(){
        $('.received-amount').val('');
        $('.change-to-return').val('Change:');

        var totalAmount = $(this).data("totalamount");
        $('.show-totalAmount-modal').html('Total Amount: ' + totalAmount);

    });

    //calculate the change after receiving payment
    $('.received-amount').keyup(function(){
        var receivedAmount = $('.received-amount').val();
        var totalAmount = $('#order-detail .goPay').data("totalamount");
        var change = totalAmount - receivedAmount;
        $('.change-to-return').html("Change: " + change);

    });

    $('.modal-footer .btn-payment').click(function(){
        var totalAmount = $('#order-detail .goPay').data("totalamount");
        console.log(totalAmount ); //for checking, open Console from Browser

        var receivedAmount = $('.received-amount').val();
        console.log(receivedAmount ); // for checking
        var paymentMethod = $('#payment-method').find(":selected").text();

        var change = totalAmount - receivedAmount;

        var sale_id = $('#order-detail .goPay').data("id");
        console.log(sale_id ); 

        $.ajax({
            type:'post',
            data:{
                "_token" : $('meta[name="csrf-token"]').attr('content'),
                'total_received':receivedAmount,
                'payment_type':paymentMethod,
                'change':change,
                'sale_id':sale_id
            },
            url: "/cashier/updatePayment",
            success: function(){
                // Simulate a mouse click:
                window.location.href ='/cashier';
            }
        })
    });
});

</script>

@endsection
