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

        // 레시피 조회
        $recipe = $recipeModel->find($id);

        if (!$recipe) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Recipe with ID $id not found.");
        }

        // 조회수 증가 로직
        $recipe['views'] = $recipe['views'] + 1; // 조회수 1 증가
        $recipeModel->update($id, ['views' => $recipe['views']]);

        return view('recipe/detail', ['recipe' => $recipe]);
    }
}
