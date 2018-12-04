<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTopicCategoryAPIRequest;
use App\Http\Requests\API\UpdateTopicCategoryAPIRequest;
use App\Models\Topic;
use App\Models\TopicCategory;
use App\Repositories\TopicCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TopicCategoryController
 * @package App\Http\Controllers\API
 */

class TopicCategoryAPIController extends AppBaseController
{
    /** @var  TopicCategoryRepository */
    private $topicCategoryRepository;

    public function __construct(TopicCategoryRepository $topicCategoryRepo)
    {
        $this->topicCategoryRepository = $topicCategoryRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/topicCategories",
     *      summary="Get a listing of the TopicCategories.",
     *      tags={"TopicCategory"},
     *      description="Get all TopicCategories",
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
     *                  @SWG\Items(ref="#/definitions/TopicCategory")
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
        $this->topicCategoryRepository->pushCriteria(new RequestCriteria($request));
        $this->topicCategoryRepository->pushCriteria(new LimitOffsetCriteria($request));
        $topicCategories = $this->topicCategoryRepository->all();

        return $this->sendResponse($topicCategories->toArray(), 'Topic Categories retrieved successfully');
    }

    /**
     * @param CreateTopicCategoryAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/topicCategories",
     *      summary="Store a newly created TopicCategory in storage",
     *      tags={"TopicCategory"},
     *      description="Store TopicCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TopicCategory that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TopicCategory")
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
     *                  ref="#/definitions/TopicCategory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTopicCategoryAPIRequest $request)
    {
        $input = $request->all();

        $topicCategories = $this->topicCategoryRepository->create($input);

        return $this->sendResponse($topicCategories->toArray(), 'Topic Category saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/topicCategories/{id}",
     *      summary="Display the specified TopicCategory",
     *      tags={"TopicCategory"},
     *      description="Get TopicCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TopicCategory",
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
     *                  ref="#/definitions/TopicCategory"
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
        /** @var TopicCategory $topicCategory */
        $topicCategory = $this->topicCategoryRepository->findWithoutFail($id);

        if (empty($topicCategory)) {
            return $this->sendError('Topic Category not found');
        }

        return $this->sendResponse($topicCategory->toArray(), 'Topic Category retrieved successfully');
    }


    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/topicsByCategory/{id}",
     *      summary="Display all topics by category id",
     *      tags={"TopicCategory"},
     *      description="Get topics by category id",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TopicCategory",
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
     *                  ref="#/definitions/TopicCategory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function topicsByCategory($id)
    {
        /** @var TopicCategory $topicCategory */
        $topicCategory = Topic::where('topic_category_id',$id)->get();

        if (empty($topicCategory)) {
            return $this->sendError('Topic Category not found');
        }

        return $this->sendResponse($topicCategory->toArray(), 'Topic Category retrieved successfully');
    }






    /**
     * @param int $id
     * @param UpdateTopicCategoryAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/topicCategories/{id}",
     *      summary="Update the specified TopicCategory in storage",
     *      tags={"TopicCategory"},
     *      description="Update TopicCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TopicCategory",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TopicCategory that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TopicCategory")
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
     *                  ref="#/definitions/TopicCategory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTopicCategoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var TopicCategory $topicCategory */
        $topicCategory = $this->topicCategoryRepository->findWithoutFail($id);

        if (empty($topicCategory)) {
            return $this->sendError('Topic Category not found');
        }

        $topicCategory = $this->topicCategoryRepository->update($input, $id);

        return $this->sendResponse($topicCategory->toArray(), 'TopicCategory updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/topicCategories/{id}",
     *      summary="Remove the specified TopicCategory from storage",
     *      tags={"TopicCategory"},
     *      description="Delete TopicCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TopicCategory",
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
        /** @var TopicCategory $topicCategory */
        $topicCategory = $this->topicCategoryRepository->findWithoutFail($id);

        if (empty($topicCategory)) {
            return $this->sendError('Topic Category not found');
        }

        $topicCategory->delete();

        return $this->sendResponse($id, 'Topic Category deleted successfully');
    }
}
