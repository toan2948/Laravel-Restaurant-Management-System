<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Menu;
use App\Category;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $menus = Menu::paginate(3);
        return view('management.menu')->with('menus',$menus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('management.createMenu')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:menus|max:255',
            'price'=>'required|numeric',
            'category_id'=>'required|numeric'
        ]);

        $imageName='Noimage.png';
        if($request->image){
            $request->validate([
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:10000'
            ]);

            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('menu_images'), $imageName); 
            //after this, muss creating a folder called 'menu_images' in /public
        }
        

        $menu = new Menu;

        $menu->name = $request->name;
        $menu->image = $imageName; //not $request->image
        $menu->price = $request->price;
        $menu->desc = $request->desc;
        $menu->category_id = $request->category_id;
        $menu->save();
        $request->session()->flash('status',$request->name.' is saved');
        return(redirect('/management/menu'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=Category::all();

        $menu = Menu::find($id);
        return view('management.editMenu')->with('menu',$menu)->with('categories',$categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name'=>'required|max:255', // remove 'unique' from this line
            'price'=>'required|numeric',
            'category_id'=>'required|numeric'
        ]);
        $menu = Menu::find($id);

      /*  if($request->image){
            $request->validate([
                'image' => 'nullable'
            ]);
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('menu_images'), $imageName); 
        } else{
            $imageName = $menu->image;
        }
*/
        $menu->name = $request->name;
       // $menu->image = $imageName; //not $request->image
        $menu->price = $request->price;
        $menu->desc = $request->desc;
        $menu->category_id = $request->category_id;
        $menu->save();
        $request->session()->flash('status',$request->name.' is saved');
        return(redirect('/management/menu'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::destroy($id);
        session()->flash('status','the menu '.$id. ' is deleted');
        return(redirect('/management/menu'));

        // other method:
        /*$menu = Menu::find($id);
        $menu->delete();
        session()->flash('status','the menu '.$id. ' is deleted');
        return(redirect('/management/category'));
*/
    }
}
