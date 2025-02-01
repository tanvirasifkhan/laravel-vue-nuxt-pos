<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseResource;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Repositories\PurchaseRepository;
use Illuminate\Http\JsonResponse;

class ReadPurchaseController extends Controller
{
    use ApiResponse;

    private $purchaseRepository;

    public function __construct(PurchaseRepository $purchaseRepository)
    {
        $this->purchaseRepository = $purchaseRepository;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $id): JsonResponse
    {
        $purchase = $this->purchaseRepository->fetch($id);

        if($purchase == NULL) {
            return $this->errorResponse(
                errorMessage: "Purchase not found.",
                statusCode: 404,
                data: null
            );
        }

        return $this->successResponse(
            successMessage: "Purchase fetched successfully.",
            statusCode: 200,
            data: new PurchaseResource($purchase)
        );
    }
}
