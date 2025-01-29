<?php

namespace App\Http\Controllers\SupplierLedger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SupplierLedgerRepository;
use App\Http\Resources\SupplierLedgerResource;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class FetchBySupplierPurchaseController extends Controller
{
    use ApiResponse;

    private $supplierLedgerRepository;

    public function __construct(SupplierLedgerRepository $supplierLedgerRepository)
    {
        $this->supplierLedgerRepository = $supplierLedgerRepository;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $supplierId, int $purchaseId): JsonResponse
    {
        $ledger = $this->supplierLedgerRepository->fetchBy($supplierId, $purchaseId);

        if($ledger == NULL) {
            return $this->errorResponse(
                errorMessage: "Ledger data not found.",
                statusCode: 404,
                data: null
            );
        }

        return $this->successResponse(
            successMessage: "Ledger info fetch successfully.",
            statusCode: 201,
            data: new SupplierLedgerResource($ledger)
        );
    }
}
