<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PurchaseResource;
use App\Traits\ApiResponse;
use App\Repositories\PurchaseRepository;
use Illuminate\Http\JsonResponse;

class ReadAllPurchaseController extends Controller
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
    public function __invoke(Request $request): JsonResponse
    {
        $purchaseList = $this->purchaseRepository->all()->paginate(10);

        return $this->successResponse(
            successMessage: "Purchase datas fetched successfully.",
            statusCode: 200,
            data: PurchaseResource::collection($purchaseList)->response()->getData()
        );
    }
}
