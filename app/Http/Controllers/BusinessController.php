<?php

namespace App\Http\Controllers;

use App\Services\BusinessService;
use Illuminate\Http\Request;

class BusinessController extends ApiController
{
    protected $businessService;

    public function __construct(BusinessService $businessService)
    {
        $this->businessService = $businessService;
    }

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        $data = $this->businessService->get(10);

        if (empty($data)) {
            return $this->errorResponse(null, "Data is empty");
        }
        return $this->successResponse($data, "data has found");
    }

    /**
        * Show the form for creating a new resource.
        *
        * @return Response
        */
    public function create()
    {
        
    }

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store(Request $request)
    {
        $this->validate($request, $this->businessService->rules());
        
        $data = $this->businessService->store($request);

        return $this->successResponse($data, "Create Data succes");
    }

    /**
        * Update the specified resource in storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function update($tableId, Request $request)
    {
        $this->validate($request, $this->businessService->rules());
        
        $data = $this->businessService->update($tableId, $request);

        return $this->successResponse($data, "Update Data succes");
    }

    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function destroy($tableId)
    {
        $data = $this->businessService->destroy($tableId);

        if (empty($data)) {
            return $this->errorResponse($data, "Data error to Delete");
        }

        return $this->successResponse($data, "Data success to Delete");
    }

    public function show($tableId)
    {
        $data = $this->businessService->find($tableId);

        if (empty($data)) {
            return $this->errorResponse($data, "Data Not Found");
        }

        return $this->successResponse($data, "Data has been find");

    }

    public function search(Request $request)
    {
        $data = $this->businessService->search($request);

        if (empty($data->data)) {
            return $this->errorResponse($data, "Data Not Found");
        }

        return $this->successResponse($data, "Data has been find");

    }
}
