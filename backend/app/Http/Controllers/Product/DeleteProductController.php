<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class DeleteProductController extends Controller
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
    public function __invoke(Request $request, string $id): JsonResponse
    {
        $product = $this->productRepository->fetch($id);

        if($product == NULL) {
            return $this->errorResponse(
                errorMessage: "Product not found.",
                statusCode: 404,
                data: null
            );
        }

        $this->productRepository->delete($id);

        return $this->successResponse(
            successMessage: "Product deleted successfully.",
            statusCode: 200,
            data: null
        );
    }
}
