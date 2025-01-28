<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;


class DeleteCategoryController extends Controller
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
    public function __invoke(Request $request, string $id): JsonResponse
    {
        $category = $this->categoryRepository->fetch($id);

        if($category == NULL) {
            return $this->errorResponse(
                errorMessage: "Category not found.",
                statusCode: 404,
                data: null
            );
        }

        $this->categoryRepository->delete($id);

        return $this->successResponse(
            successMessage: "Category deleted successfully.",
            statusCode: 200,
            data: null
        );
    }
}
