<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventory_item extends Model
{
    use HasFactory;

    protected $fillable =['item_name', 'item_image', 'item_quantity', 'item_price', 'item_owner'];

    public function saveItem($data){
        return $this->create($data);
    }

    public function getinventory_item(){
        return $this->all();
    }

    public function deleteItem($id){
        $task = $this->find($id);
        $task->delete();
    }

    public function updateItem($id){
        return $this->find($id);
    }

    public function saveUpdate($data, $id){
        $task = $this->where('id', $id);
        $task->update($data);
    }
}
