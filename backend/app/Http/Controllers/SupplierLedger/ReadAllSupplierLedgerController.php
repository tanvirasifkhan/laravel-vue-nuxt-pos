<?php

namespace App\Http\Controllers\SupplierLedger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SupplierLedgerRepository;
use App\Http\Resources\SupplierLedgerResource;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class ReadAllSupplierLedgerController extends Controller
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
    public function __invoke(Request $request): JsonResponse
    {
        $ledgers = $this->supplierLedgerRepository->all()->paginate(10);

        return $this->successResponse(
            successMessage: "Supplier Ledgers fetched successfully.",
            statusCode: 200,
            data: SupplierLedgerResource::collection($ledgers)->response()->getData()
        );
    }
}
