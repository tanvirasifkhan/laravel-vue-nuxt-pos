<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Repositories\CategoryRepository;
use App\Traits\ApiResponse;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\JsonResponse;

class CreateCategoryController extends Controller
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
    public function __invoke(CreateCategoryRequest $createCategoryRequest): JsonResponse
    {
        $category = $this->categoryRepository->store($createCategoryRequest->validated());

        return $this->successResponse(
            successMessage: "Category created successfully.",
            statusCode: 201,
            data: new CategoryResource($category)
        );
    }
}
