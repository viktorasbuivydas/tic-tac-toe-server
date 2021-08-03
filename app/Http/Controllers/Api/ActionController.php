<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Action\StoreRequest;
use App\Http\Resources\Action\ShowResource;
use App\Models\Action;

class ActionController extends Controller
{
    public function store(StoreRequest $request)
    {

        $action = Action::create($request->validated());

        return new ShowResource($action);
    }
}
