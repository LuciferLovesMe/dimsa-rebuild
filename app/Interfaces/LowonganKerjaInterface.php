<?php

namespace App\Interfaces;

use App\Models\LowonganKerja;

interface LowonganKerjaInterface
{
    /**
     *
     * Get all job vacancies.
     *
     * @return \Illuminate\Database\Eloquent\Collection|LowonganKerja[]
     */
    public function getAll();

    /**
     * Get a job vacancy by its ID.
     *
     * @param int $id
     * @return LowonganKerja|null
     */
    public function getById(int $id): ?LowonganKerja;

    /**
     * Create a new job vacancy.
     *
     * @param $data
     * @return LowonganKerja
     */
    public function create($data): LowonganKerja;

    /**
     * Update an existing job vacancy.
     *
     * @param int $id
     * @param $data
     * @return LowonganKerja
     */
    public function update(int $id, $data): LowonganKerja;

    /**
     * Delete a job vacancy.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool; 
}