<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateWazaziAPIRequest;
use App\Http\Requests\API\UpdateWazaziAPIRequest;
use App\Models\Wazazi;
use App\Repositories\WazaziRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class WazaziController
 * @package App\Http\Controllers\API
 */

class WazaziAPIController extends AppBaseController
{
    /** @var  WazaziRepository */
    private $wazaziRepository;

    public function __construct(WazaziRepository $wazaziRepo)
    {
        $this->wazaziRepository = $wazaziRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/wazazis",
     *      summary="Get a listing of the Wazazis.",
     *      tags={"Wazazi"},
     *      description="Get all Wazazis",
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
     *                  @SWG\Items(ref="#/definitions/Wazazi")
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
        $this->wazaziRepository->pushCriteria(new RequestCriteria($request));
        $this->wazaziRepository->pushCriteria(new LimitOffsetCriteria($request));
        $wazazis = $this->wazaziRepository->all();

        return $this->sendResponse($wazazis->toArray(), 'Wazazis retrieved successfully');
    }

    /**
     * @param CreateWazaziAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/wazazis",
     *      summary="Store a newly created Wazazi in storage",
     *      tags={"Wazazi"},
     *      description="Store Wazazi",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Wazazi that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Wazazi")
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
     *                  ref="#/definitions/Wazazi"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateWazaziAPIRequest $request)
    {
        $input = $request->all();

        $wazazis = $this->wazaziRepository->create($input);

        return $this->sendResponse($wazazis->toArray(), 'Wazazi saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/wazazis/{id}",
     *      summary="Display the specified Wazazi",
     *      tags={"Wazazi"},
     *      description="Get Wazazi",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Wazazi",
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
     *                  ref="#/definitions/Wazazi"
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
        /** @var Wazazi $wazazi */
        $wazazi = $this->wazaziRepository->findWithoutFail($id);

        if (empty($wazazi)) {
            return $this->sendError('Wazazi not found');
        }

        return $this->sendResponse($wazazi->toArray(), 'Wazazi retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateWazaziAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/wazazis/{id}",
     *      summary="Update the specified Wazazi in storage",
     *      tags={"Wazazi"},
     *      description="Update Wazazi",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Wazazi",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Wazazi that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Wazazi")
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
     *                  ref="#/definitions/Wazazi"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateWazaziAPIRequest $request)
    {
        $input = $request->all();

        /** @var Wazazi $wazazi */
        $wazazi = $this->wazaziRepository->findWithoutFail($id);

        if (empty($wazazi)) {
            return $this->sendError('Wazazi not found');
        }

        $wazazi = $this->wazaziRepository->update($input, $id);

        return $this->sendResponse($wazazi->toArray(), 'Wazazi updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/wazazis/{id}",
     *      summary="Remove the specified Wazazi from storage",
     *      tags={"Wazazi"},
     *      description="Delete Wazazi",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Wazazi",
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
        /** @var Wazazi $wazazi */
        $wazazi = $this->wazaziRepository->findWithoutFail($id);

        if (empty($wazazi)) {
            return $this->sendError('Wazazi not found');
        }

        $wazazi->delete();

        return $this->sendResponse($id, 'Wazazi deleted successfully');
    }
}
