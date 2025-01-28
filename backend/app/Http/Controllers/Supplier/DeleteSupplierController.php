<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SupplierRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class DeleteSupplierController extends Controller
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
    public function __invoke(Request $request, int $id): JsonResponse
    {
        $supplier = $this->supplierRepository->fetch($id);

        if($supplier == NULL) {
            return $this->errorResponse(
                errorMessage: "Supplier not found.",
                statusCode: 404,
                data: null
            );
        }

        $this->supplierRepository->delete($id);

        return $this->successResponse(
            successMessage: "Supplier deleted successfully.",
            statusCode: 200,
            data: null
        );
    }
}
