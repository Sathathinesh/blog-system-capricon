<?php

namespace App\Repositories\Tasks;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function all()
    {
        return Task::orderBy('priority')->get();
    }

    public function find($id)
    {
        return Task::findOrFail($id);
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update(Task $task, array $data)
    {
        $task->update($data);
    }

    public function delete(Task $task)
    {
        $task->delete();
    }
}
