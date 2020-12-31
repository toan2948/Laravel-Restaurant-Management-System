<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Table;
use App\Category;
use App\Menu;
use App\Sale;
use App\SaleDetail;
use Illuminate\Support\Facades\Auth;


class CashierController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('Cashier.index')->with('categories',$categories);
    }

    public function getTable(){
        $tables = Table::all();
        $html='';
        foreach($tables as $table){
             $html .='<div class="col-md-2 mb-4">
            <button class="btn btn-primary table-content" data-id="'.$table->id.'" data-name="'.$table->name.'">
            ';
            if($table->status =='unavailable'){
                $html .='<span class="badge badge-danger">';
            } else{
                $html .='<span class="badge badge-primary">';

            }
            $html .="$table->name</span></button></div>";   
        }
        return $html;
    }

    public function getMenuByCategory($category_id){

        $menus = Menu::where('category_id',$category_id)->get();
        $html='';

        foreach($menus as $menu){
            $html ='
                <div class ="col-me-3" text-canter>
                    <a class="btn btn-outline-secondary btn-menu" data-id="'.$menu->id.'">
                        <img class="img-fluid" src="'.url('/menu_images/'.$menu->image).'">
                        <br>
                        '.$menu->name.'
                        <br>
                        '.$menu->price.'
                    </a>
                </div>
            
            ';
        }
        return $html;
    }

    public function orderFood(Request $request){
        // used for video 42
        // return $request->menu_id;

        $table_id = $request->table_id;
        $table_name= $request->table_name;

        $sale =Sale::where('table_id',$table_id)->where('sale_status','unpaid')->first(); //retrieve a single row
            //get() mothod, in stead of first() method will show an inverse result
        if(!$sale){ //if $sale does not exist
            $sale =new Sale();
            $sale->table_id = $table_id;
            $sale->table_name=$table_name;
          /*Retrieving The Authenticated User
                 use Illuminate\Support\Facades\Auth;

                Get the currently authenticated user...
                $user = Auth::user();

                Get the currently authenticated user's ID...
                $id = Auth::id();
            */
            $user = Auth::user();

            $sale->user_id = $user->id;
            $sale->user_name = $user->name;
            $sale->save();
            $sale_id=$sale->id;

            //update the status of the table
            $table =Table::find($table_id);
            $table->status = "unavailable";
            $table->save();
        }
        else {
            $sale_id=$sale->id;
        }
        //add/update SaleDetail
        $saleDetail = new SaleDetail();
        $saleDetail->sale_id=$sale_id;
        $saleDetail->menu_id = $request->menu_id;

        $menu = Menu::find($request->menu_id);
        $saleDetail->menu_name = $menu->name;
        $saleDetail->menu_price = $menu->price;
        $saleDetail->quantity = $request->quantity;
        $saleDetail->save();

        $sale->total_price = $sale->total_price + ($menu->price * $request->quantity);
      //  return $sale->total_price;
        $sale->save();

       $html = $this->getSaleDetail($sale_id);
        return $html;
    }

    //show sale detail of each table
        //Method 1:
        /*
        public function getSaleDetailsByTable($table_id){
        //Method2:  $sale = Sale::where('table_id',$request->table_id)->where('sale_status','unpaid')->first();
        $sale = Sale::where('table_id',$table_id)->where('sale_status','unpaid')->first();

        $html ='';
            if($sale){
                $html = $this->getSaleDetail($sale->id);

            } else{
                $html =' found no sale';
            }
            return $html;
        }
        */

    //Method 3: 
    public function getSaleDetailsByTable($table_id){
        $sale = Sale::where('table_id',$table_id)->where('sale_status','unpaid')->first();
 
        $html ='';
         if($sale){
             $html = $this->getSaleDetail($sale->id);
 
         } else{
             $html =' found no sale';
         }
         return $html;
     }


    private function getSaleDetail($sale_id){

        $html ='Sale_ID: '.$sale_id;
        $html .='
            <table class="table table-responsive table-bordered table-hover" style="overflow-x:hidden overflow-y:scroll">
                <tr>
                    <td>Menu_ID</td>
                    <td>Menu_name</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total_Price</td>
                    <td>Status</td>
                    <td>Remove</td>

                </tr>
            ';
            
            $saleDetail_list = SaleDetail::where('sale_id',$sale_id)->get();
            //variable to check if all orders are confirmed
            $confirmed =true;
            foreach($saleDetail_list as $saleDetail){
                $html .='
                <tr>
                    <td>'.$saleDetail->menu_id.'</td>
                    <td>'.$saleDetail->menu_name.'</td>
                    <td>'.$saleDetail->menu_price.'</td>
                    <td>'.$saleDetail->quantity.'</td>
                    <td>'.($saleDetail->menu_price * $saleDetail->quantity).'</td>
                    <td>'.$saleDetail->status.'</td>
                    <td> 
                        <a class="btn btn-block btn-danger remove-menu" data-id="'.$saleDetail->id.'" 
                        data-menu="'.$saleDetail->menu_id.'" data-saleID="'.$sale_id.'">Remove</a>
                    </td>
                </tr>
                ';
                if($saleDetail->status =='noConfirm'){
                    $confirmed = false;
                }
            }

        $html .=' </table> ';
        $sale =Sale::find($sale_id);
        $html .= '<h5> total Price: '.$sale->total_price.'</h5>';
        
        if($confirmed==false){
            $html .='<br>
            <button type="button" class="btn btn-block btn-warning goConfirm" data-id="'.$sale_id.'"> Confirm Order </button>
            ';
        } else {
            $html .='<br>
            <button type="button" data-toggle="modal" data-target="#exampleModal" data-totalAmount ="'.$sale->total_price.'" class="btn btn-block btn-danger goPay" data-id="'.$sale_id.'" >  Go Payment </button>
            ';
        }
       
        return $html;
    }
    public function confirmOrder(Request $request){
        $sale_id = $request->sale_id;
       /*  $saleDetail_list = SaleDetail::where('sale_id',$sale_id)->get();
        foreach($saleDetail_list as $saleDetail){
            $saleDetail->status='confirmed';
            $saleDetail->save();
        } */

        $saleDetail_list = SaleDetail::where('sale_id',$sale_id)->update(['status'=>'confirmed']);

        $html = $this->getSaleDetail($sale_id);
        return $html;

    }

    public function removeMenu(Request $request){
        $sale_id =$request->sale_id;
        $quantity =$request->quantity;
       // echo $quantity;
        $saleDetail_id = $request->saleDetail_id;
        $saleDetail_menu_id=$request->saleDetail_menu_id;

        $saleDetail = SaleDetail::find($saleDetail_id);
        $sale = Sale::find($sale_id);
         $sub = $saleDetail->menu_price * $request->quantity;
        $sale->total_price = $sale->total_price- $sub;
        $sale->save(); 
        $saleDetail->delete();

        $html = $this->getSaleDetail($sale_id);
        return $html;
    }

    public function updatePayment(Request $request){
        $sale_id = $request->sale_id;
        $sale=Sale::find($sale_id);
        $sale->total_received = $request->total_received;
        $sale->change = $request->change;
        $sale->payment_type= $request->payment_type;
        $sale->sale_status = 'paid';
        $table = Table::find($sale->table_id);
        $table->status ='available';
        $sale->save();
        $table->save();

    }
}
