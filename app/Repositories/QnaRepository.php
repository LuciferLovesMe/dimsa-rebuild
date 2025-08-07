<?php
namespace App\Repositories;

use App\Interfaces\QnaInterface;
use App\Models\Qna;

class QnaRepository implements QnaInterface
{
    public function index()
    {
        return Qna::all();
    }

    public function store(array $data): Qna
    {
        return Qna::create($data);
    }

    public function show(int $id): Qna
    {
        return Qna::findOrFail($id);
    }

    public function update(int $id, array $data): Qna
    {
        $qna = Qna::findOrFail($id);
        $qna->update($data);
        return $qna;
    }

    public function destroy(int $id): bool
    {
        return Qna::destroy($id);
    }
}
