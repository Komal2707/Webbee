<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    /**
     * Get the MenuItem that owns the MenuItem.
     */
    public function children()
    {
        return $this->hasMany(MenuItem::class,'parent_id','id')->with('children');
    }

}
