<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\AgendaInterface;
use App\View\Components\ActionButton;
use App\View\Components\StatusPublish;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AgendaController extends Controller
{
    private $agendaRepository;

    public function __construct(AgendaInterface $agendaRepository)
    {
        $this->agendaRepository = $agendaRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $agenda = $this->agendaRepository->get();
            $datatable = datatables()
                ->of($agenda)
                ->addIndexColumn()
                ->addColumn('image', function ($item) {
                    $filePath = asset('uploads/agenda/' . $item->image);
                    return '<img src="' . $filePath . '" alt="' . $item->nama . '" class="h-16 w-auto object-contain rounded">';
                })
                ->addColumn('nama', fn($item) => $item->nama)
                ->addColumn('datetime', fn($item) => $item->datetime ? date('d M Y H:i', strtotime($item->datetime)) : '-')
                ->addColumn('alamat', fn($item) => $item->alamat ?: '-')
                ->addColumn('status', function ($item) {
                    $statusBadge = new StatusPublish($item->is_publish);
                    return $statusBadge->render()->with($statusBadge->data());
                })
                ->addColumn('aksi', function ($item) {
                    $actionButton = new ActionButton(
                        $item->id,
                        url('/admin/agenda/edit') . '?id=' . $item->id,
                        $item->id
                    );
                    return $actionButton->render()->with($actionButton->data());
                })
                ->rawColumns(['image', 'status', 'aksi'])
                ->make(true);

            return $datatable;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengambil data agenda. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'datetime' => 'required|date',
                'alamat' => 'required|string',
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'is_publish' => 'required|boolean',
            ]);

            $this->agendaRepository->create($request);

            return response()->json([
                'status' => 'success',
                'message' => 'Agenda berhasil dibuat.'
            ], Response::HTTP_CREATED);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal membuat agenda. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $agenda = $this->agendaRepository->getById($id);
            return response()->json([
                'status' => 'success',
                'data' => $agenda
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengambil data agenda. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'datetime' => 'required|date',
                'alamat' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'is_publish' => 'required|boolean',
            ]);

            $this->agendaRepository->update($id, $request);

            return response()->json([
                'status' => 'success',
                'message' => 'Agenda berhasil diperbarui.'
            ], Response::HTTP_OK);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memperbarui agenda. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->agendaRepository->delete($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Agenda berhasil dihapus.'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus agenda. ' . $e->getMessage()], 500);
        }
    }
}
