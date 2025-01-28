<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Traits\ApiResponse;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;

class ReadAllProductController extends Controller
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
        $products = $this->productRepository->all()->paginate(10);

        return $this->successResponse(
            successMessage: "Products fetched successfully.",
            statusCode: 200,
            data: ProductResource::collection($products)->response()->getData()
        );
    }
}
