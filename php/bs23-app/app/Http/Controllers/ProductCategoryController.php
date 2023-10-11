<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategoryRequest;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;
use App\Services\ProductCategoryService;

class ProductCategoryController extends Controller
{
    private $productCategoryService;

    public function __construct(ProductCategoryService $productCategoryService)
    {
        $this->productCategoryService = $productCategoryService;
    }

    public function index()
    {
        return ProductCategoryResource::collection(ProductCategory::paginate(2));
    }

    public function view(int $id)
    {
        return ProductCategoryResource::make(ProductCategory::where('id', $id)->first());
    }

    public function delete(int $id)
    {
        $category = ProductCategory::find($id);
        try{
            if ($category->delete()) :
               return json_encode(array('success' => true, 'message' => 'Successfully deleted!'));
            else :
                return json_encode(array('success' => false, 'message' => 'Unsuccessfully deleted!'));
            endif;
            exit;
        }Catch(\Illuminate\Database\QueryException $ex){

           return json_encode(array('success' => false, 'message' => 'Error!'));
           exit;
        }
    }

    public function store(ProductCategoryRequest $request)
    {
        try {
            //return $request->all();
            $productCategory = $this->productCategoryService->store($request->all());
            if (! empty($productCategory)) {
                $data['data'] = $productCategory;
                $data['message'] = "Product create successfully.";
               // return $this->sendResponse($productCategory, 'Product create successfully.');
               //return ProductCategoryResource::make($productCategory);
                return \response()->json(['data' => $data], 200);
            } else {
               // return $this->sendError([], 'Product create Failed');
                return \response()->json(['Product create Failed'], 501);
            }

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function update(ProductCategoryRequest $request, int $id)
    {
        try {
            $productCategory = $this->productCategoryService->update($request->all(), $id);
            if (! empty($productCategory)) {
                $data['data'] = $productCategory;
                $data['message'] = "Product update successfully.";
                return \response()->json(['data' => $data], 200);
            } else {
                return \response()->json(['Product update Failed'], 501);
            }

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

}
