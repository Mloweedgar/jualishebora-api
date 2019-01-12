<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateaudioAPIRequest;
use App\Http\Requests\API\UpdateaudioAPIRequest;
use App\Models\audio;
use App\Repositories\audioRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\URL;
use \Storage;
use Response;

/**
 * Class audioController
 * @package App\Http\Controllers\API
 */

class audioAPIController extends AppBaseController
{
    /** @var  audioRepository */
    private $audioRepository;

    public function __construct(audioRepository $audioRepo)
    {
        $this->audioRepository = $audioRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/audio",
     *      summary="Get a listing of the audio.",
     *      tags={"audio"},
     *      description="Get all audio",
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
     *                  @SWG\Items(ref="#/definitions/audio")
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
        $this->audioRepository->pushCriteria(new RequestCriteria($request));
        $this->audioRepository->pushCriteria(new LimitOffsetCriteria($request));
        $audio = $this->audioRepository->all();

        return $this->sendResponse($audio->toArray(), 'Audio retrieved successfully');
    }

    /**
     * @param CreateaudioAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/audio",
     *      summary="Store a newly created audio in storage",
     *      tags={"audio"},
     *      description="Store audio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="audio that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/audio")
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
     *                  ref="#/definitions/audio"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Request $request)
    {
        //$path = $request->file('audio')->store('Audibles');
        
        if($request->hasFile('audio')){
            $file = $request->file('audio');
            $filename = $file->getClientOriginalName();
            $destinationPath = URL::to('/').'/storage/audios'.'/'.$filename;
            $request->audio->storeAs('audios',$filename,'public');
            $audio = new audio();
            $audio->audio_url = $destinationPath;
            $audio->save();
        
            return $this->sendResponse($audio->toArray(), 'Audio saved successfully');
        }

        else {
            return ('Could not store audio file');
        }
        
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/audio/{id}",
     *      summary="Display the specified audio",
     *      tags={"audio"},
     *      description="Get audio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of audio",
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
     *                  ref="#/definitions/audio"
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
        /** @var audio $audio */
        $audio = $this->audioRepository->findWithoutFail($id);

        if (empty($audio)) {
            return $this->sendError('Audio not found');
        }

        return $this->sendResponse($audio->toArray(), 'Audio retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateaudioAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/audio/{id}",
     *      summary="Update the specified audio in storage",
     *      tags={"audio"},
     *      description="Update audio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of audio",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="audio that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/audio")
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
     *                  ref="#/definitions/audio"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateaudioAPIRequest $request)
    {
        $input = $request->all();

        /** @var audio $audio */
        $audio = $this->audioRepository->findWithoutFail($id);

        if (empty($audio)) {
            return $this->sendError('Audio not found');
        }

        $audio = $this->audioRepository->update($input, $id);

        return $this->sendResponse($audio->toArray(), 'audio updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/audio/{id}",
     *      summary="Remove the specified audio from storage",
     *      tags={"audio"},
     *      description="Delete audio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of audio",
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
        /** @var audio $audio */
        $audio = $this->audioRepository->findWithoutFail($id);

        if (empty($audio)) {
            return $this->sendError('Audio not found');
        }

        $audio->delete();

        return $this->sendResponse($id, 'Audio deleted successfully');
    }
}
