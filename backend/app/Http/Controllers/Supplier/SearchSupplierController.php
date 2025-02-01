<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Repositories\SupplierRepository;
use App\Http\Resources\SupplierResource;
use App\Traits\ApiResponse;

class SearchSupplierController extends Controller
{
    use ApiResponse;

    private $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $keyword): JsonResponse
    {
        if($request->query('keyword') == ""){
            return $this->errorResponse(
                errorMessage: "Please provide a keyword to search.",
                statusCode: 404,
                data: null
            );
        }

        $suppliers = $this->supplierRepository->search($request->query('keyword'));

        if($suppliers->count() == 0){
            return $this->errorResponse(
                errorMessage: "No supplier match found.",
                statusCode: 404,
                data: null
            );
        }

        return $this->successResponse(
            successMessage: "Suppliers search result.",
            statusCode: 200,
            data: SupplierResource::collection($suppliers->paginate(10))->response()->getData()
        );
    }
}
