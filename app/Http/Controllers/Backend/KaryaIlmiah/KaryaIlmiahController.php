<?php

namespace App\Http\Controllers\Backend\KaryaIlmiah;

use App\Http\Controllers\Controller;
use App\Interfaces\KaryaIlmiahInterface;
use Illuminate\Http\Request;

class KaryaIlmiahController extends Controller
{
    protected $karyaIlmiahRepo;

    public function __construct(KaryaIlmiahInterface $karyaIlmiahRepo)
    {
        $this->karyaIlmiahRepo = $karyaIlmiahRepo;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); 
        $karyaIlmiah = $this->karyaIlmiahRepo->showAll($perPage);

        $datatable = datatables()
            ->of($karyaIlmiah)
            ->addIndexColumn()
            ->addColumn('judul', fn($item) => $item->judul)
            ->addColumn('penulis', fn($item) => $item->penulis)
            ->addColumn('tahun', fn($item) => $item->tahun)
            ->addColumn('status', fn($item) => $item->is_publish ? 'Published' : 'Draft')
            ->make(true);

        return response()->json([
            'status' => 'success',
            'data' => $datatable
        ], 200);
    }
}
