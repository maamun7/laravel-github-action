<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    /**
     * Get\'s all records.
     *
     * @return mixed
     */
    public function all(): mixed;

    /**
     * Get\'s a record by it\'s ID
     *
     * @param int
     */
    public function find(int $id);

    /**
     * Create a record.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data): mixed;

    /**
     * Update a record.
     *
     * @param array $data
     * @param int $id
     *
     * @return mixed
     */
    public function update(array $data, int $id): mixed;

    /**
     * Delete a record.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function delete(int $id): mixed;
}
