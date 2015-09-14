<?php

namespace Keep\Repositories;

use Keep\Entities\User;
use Keep\Entities\Priority;
use Keep\Repositories\Contracts\PriorityRepositoryInterface;

class EloquentPriorityRepository extends AbstractEloquentRepository
    implements PriorityRepositoryInterface
{
    protected $model;

    public function __construct(Priority $model)
    {
        $this->model = $model;
    }

    public function fetchAll()
    {
        return $this->model
            ->latest('value')
            ->get(['id', 'name']);
    }

    public function lists()
    {
        return $this->model
            ->latest('value')
            ->lists('name', 'id');
    }

    public function findByName($name)
    {
        return $this->model
            ->where('name', $name)
            ->firstOrFail();
    }

    public function associatedTasks($userSlug, $priorityName, $limit)
    {
        $user = User::findBySlug($userSlug);
        $priority = $this->findByName($priorityName);

        return $user->tasks()
            ->latest('created_at')
            ->where('priority_id', $priority->id)
            ->paginate($limit);
    }
}