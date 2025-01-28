<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Repositories\ProductRepository;
use App\Traits\ApiResponse;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;

class UpdateProductController extends Controller
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
    public function __invoke(UpdateProductRequest $updateProductRequest, int $id): JsonResponse
    {
        $oldProduct = $this->productRepository->fetch($id);

        if($oldProduct == NULL) {
            return $this->errorResponse(
                errorMessage: "Product not found.",
                statusCode: 404,
                data: null
            );
        }

        $this->productRepository->update($id, $updateProductRequest->validated());

        $product = $this->productRepository->fetch($id);

        return $this->successResponse(
            successMessage: "Product updated successfully.",
            statusCode: 200,
            data: new ProductResource($product)
        );
    }
}
