<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    protected $fillable =['post_user', 'post_content'];

    public function savePost($data){
        return $this->create($data);
    }

    public function getpost(){
        return $this->all();
    }

    public function deletePost($id){
        $taskz = $this->find($id);
        $taskz->delete();
    }
    
    public function updatePost($id){
        return $this->find($id);
    }

    public function saveUpdatePost($data, $id){
        $taskz = $this->where('id', $id);
        $taskz->update($data);
    }

}
