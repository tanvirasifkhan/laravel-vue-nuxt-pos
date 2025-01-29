<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PurchaseResource;
use App\Traits\ApiResponse;
use App\Repositories\PurchaseRepository;
use Illuminate\Http\JsonResponse;

class SearchPurchaseController extends Controller
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
        if($request->query('date') == ""){
            return $this->errorResponse(
                errorMessage: "Please provide a date to search.",
                statusCode: 404,
                data: null
            );
        }

        $purchases = $this->purchaseRepository->search($request->query('date') );

        if($purchases->count() == 0){
            return $this->errorResponse(
                errorMessage: "No purchase match found.",
                statusCode: 404,
                data: null
            );
        }

        return $this->successResponse(
            successMessage: "Purchase search result.",
            statusCode: 200,
            data: PurchaseResource::collection($purchases->paginate(10))->response()->getData()
        );
    }
}
