<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Supplier\CreateSupplierRequest;
use App\Repositories\SupplierRepository;
use App\Http\Resources\SupplierResource;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class CreateSupplierController extends Controller
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
    public function __invoke(CreateSupplierRequest $createSupplierRequest): JsonResponse
    {
        $supplier = $this->supplierRepository->store($createSupplierRequest->validated());

        return $this->successResponse(
            successMessage: "Supplier created successfully",
            statusCode: 201,
            data: new SupplierResource($supplier)
        );
    }
}
