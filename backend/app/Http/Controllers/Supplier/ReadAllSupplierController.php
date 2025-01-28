<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SupplierRepository;
use App\Http\Resources\SupplierResource;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class ReadAllSupplierController extends Controller
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
    public function __invoke(Request $request): JsonResponse
    {
        $suppliers = $this->supplierRepository->all()->paginate(10);

        return $this->successResponse(
            successMessage: "Suppliers fetched successfully.",
            statusCode: 200,
            data: SupplierResource::collection($suppliers)->response()->getData()
        );
    }
}
