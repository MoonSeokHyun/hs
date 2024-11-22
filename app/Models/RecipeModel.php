<?php

namespace App\Models;

use CodeIgniter\Model;

class RecipeModel extends Model
{
    protected $table = 'recipes_ease';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'image_url', 'views', 'ingredients', 'cooking_steps', 'author', 'recipe_url', 'created_at'];
}
