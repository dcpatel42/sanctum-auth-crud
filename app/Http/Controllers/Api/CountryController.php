<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Http\Resources\CountryResource;
use App\Models\City;
use App\Models\State;
use App\Repositories\CountryRepository;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /** @var  CountryRepository */
    private $countryRepository;

    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepository = $countryRepo;
    }
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countries = Country::withoutGlobalScope(ActiveScope::class)
                            ->searchCountry($request->all())
                            ->get();
        return response()->sendData([
            'countries' => CountryResource::collection($countries),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCountryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountryRequest $request)
    {
        $validatedData = $request->validated();
               
        $country = $this->countryRepository->create($validatedData);
        
        return response()->sendResponse('Country created successfully!',['country' => new CountryResource($country)]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return response()->sendResponse('Country retrieved successfully!',['country' => new CountryResource($country)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return response()->sendResponse('Country retrieved successfully!',['country' => new CountryResource($country)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCountryRequest  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $validatedData = $request->validated();
       
        $country = $this->countryRepository->update($validatedData, $country->id);

        return response()->sendResponse('Country updated successfully!',['country' => $country]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->load('states.cities');

        $states = $country->states;

        $cities = $states->pluck('cities')->flatten();

        City::whereIn('id', $cities->pluck('id'))->delete();
        State::whereIn('id', $states->pluck('id'))->delete();
        $country->delete();

        return response()->sendResponse('Country deleted successfully!',null,204);
    }
}
