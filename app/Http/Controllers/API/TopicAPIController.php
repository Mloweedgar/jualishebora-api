<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTopicAPIRequest;
use App\Http\Requests\API\UpdateTopicAPIRequest;
use App\Models\Topic;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TopicController
 * @package App\Http\Controllers\API
 */

class TopicAPIController extends AppBaseController
{
    /** @var  TopicRepository */
    private $topicRepository;

    public function __construct(TopicRepository $topicRepo)
    {
        $this->topicRepository = $topicRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/topics",
     *      summary="Get a listing of the Topics.",
     *      tags={"Topic"},
     *      description="Get all Topics",
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
     *                  @SWG\Items(ref="#/definitions/Topic")
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
        $this->topicRepository->pushCriteria(new RequestCriteria($request));
        $this->topicRepository->pushCriteria(new LimitOffsetCriteria($request));
        $topics = $this->topicRepository->all();

        return $this->sendResponse($topics->toArray(), 'Topics retrieved successfully');
    }

    /**
     * @param CreateTopicAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/topics",
     *      summary="Store a newly created Topic in storage",
     *      tags={"Topic"},
     *      description="Store Topic",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Topic that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Topic")
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
     *                  ref="#/definitions/Topic"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTopicAPIRequest $request)
    {
        $input = $request->all();

        $topics = $this->topicRepository->create($input);

        return $this->sendResponse($topics->toArray(), 'Topic saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/topics/{id}",
     *      summary="Display the specified Topic",
     *      tags={"Topic"},
     *      description="Get Topic",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Topic",
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
     *                  ref="#/definitions/Topic"
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
        /** @var Topic $topic */
        $topic = $this->topicRepository->findWithoutFail($id);

        if (empty($topic)) {
            return $this->sendError('Topic not found');
        }

        return $this->sendResponse($topic->toArray(), 'Topic retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTopicAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/topics/{id}",
     *      summary="Update the specified Topic in storage",
     *      tags={"Topic"},
     *      description="Update Topic",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Topic",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Topic that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Topic")
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
     *                  ref="#/definitions/Topic"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTopicAPIRequest $request)
    {
        $input = $request->all();

        /** @var Topic $topic */
        $topic = $this->topicRepository->findWithoutFail($id);

        if (empty($topic)) {
            return $this->sendError('Topic not found');
        }

        $topic = $this->topicRepository->update($input, $id);

        return $this->sendResponse($topic->toArray(), 'Topic updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/topics/{id}",
     *      summary="Remove the specified Topic from storage",
     *      tags={"Topic"},
     *      description="Delete Topic",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Topic",
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
        /** @var Topic $topic */
        $topic = $this->topicRepository->findWithoutFail($id);

        if (empty($topic)) {
            return $this->sendError('Topic not found');
        }

        $topic->delete();

        return $this->sendResponse($id, 'Topic deleted successfully');
    }
}
