<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Repositories\SupplierRepository;
use App\Http\Resources\SupplierResource;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class UpdateSupplierController extends Controller
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
    public function __invoke(UpdateSupplierRequest $updateSupplierRequest, int $id): JsonResponse
    {
        if($this->supplierRepository->fetch($id) == NULL) {
            return $this->errorResponse(
                errorMessage: "Supplier not found.",
                statusCode: 404,
                data: null
            );
        }

        $this->supplierRepository->update($id, $updateSupplierRequest->validated());

        $supplier = $this->supplierRepository->fetch($id);

        return $this->successResponse(
            successMessage: "Supplier updated successfully.",
            statusCode: 200,
            data: new SupplierResource($supplier)
        );
    }
}
