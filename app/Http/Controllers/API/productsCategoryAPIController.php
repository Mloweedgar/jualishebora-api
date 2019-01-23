<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateproductsCategoryAPIRequest;
use App\Http\Requests\API\UpdateproductsCategoryAPIRequest;
use App\Models\Products;
use App\Models\productsCategory;
use App\Repositories\productsCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Serializers\JsonSerializer;
use App\Transformers\ProductTransformer;
use Response;

/**
 * Class productsCategoryController
 * @package App\Http\Controllers\API
 */

class productsCategoryAPIController extends AppBaseController
{
    /** @var  productsCategoryRepository */
    private $productsCategoryRepository;

    public function __construct(productsCategoryRepository $productsCategoryRepo)
    {
        $this->productsCategoryRepository = $productsCategoryRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/productsCategories",
     *      summary="Get a listing of the productsCategories.",
     *      tags={"productsCategory"},
     *      description="Get all productsCategories",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/productsCategory")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->productsCategoryRepository->pushCriteria(new RequestCriteria($request));
        $this->productsCategoryRepository->pushCriteria(new LimitOffsetCriteria($request));
        $productsCategories = $this->productsCategoryRepository->all();

        return $this->sendResponse($productsCategories->toArray(), 'Products Categories retrieved successfully');
    }

    /**
     * @param CreateproductsCategoryAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/productsCategories",
     *      summary="Store a newly created productsCategory in storage",
     *      tags={"productsCategory"},
     *      description="Store productsCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="productsCategory that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/productsCategory")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/productsCategory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateproductsCategoryAPIRequest $request)
    {
        $input = $request->all();

        $productsCategories = $this->productsCategoryRepository->create($input);

        return $this->sendResponse($productsCategories->toArray(), 'Products Category saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/productsCategories/{id}",
     *      summary="Display the specified productsCategory",
     *      tags={"productsCategory"},
     *      description="Get productsCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of productsCategory",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/productsCategory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var productsCategory $productsCategory */
        $productsCategory = $this->productsCategoryRepository->findWithoutFail($id);

        if (empty($productsCategory)) {
            return $this->sendError('Products Category not found');
        }

        return $this->sendResponse($productsCategory->toArray(), 'Products Category retrieved successfully');
    }




    
      /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/productsByCategory/{id}",
     *      summary="Display all products by category id",
     *      tags={"productsCategory"},
     *      description="Get products by category id",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ProductCategory",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/ProductCategory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function productsByCategory($id)
    {
        /** @var productsCategory $productCategory */
        $productCategory = Products::where('topic_category_id',$id)->get();

        if (empty($productCategory)) {
            return $this->sendError('Products Category not found');
        }

        //return $this->sendResponse($productCategory->toArray(), 'Products Category retrieved successfully');
    
       
       $transformedProducts = fractal()
           ->collection($productCategory)
           ->transformWith(new ProductTransformer())
           ->serializeWith(new JsonSerializer())
           ->toArray();


       return $this->sendResponse($transformedProducts, 'Products retrieved successfully');
    }





    /**
     * @param int $id
     * @param UpdateproductsCategoryAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/productsCategories/{id}",
     *      summary="Update the specified productsCategory in storage",
     *      tags={"productsCategory"},
     *      description="Update productsCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of productsCategory",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="productsCategory that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/productsCategory")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/productsCategory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateproductsCategoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var productsCategory $productsCategory */
        $productsCategory = $this->productsCategoryRepository->findWithoutFail($id);

        if (empty($productsCategory)) {
            return $this->sendError('Products Category not found');
        }

        $productsCategory = $this->productsCategoryRepository->update($input, $id);

        return $this->sendResponse($productsCategory->toArray(), 'productsCategory updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/productsCategories/{id}",
     *      summary="Remove the specified productsCategory from storage",
     *      tags={"productsCategory"},
     *      description="Delete productsCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of productsCategory",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var productsCategory $productsCategory */
        $productsCategory = $this->productsCategoryRepository->findWithoutFail($id);

        if (empty($productsCategory)) {
            return $this->sendError('Products Category not found');
        }

        $productsCategory->delete();

        return $this->sendResponse($id, 'Products Category deleted successfully');
    }
}
