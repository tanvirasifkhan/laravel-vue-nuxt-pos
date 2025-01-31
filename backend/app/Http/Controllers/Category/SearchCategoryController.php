<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Repositories\CategoryRepository;
use App\Http\Resources\CategoryResource;
use App\Traits\ApiResponse;

class SearchCategoryController extends Controller
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
    public function __invoke(Request $request, string $keyword): JsonResponse
    {
        if($keyword == ""){
            return $this->errorResponse(
                errorMessage: "Please provide a keyword to search.",
                statusCode: 404,
                data: null
            );
        }

        $categories = $this->categoryRepository->search($keyword);

        if($categories->count() == 0){
            return $this->errorResponse(
                errorMessage: "No category match found.",
                statusCode: 404,
                data: null
            );
        }

        return $this->successResponse(
            successMessage: "Categories search result.",
            statusCode: 200,
            data: CategoryResource::collection($categories->paginate(perPage: 10))->response()->getData()
        );
    }
}
