<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Traits\ApiResponse;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\JsonResponse;

class ReadAllCategoryController extends Controller
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
    public function __invoke(Request $request): JsonResponse
    {
        $categories = $this->categoryRepository->all()->paginate(10);

        return $this->successResponse(
            successMessage: "Categories fetched successfully.",
            statusCode: 200,
            data: CategoryResource::collection($categories)->response()->getData()
        );
    }
}
