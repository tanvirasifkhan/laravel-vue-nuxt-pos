<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class SearchProductController extends Controller
{
    use ApiResponse;

    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        if($request->query('keyword') == ""){
            return $this->errorResponse(
                errorMessage: "Please provide a keyword to search.",
                statusCode: 404,
                data: null
            );
        }

        $products = $this->productRepository->search($request->query('keyword'));

        if($products->count() == 0){
            return $this->errorResponse(
                errorMessage: "No product match found.",
                statusCode: 404,
                data: null
            );
        }

        return $this->successResponse(
            successMessage: "Products search result.",
            statusCode: 200,
            data: ProductResource::collection($products->paginate(perPage: 10))->response()->getData()
        );
    }
}
