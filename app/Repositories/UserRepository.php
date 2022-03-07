<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get\'s all records.
     *
     * @return mixed
     */
    public function all(): mixed
    {
        return $this->user->all();
    }

    /**
     * Get\'s a record by it\'s ID
     *
     * @param int
     */
    public function find(int $id): mixed
    {
        // TODO: Implement find() method.
    }

    /**
     * Create a record.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data): mixed
    {
        // TODO: Implement create() method.
    }

    /**
     * Update a record.
     *
     * @param array $data
     * @param int $id
     *
     * @return mixed
     */
    public function update(array $data, int $id): mixed
    {
        // TODO: Implement update() method.
    }

    /**
     * Delete a record.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function delete(int $id): mixed
    {
        // TODO: Implement delete() method.
    }
}
