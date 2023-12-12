<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Tasks\TaskRepositoryInterface;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index()
    {
        $tasks = $this->taskRepository->all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(TaskRequest $request)
    {
        $data = $request->validated();

        $this->taskRepository->create($data);

        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $task = $this->taskRepository->find($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(TaskRequest $request, $id)
    {
        $data = $request->validated();

        $task = $this->taskRepository->find($id);
        $this->taskRepository->update($task, $data);

        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $task = $this->taskRepository->find($id);
        $this->taskRepository->delete($task);

        return redirect()->route('tasks.index');
    }

}
