<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponseHelper;
use App\Models\Task;
use App\Services\TaskServices\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request): Response
    {
        $this->taskService->completed = $request->has('completed')
            ? (int)$request->input('completed')
            : null;

        return APIResponseHelper::getSuccessResponse($this->taskService->search());
    }

    public function store(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255',]
        ]);

        if ($validator->fails()) {
            return APIResponseHelper::getFailedResponse($validator->errors()->getMessages(), 400);
        }

        try {
            $this->taskService->name = $request->input('name');
            $task = $this->taskService->add();
        } catch (Exception $e) {
            return APIResponseHelper::getFailedResponse($e->getMessage(), 500);
        }

        return APIResponseHelper::getSuccessResponse($task);
    }

    public function update(Request $request, Task $task): Response
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255',]
        ]);

        if ($validator->fails()) {
            return APIResponseHelper::getFailedResponse($validator->errors()->getMessages(), 400);
        }

        try {
            $task->name = $request->input('name');
            $task->save();
        } catch (Exception $e) {
            return APIResponseHelper::getFailedResponse($e->getMessage(), 500);
        }

        return APIResponseHelper::getSuccessResponse($task);
    }

    /**
     * @param Task $task
     * @return Response
     * @throws Exception
     */
    public function destroy(Task $task): Response
    {
        try {
            $deleted = $this->taskService->delete($task);
            $response = collect(['success' => $deleted]);
        } catch (Exception $e) {
            return APIResponseHelper::getFailedResponse($e->getMessage(), 400);
        }

        return APIResponseHelper::getSuccessResponse($response);
    }

    public function markComplete(Request $request, Task $task): Response
    {
        $validator = Validator::make($request->all(), [
            'completed' => ['required', 'integer', Rule::in([Task::COMPLETED_NO, Task::COMPLETED_YES]),]
        ]);

        if ($validator->fails()) {
            return APIResponseHelper::getFailedResponse($validator->errors()->getMessages(), 400);
        }

        try {
            $task->completed = (int)$request->input('completed');
            $task->save();
        } catch (Exception $e) {
            return APIResponseHelper::getFailedResponse($e->getMessage(), 500);
        }

        return APIResponseHelper::getSuccessResponse($task);
    }
}
