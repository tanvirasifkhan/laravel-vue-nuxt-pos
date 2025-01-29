<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Repositories\SupplierLedgerRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Purchase\CreatePurchaseRequest;
use App\Http\Resources\PurchaseResource;
use App\Traits\ApiResponse;
use App\Repositories\PurchaseRepository;
use Illuminate\Http\JsonResponse;

class CreatePurchaseController extends Controller
{
    use ApiResponse;

    private $purchaseRepository;

    private $supplierLedgerRepository;

    public function __construct(PurchaseRepository $purchaseRepository, SupplierLedgerRepository $supplierLedgerRepository)
    {
        $this->purchaseRepository = $purchaseRepository;

        $this->supplierLedgerRepository = $supplierLedgerRepository;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(CreatePurchaseRequest $createPurchaseRequest): JsonResponse
    {
        $purchase = $this->purchaseRepository->store($createPurchaseRequest->validated());

        $this->purchaseRepository->storeItems($purchase->id, $createPurchaseRequest->validated()['items']);

        $purchase = $this->purchaseRepository->fetch($purchase->id);

        $this->supplierLedgerRepository->storeDefault($purchase);

        return $this->successResponse(
            successMessage: "Purchase added successfully.",
            statusCode: 201,
            data: new PurchaseResource($purchase)
        );
    }
}
