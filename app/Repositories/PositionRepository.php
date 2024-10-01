<?php

namespace App\Repositories;

use App\Models\Tenants\HRIS\Position;

class PositionRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private Position $position
    ) {
    }

    public function get()
    {
        return $this->position->get();
    }

    public function create(array $data)
    {
        return $this->position->create($data);
    }

    public function show(Position $position)
    {
        return $position;
    }

    public function update(Position $position, array $data)
    {
        return tap($position)->update($data);
    }

    public function delete(Position $position)
    {
        return $position->delete();
    }
}
