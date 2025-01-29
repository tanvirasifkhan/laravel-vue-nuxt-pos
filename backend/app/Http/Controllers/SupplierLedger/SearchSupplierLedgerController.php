<?php

namespace App\Http\Controllers\SupplierLedger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SupplierLedgerRepository;
use App\Http\Resources\SupplierLedgerResource;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class SearchSupplierLedgerController extends Controller
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
        if($request->query('date_from') == ""){
            return $this->errorResponse(
                errorMessage: "Please provide a date start to search.",
                statusCode: 404,
                data: null
            );
        }

        if($request->query('date_to') == ""){
            return $this->errorResponse(
                errorMessage: "Please provide a date end to search.",
                statusCode: 404,
                data: null
            );
        }

        $ledgers = $this->supplierLedgerRepository->search($request->query('date_from'), $request->query('date_from'));

        if($ledgers->count() == 0){
            return $this->errorResponse(
                errorMessage: "No ledger match found.",
                statusCode: 404,
                data: null
            );
        }

        return $this->successResponse(
            successMessage: "Supplier ledgers search result.",
            statusCode: 200,
            data: SupplierLedgerResource::collection($ledgers->paginate(perPage: 10))->response()->getData()
        );
    }
}
