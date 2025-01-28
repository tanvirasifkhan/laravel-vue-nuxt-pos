<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class CreateProductController extends Controller
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
    public function __invoke(CreateProductRequest $createProductRequest): JsonResponse
    {
        $product = $this->productRepository->store($createProductRequest->validated());

        $product->quantity = 0;

        return $this->successResponse(
            successMessage: "Product created successfully.",
            statusCode: 201,
            data: new ProductResource($product)
        );
    }
}
