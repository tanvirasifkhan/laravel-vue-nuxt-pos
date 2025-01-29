<?php

namespace App\Http\Controllers\SupplierLedger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SupplierLedger\CreateSupplierLedgerRequest;
use App\Repositories\SupplierLedgerRepository;
use App\Http\Resources\SupplierLedgerResource;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class CreateSupplierLedgerController extends Controller
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
    public function __invoke(CreateSupplierLedgerRequest $createSupplierLedgerRequest): JsonResponse
    {
        $supplierLedgerData = $createSupplierLedgerRequest->validated();

        $ledgerBySupplier = $this->supplierLedgerRepository->fetchBy($supplierLedgerData['supplier_id'], $supplierLedgerData['purchase_id']);

        if($ledgerBySupplier->credited_amount == 0) {
            return $this->errorResponse(
                errorMessage: "Already paid.",
                statusCode: 417,
                data: null
            );
        }

        if($supplierLedgerData['debited_amount'] != $ledgerBySupplier->credited_amount) {
            return $this->errorResponse(
                errorMessage: "You have to pay exactly $ledgerBySupplier->credited_amount to clear the balance.",
                statusCode: 417,
                data: null
            );
        }

        $ledger = $this->supplierLedgerRepository->store([
            'purchase_id' => $supplierLedgerData['purchase_id'],
            'supplier_id' => $supplierLedgerData['supplier_id'],
            'transaction_date' => $supplierLedgerData['transaction_date'],
            'type' => 'debit',
            'credited_amount' => $ledgerBySupplier->credited_amount - $supplierLedgerData['debited_amount'],
            'debited_amount' => $supplierLedgerData['debited_amount'],
            'description' => $supplierLedgerData['description']
        ]);

        return $this->successResponse(
            successMessage: "Supplier ledger created successfully.",
            statusCode: 201,
            data: new SupplierLedgerResource($ledger)
        );
    }
}
