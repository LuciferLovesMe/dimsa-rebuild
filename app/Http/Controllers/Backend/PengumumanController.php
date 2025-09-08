<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\View\Components\ActionButton;
use App\View\Components\StatusPublish;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PengumumanController extends Controller
{
    private $pengumumanRepository;

    public function __construct(\App\Interfaces\PengumumanInterface $pengumumanRepository)
    {
        $this->pengumumanRepository = $pengumumanRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $pengumuman = $this->pengumumanRepository->index();
            $datatable = datatables()
                ->of($pengumuman)
                ->addIndexColumn()
                ->addColumn('judul', fn($item) => $item->judul)
                ->addColumn('tanggal', fn($item) => $item->tanggal ? date('d M Y', strtotime($item->tanggal)) : '-')
                ->addColumn('status', function ($item) {
                    $statusBadge = new StatusPublish($item->is_publish);
                    return $statusBadge->render()->with($statusBadge->data());
                })
                ->addColumn('aksi', function ($item) {
                    $actionButton = new ActionButton(
                        $item->id,
                        // Menggunakan nama rute yang benar untuk edit
                        route('admin.pengumuman.edit', ['id' => $item->id]),
                        $item->id
                    );
                    return $actionButton->render()->with($actionButton->data());
                })
                ->rawColumns(['status', 'aksi'])
                ->make(true);

            return $datatable;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengambil data pengumuman. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'tanggal' => 'required|date',
                'url' => 'nullable|url',
                'is_publish' => 'required|boolean',
            ]);

            $pengumuman = $this->pengumumanRepository->store($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Pengumuman berhasil dibuat.',
                'data' => $pengumuman
            ], Response::HTTP_CREATED);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal membuat pengumuman. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $pengumuman = $this->pengumumanRepository->show($id);
            return response()->json([
                'status' => 'success',
                'data' => $pengumuman
            ], Response::HTTP_OK);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Data pengumuman tidak ditemukan.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengambil data pengumuman. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Menambahkan validasi untuk update
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'tanggal' => 'required|date',
                'url' => 'nullable|url',
                'is_publish' => 'required|boolean',
            ]);

            $pengumuman = $this->pengumumanRepository->update($validatedData, $id);

            return response()->json([
                'status' => 'success',
                'message' => 'Pengumuman berhasil diperbarui.',
                'data' => $pengumuman
            ], Response::HTTP_OK);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memperbarui pengumuman. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->pengumumanRepository->destroy($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Pengumuman berhasil dihapus.'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus pengumuman. ' . $e->getMessage()], 500);
        }
    }
}
