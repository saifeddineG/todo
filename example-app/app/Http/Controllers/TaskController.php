<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function index()
    {
        try {
           return  TaskResource::collection(Task::get());
        } catch (\Throwable $e) {
            Log::error($e->getMessage(), $e->getTrace());
            return  response()->json(["status"=>Response::HTTP_INTERNAL_SERVER_ERROR]) ;

        }
          
    }
    public function store(TaskRequest $request)
    {
        try {
            Task::create($request->all());
           return  response()->json(["status"=>Response::HTTP_CREATED , "message"=>"success to created"]) ;
        } catch (\Throwable $e) {
            Log::error($e->getMessage(), $e->getTrace());
            return  response()->json(["status"=>Response::HTTP_INTERNAL_SERVER_ERROR]) ;

        }
          
    }
    public function update(TaskRequest $request , Task $task)
    {
        try {
             $task->update($request->all());
           return  response()->json(["status"=>Response::HTTP_OK , "message"=>"success to updated"]) ;
        } catch (\Throwable $e) {
            Log::error($e->getMessage(), $e->getTrace());
            return  response()->json(["status"=>Response::HTTP_INTERNAL_SERVER_ERROR]) ;

        }
          
    }
    public function delete(Task $task)
    {
        try {
            $task->delete();
           return  response()->json(["status"=>Response::HTTP_OK , "message"=>"success to deleted"]) ;
        } catch (\Throwable $e) {
            Log::error($e->getMessage(), $e->getTrace());
            return  response()->json(["status"=>Response::HTTP_INTERNAL_SERVER_ERROR]) ;

        }
          
    }
}
