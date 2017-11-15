<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    public function parent(){
        return $this->belongsTo(Menu::class);
    }
}
