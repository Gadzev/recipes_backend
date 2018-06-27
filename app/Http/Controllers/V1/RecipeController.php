<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use App\Recipe;
use App\Ingredient;
use App\Constants\Ingredients;
use App\Constants\Messages;
use App\Constants\ResponseType;

class RecipeController extends CRUDController
{
    public function index(Request $request) : JsonResponse
    {
        $recipes = Recipe::all();

        return $this->respond($recipes->toArray());
    }

    public function show(Request $request, int $id) : JsonResponse
    {
        $recipe = Recipe::findOrFail($id);

        return $this->respond($recipe->toArray());
    }

    public function store(Request $request) : JsonResponse
    {
        $rules = [
            'name' => 'required|min:2',
            'source' => 'sometimes|url',
            'preparation' => 'required|date_format:H:i',
            'instructions' => 'required|min:6|max:128',
            'ingredients' => 'required|min:1',
            'ingredients.*.name' => [ 'required', Rule::in(Ingredients::getConstants()) ],
            'ingredients.*.quantity' => 'required|min:1'
        ];

        $this->validate($request, $rules);

        $recipe = Recipe::create([
            'name' => $request->get('name'),
            'source' => $request->get('source'),
            'preparation' => $request->get('preparation'),
            'instructions' => $request->get('instructions')
        ]);

        foreach ($request->get('ingredients') as $ingredient)
        {
            Ingredient::create([
                'name' => $ingredient['name'],
                'quantity' => $ingredient['quantity'],
                'recipe_id' => $recipe->id
            ]);
        }

        return $this->respond($recipe->toarray(), [], Messages::RECIPE_CREATED, ResponseType::CREATED);
    }

    public function destroy(Request $request, int $id) : JsonResponse
    {
        $recipe = Recipe::findOrFail($id);

        $recipe->delete();

        return $this->respond(null, [], Messages::RECIPE_DELETED, ResponseType::NO_CONTENT);
    }
}
