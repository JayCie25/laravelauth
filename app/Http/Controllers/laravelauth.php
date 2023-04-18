<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inventory_item;
use App\Models\post;
use App\Models\User;
use DB;

class laravelauth extends Controller
{
    function __construct(){
        $this->task = new inventory_item;
        $this->taskz = new post;
    }
    
    function firstpage(){
        $items = $this->task->getinventory_item();
        $items = inventory_item::all();
        $id = request('id');
        return view('firstpage', ['items' => $items], ['id' => $id], compact('items'), 'search.search');
    }

    function firstpage2(){
        $items = $this->task->getinventory_item();
        $items = inventory_item::all();
        $id = request('id');
        return view('firstpage2', ['items' => $items], ['id' => $id], compact('items'), 'search.search');
    }
    
    function secpage(){
        $items = $this->taskz->getpost();
        $items = post::all();
        $id = request('id');
        return view('posts', ['items' => $items], ['id' => $id], compact('items'));
    }
    
    function saveItem(Request $request){
        if($request->has('ipic')){
            $name = $request->file('ipic')->getClientOriginalName();
            $request->file('ipic')->move('imgs/', $name);
            $data=[
                'item_name' => $request->iname,
                'item_image' => $name,
                'item_quantity' => $request->iquantity,
                'item_price' => $request->iprice,
                'item_owner' => $request->item_owner
            ];
        }
        else{
            $data=[
                'item_name' => $request->iname,
                'item_quantity' => $request->iquantity,
                'item_price' => $request->iprice,
                'item_owner' => $request->item_owner
            ];
        }
        $this->task->saveItem($data);
        return redirect()->route('home')->with('msg', "Item added successfully!");
    }

    function savePost(Request $request){
            $data=[
                'post_user' => $request->post_user,
                'post_content' => $request->post_content
            ];
        $this->taskz->savePost($data);
        return redirect()->route('home2')->with('msg', "Posted successfully!");
    }
    
    function deleteItem($id){
        $this->task->deleteItem($id);
        return redirect()->route('home')->with('msgss', "Item deleted successfully!");
    }

    function deletePost($id){
        $this->taskz->deletePost($id);
        return redirect()->route('home2')->with('msgss', "Post deleted successfully!");
    }
    
    function updateItem($id){
        $task = $this->task->updateItem($id);
        return view('/firstpage', compact('task'));
    }
    
    function saveUpdate(Request $request){
        if($request->has('uipic')){
            $name = $request->file('uipic')->getClientOriginalName();
            $request->file('uipic')->move('imgs/', $name);
            $data=[
                'item_name' => $request->uiname,
                'item_image' => $name,
                'item_quantity' => $request->uiquantity,
                'item_price' => $request->uiprice
            ];
        }
        else{
            $data=[
                'item_name' => $request->uiname,
                'item_quantity' => $request->uiquantity,
                'item_price' => $request->uiprice
            ];
        }
        $this->task->saveUpdate($data, $request->id);
        return redirect()->route('home')->with('msgs', "Item editted successfully!");
    }
    
    function updatePost($id){
        $taskz = $this->taskz->updatePost($id);
        return view('/posts', compact('taskz'));
    }
    
    function saveUpdatePost(Request $request){
        $data=[
            'post_user' => $request->ipost_user,
            'post_content' => $request->ipost_content
        ];
        $this->taskz->saveUpdatePost($data, $request->id);
        return redirect()->route('home2')->with('msgs', "Item editted successfully!");
    }
    
    public function showEmployee(Request $request)
    {
        $employees = inventory_item::all();
        if($request->keyword != ''){
            $employees = inventory_item::where('item_name','LIKE','%'.$request->keyword.'%')->get();
        }
        return response()->json([
            'employees' => $employees
        ]);
    }

}
