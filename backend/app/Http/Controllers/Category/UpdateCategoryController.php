<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;
use App\Traits\ApiResponse;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\JsonResponse;

class UpdateCategoryController extends Controller
{
    use ApiResponse;

    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateCategoryRequest $updateCategoryRequest, int $id): JsonResponse
    {
        $oldCategory = $this->categoryRepository->fetch($id);

        if($oldCategory == NULL) {
            return $this->errorResponse(
                errorMessage: "Category not found.",
                statusCode: 404,
                data: null
            );
        }

        $this->categoryRepository->update($id, $updateCategoryRequest->validated());

        $category = $this->categoryRepository->fetch($id);

        return $this->successResponse(
            successMessage: "Category updated successfully.",
            statusCode: 200,
            data: new CategoryResource($category)
        );
    }
}
