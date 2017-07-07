<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePasswordRessetAPIRequest;
use App\Http\Requests\API\UpdatePasswordRessetAPIRequest;
use App\Models\PasswordResset;
use App\Repositories\PasswordRessetRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PasswordRessetController
 * @package App\Http\Controllers\API
 */

class PasswordRessetAPIController extends AppBaseController
{
    /** @var  PasswordRessetRepository */
    private $passwordRessetRepository;

    public function __construct(PasswordRessetRepository $passwordRessetRepo)
    {
        $this->passwordRessetRepository = $passwordRessetRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/passwordRessets",
     *      summary="Get a listing of the PasswordRessets.",
     *      tags={"PasswordResset"},
     *      description="Get all PasswordRessets",
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
     *                  @SWG\Items(ref="#/definitions/PasswordResset")
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
        $this->passwordRessetRepository->pushCriteria(new RequestCriteria($request));
        $this->passwordRessetRepository->pushCriteria(new LimitOffsetCriteria($request));
        $passwordRessets = $this->passwordRessetRepository->all();

        return $this->sendResponse($passwordRessets->toArray(), 'Password Ressets retrieved successfully');
    }

    /**
     * @param CreatePasswordRessetAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/passwordRessets",
     *      summary="Store a newly created PasswordResset in storage",
     *      tags={"PasswordResset"},
     *      description="Store PasswordResset",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="PasswordResset that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PasswordResset")
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
     *                  ref="#/definitions/PasswordResset"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePasswordRessetAPIRequest $request)
    {
        $input = $request->all();

        $passwordRessets = $this->passwordRessetRepository->create($input);

        return $this->sendResponse($passwordRessets->toArray(), 'Password Resset saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/passwordRessets/{id}",
     *      summary="Display the specified PasswordResset",
     *      tags={"PasswordResset"},
     *      description="Get PasswordResset",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PasswordResset",
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
     *                  ref="#/definitions/PasswordResset"
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
        /** @var PasswordResset $passwordResset */
        $passwordResset = $this->passwordRessetRepository->findWithoutFail($id);

        if (empty($passwordResset)) {
            return $this->sendError('Password Resset not found');
        }

        return $this->sendResponse($passwordResset->toArray(), 'Password Resset retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePasswordRessetAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/passwordRessets/{id}",
     *      summary="Update the specified PasswordResset in storage",
     *      tags={"PasswordResset"},
     *      description="Update PasswordResset",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PasswordResset",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="PasswordResset that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PasswordResset")
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
     *                  ref="#/definitions/PasswordResset"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePasswordRessetAPIRequest $request)
    {
        $input = $request->all();

        /** @var PasswordResset $passwordResset */
        $passwordResset = $this->passwordRessetRepository->findWithoutFail($id);

        if (empty($passwordResset)) {
            return $this->sendError('Password Resset not found');
        }

        $passwordResset = $this->passwordRessetRepository->update($input, $id);

        return $this->sendResponse($passwordResset->toArray(), 'PasswordResset updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/passwordRessets/{id}",
     *      summary="Remove the specified PasswordResset from storage",
     *      tags={"PasswordResset"},
     *      description="Delete PasswordResset",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PasswordResset",
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
        /** @var PasswordResset $passwordResset */
        $passwordResset = $this->passwordRessetRepository->findWithoutFail($id);

        if (empty($passwordResset)) {
            return $this->sendError('Password Resset not found');
        }

        $passwordResset->delete();

        return $this->sendResponse($id, 'Password Resset deleted successfully');
    }
}
