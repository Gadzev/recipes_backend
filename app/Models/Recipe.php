<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [ 'name', 'source', 'preparation', 'instructions' ];
    protected $with = [ 'ingredients' ];

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    protected static function boot()
    {
    	parent::boot();

    	static::deleting(function($recipe) {
    		$recipe->ingredients()->delete();
    	});
    }
}
