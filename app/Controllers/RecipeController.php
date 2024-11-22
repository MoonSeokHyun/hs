<?php

namespace App\Controllers;

use App\Models\RecipeModel;

class RecipeController extends BaseController
{
    public function index()
    {
        $recipeModel = new RecipeModel();

        // 레시피 목록 가져오기 (페이징)
        $recipes = $recipeModel->orderBy('created_at', 'DESC')->paginate(6);

        // 페이징 객체
        $pager = $recipeModel->pager;

        return view('recipe/index', [
            'recipes' => $recipes,
            'pager' => $pager,
        ]);
    }

    public function detail($id)
    {
        $recipeModel = new RecipeModel();
        $recipe = $recipeModel->find($id);

        if (!$recipe) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Recipe with ID $id not found.");
        }

        return view('recipe/detail', ['recipe' => $recipe]);
    }
}
