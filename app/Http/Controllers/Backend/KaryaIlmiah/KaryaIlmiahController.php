<?php

namespace App\Http\Controllers\Backend\KaryaIlmiah;

use App\Http\Controllers\Controller;
use App\Interfaces\KaryaIlmiahInterface;
use App\View\Components\ActionButton;
use App\View\Components\StatusPublish;
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

        $karyaIlmiah = $this->karyaIlmiahRepo->showAll();

        $datatable = datatables()
            ->of($karyaIlmiah)

            ->addColumn('judul', fn($item) => $item->judul)
            ->addColumn('penulis', fn($item) => $item->penulis)
            ->addColumn('tahun', fn($item) => $item->tahun)
            ->addColumn('status', function ($item) {
                $statusBadge = new StatusPublish($item->is_publish);
                return $statusBadge->render()->with($statusBadge->data());
            })
            ->addColumn('aksi', function ($item) {
                $actionButton = new ActionButton(
                    '#',
                    '#',
                    '#',
                );
                return $actionButton->render()->with($actionButton->data());
            })
            ->addIndexColumn()
            ->rawColumns(['status', 'aksi'])
            ->make(true);

        return response()->json([
            'status' => 'success',
            'data' => $datatable
        ], 200);
    }
}
