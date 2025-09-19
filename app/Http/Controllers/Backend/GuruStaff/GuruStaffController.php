<?php

namespace App\Http\Controllers\Backend\GuruStaff;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuruStaff\AddGuruStaffRequest;
use App\Http\Requests\GuruStaff\UpdateGuruStaffRequest;
use App\Interfaces\GuruStaffInterface;
use App\Models\GuruStaff;
use Illuminate\Support\Facades\Storage;
use App\View\Components\ActionButton;
use App\View\Components\StatusPublish;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;

class GuruStaffController extends Controller
{
    protected $guruStaffRepo;

    public function __construct(GuruStaffInterface $guruStaffRepo)
    {
        $this->guruStaffRepo = $guruStaffRepo;
    }

    public function index()
    {
        try {

            $pengasuh = $this->guruStaffRepo->showAll();

            $datatable = datatables()
                ->of($pengasuh)
                ->addIndexColumn()
                ->addColumn('image', function ($item) {
                    $rawImagePath = $item->getRawOriginal('image');

                    if ($rawImagePath) {
                        $cleanPath = str_replace('storage/', '', $rawImagePath);
                        $cleanPath = ltrim($cleanPath, '/');

                        $img = asset('storage/' . $cleanPath);
                    } else {
                        $img = 'https://via.placeholder.com/300x300.png?text=No+Image';
                    }

                    // 5. Kembalikan tag <img> dengan URL yang sudah benar.
                    return '<img src="' . $img . '" alt="' . $item->nama . '" class="w-16 h-16 object-cover rounded">';
                })
                ->addColumn('nama', fn($item) => $item->nama)
                ->addColumn('jabatan', fn($item) => $item->jabatan)
                ->addColumn('status', function ($item) {
                    $statusBadge = new StatusPublish($item->is_publish);
                    return $statusBadge->render()->with($statusBadge->data());
                })
                ->addColumn('aksi', function ($item) {
                    $actionButton = new ActionButton(
                        $item->id,
                        route('admin.staff.edit', $item->id),
                        $item->id,
                    );
                    return $actionButton->render()->with($actionButton->data());
                })
                ->rawColumns(['image', 'status', 'aksi'])
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
                'message' => 'Failed to retrieve pengasuh: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function create()
    {
        return view('pages.admin.staff.create');
    }

    public function edit(GuruStaff $guruStaff)
    {
        return view('pages.admin.staff.edit', compact('guruStaff'));
    }
}
