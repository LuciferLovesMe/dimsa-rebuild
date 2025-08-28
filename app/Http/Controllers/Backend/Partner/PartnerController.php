<?php

namespace App\Http\Controllers\Backend\Partner;

use App\Http\Controllers\Controller;
use App\Interfaces\PartnerInterface;
use App\View\Components\ActionButton;
use App\View\Components\StatusPublish;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class PartnerController extends Controller
{
    protected $partnerRepo;

    public function __construct(PartnerInterface $partnerRepo)
    {
        $this->partnerRepo = $partnerRepo;
    }
    public function index(Request $request)
    {
        try {
            $partner = $this->partnerRepo->getAll();

            $datatable = datatables()
                ->of($partner)

                ->addColumn('logo', function ($item) {
                    $img = $item->logo;
                    return '<img src="' . $img . '" alt="' . $item->nama_mitra . '">';
                })
                ->addColumn('nama_mitra', fn($item) => $item->nama_mitra)
                ->addColumn('status', function ($item) {
                    $statusBadge = new StatusPublish($item->status);
                    return $statusBadge->render()->with($statusBadge->data());
                })
                ->addColumn('aksi', function ($item) {
                    $actionButton = new ActionButton('#', '#', '#');
                    return $actionButton->render()->with($actionButton->data());
                })
                ->addIndexColumn()
                ->rawColumns(['logo', 'status', 'aksi'])

                ->make(true);

            return response()->json([
                'status' => 'success',
                'data' => $datatable
            ], Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database query error: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve GuruStaff: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
