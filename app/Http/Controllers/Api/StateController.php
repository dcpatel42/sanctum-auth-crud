<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Http\Requests\StoreStateRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Http\Resources\CountryResource;
use App\Http\Resources\StateResource;
use App\Models\City;
use App\Models\Country;
use App\Repositories\StateRepository;
use Exception;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /** @var  StateRepository */
    private $stateRepository;

    public function __construct(StateRepository $stateRepo)
    {
        $this->stateRepository = $stateRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $state = State::withoutGlobalScope(ActiveScope::class)
                        ->searchState($request->all())
                        ->get();

        return response()->sendData([
            'states' => StateResource::collection($state)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $countries = Country::orderBy('id','DESC')->get();
        return response()->sendData([
            'countries' => CountryResource::collection($countries),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStateRequest $request)
    {
        $validatedData = $request->validated();
               
        $state = State::create($validatedData);
        
        return response()->sendResponse('State created successfully!',['state' => new StateResource($state)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        try{
            return response()->sendResponse('State retrieved successfully!',['state' => new StateResource($state)]);
        } catch (Exception $e) {
            return response()->sendError(['status' => 400, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        return response()->sendResponse('State retrieved successfully!',['state' => new StateResource($state)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStateRequest  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStateRequest $request, State $state)
    {
        $validatedData = $request->validated();
       
        $state = $state->update($validatedData);

        return response()->sendResponse('State updated successfully!',['state' => $state]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        try {
            $state->load('cities');
            $cities = $state->cities;
            
            City::whereIn('id', $cities->pluck('id'))->delete();
            $state->delete($state->id);
            return response()->sendResponse('State deleted successfully!');
        } catch (Exception $e) {
            return response()->sendError(['status' => 400, 'message' => $e->getMessage()]);
        }
    }
}
