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
    $('#table-detail').on("click",".table-content",function(){
        selected_table_id=$(this).data("id");
        selected_table_name=$(this).data("name");
        $.get("/cashier/getSaleDetailsByTable/" +selected_table_id,function(data){
          $('#order-detail').html(data);
        });  
    });
