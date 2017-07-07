<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDarasaAPIRequest;
use App\Http\Requests\API\UpdateDarasaAPIRequest;
use App\Models\Darasa;
use App\Repositories\DarasaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DarasaController
 * @package App\Http\Controllers\API
 */

class DarasaAPIController extends AppBaseController
{
    /** @var  DarasaRepository */
    private $darasaRepository;

    public function __construct(DarasaRepository $darasaRepo)
    {
        $this->darasaRepository = $darasaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/darasas",
     *      summary="Get a listing of the Darasas.",
     *      tags={"Darasa"},
     *      description="Get all Darasas",
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
     *                  @SWG\Items(ref="#/definitions/Darasa")
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
        $this->darasaRepository->pushCriteria(new RequestCriteria($request));
        $this->darasaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $darasas = $this->darasaRepository->all();

        return $this->sendResponse($darasas->toArray(), 'Darasas retrieved successfully');
    }

    /**
     * @param CreateDarasaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/darasas",
     *      summary="Store a newly created Darasa in storage",
     *      tags={"Darasa"},
     *      description="Store Darasa",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Darasa that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Darasa")
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
     *                  ref="#/definitions/Darasa"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateDarasaAPIRequest $request)
    {
        $input = $request->all();

        $darasas = $this->darasaRepository->create($input);

        return $this->sendResponse($darasas->toArray(), 'Darasa saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/darasas/{id}",
     *      summary="Display the specified Darasa",
     *      tags={"Darasa"},
     *      description="Get Darasa",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Darasa",
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
     *                  ref="#/definitions/Darasa"
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
        /** @var Darasa $darasa */
        $darasa = $this->darasaRepository->findWithoutFail($id);

        if (empty($darasa)) {
            return $this->sendError('Darasa not found');
        }

        return $this->sendResponse($darasa->toArray(), 'Darasa retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateDarasaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/darasas/{id}",
     *      summary="Update the specified Darasa in storage",
     *      tags={"Darasa"},
     *      description="Update Darasa",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Darasa",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Darasa that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Darasa")
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
     *                  ref="#/definitions/Darasa"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateDarasaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Darasa $darasa */
        $darasa = $this->darasaRepository->findWithoutFail($id);

        if (empty($darasa)) {
            return $this->sendError('Darasa not found');
        }

        $darasa = $this->darasaRepository->update($input, $id);

        return $this->sendResponse($darasa->toArray(), 'Darasa updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/darasas/{id}",
     *      summary="Remove the specified Darasa from storage",
     *      tags={"Darasa"},
     *      description="Delete Darasa",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Darasa",
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
        /** @var Darasa $darasa */
        $darasa = $this->darasaRepository->findWithoutFail($id);

        if (empty($darasa)) {
            return $this->sendError('Darasa not found');
        }

        $darasa->delete();

        return $this->sendResponse($id, 'Darasa deleted successfully');
    }
}
