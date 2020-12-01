<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Table;
use App\Category;
use App\Menu;

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
            '.$table->name.'</button>';
            $html .="</div>";
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
        return $request->menu_id;
    }
}
