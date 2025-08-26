<?php
namespace App\Interfaces;

use App\Models\Qna;

interface QnaInterface
{
    public function index($type = 'all', $limit = null);

    public function store(array $data): Qna;

    public function show(int $id): Qna;

    public function update(int $id, array $data): Qna;

    public function destroy(int $id): bool;
}
