<?php

namespace App\Http\Controllers\Backend\ProgramUnggulan;

use App\Http\Controllers\Controller;
use App\Interfaces\ProgramUnggulanInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\View\Components\ActionButton;
use App\View\Components\StatusPublish;
use Illuminate\Database\QueryException;

class ProgramUnggulanController extends Controller
{
    private $programUnggulanRepo;
    public function __construct(ProgramUnggulanInterface $programUnggulanRepo)
    {
        $this->programUnggulanRepo = $programUnggulanRepo;
    }
    public function index()
    {
        try {
            $slides = $this->programUnggulanRepo->getAll();

            $datatable = datatables()
                ->of($slides)
                ->addColumn('cover', fn($item) => '<img src="' . asset($item->image) . '" alt="' . $item->nama_program . '">')
                ->addColumn('nama_program', fn($item) => $item->nama_program ?? '-')
                ->addColumn('deskripsi', fn($item) => $item->deskripsi ?? '-')

                ->addColumn('status', function ($item) {
                    $statusBadge = new StatusPublish($item->is_publish);
                    return $statusBadge->render()->with($statusBadge->data());
                })
                ->addColumn('aksi', function ($item) {
                    $actionButton = new ActionButton(
                        '#',
                        '#',
                        '#'
                    );
                    return $actionButton->render()->with($actionButton->data());
                })
                ->addIndexColumn()
                ->rawColumns(['image', 'status', 'aksi'])
                ->make(true);

            return response()->json([
                'status' => 'success',
                'data' => $datatable
            ], Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database query error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
