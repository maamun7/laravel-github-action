<?php

namespace App\Services;

class UserService
{
     protected UserRepositoryInterface $userRepository;

    /**
     * Create a new operation instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll()
    {
        return $this->userRepository->all();
    }
}
