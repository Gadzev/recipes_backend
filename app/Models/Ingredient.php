<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{

    protected $fillable = [ 'name', 'quantity', 'recipe_id' ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
