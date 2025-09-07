<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\PublikasiInterface;
use App\View\Components\ActionButton;
use App\View\Components\StatusPublish;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MajalahController extends Controller
{
    private $publikasiRepository;

    public function __construct(PublikasiInterface $publikasiRepository)
    {
        $this->publikasiRepository = $publikasiRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $majalah = $this->publikasiRepository->getMajalah();
            $datatable = datatables()
                ->of($majalah)
                ->addColumn('judul', function ($item) {
                    return $item->judul;
                })
                ->addColumn('penulis', function ($item) {
                    return $item->penulis;
                })
                ->addColumn('tanggal', function ($item) {
                    return $item->tanggal_terbit ? date('d M Y', strtotime($item->tanggal_terbit)) : '-';
                })
                ->addColumn('image', function ($item) {
                    $filePath = asset('uploads/publikasi/majalah/' . $item->image);
                    return '<img src="' . $filePath . '" alt="' . $item->judul . '" class="h-20 w-auto object-contain rounded">';
                })
                ->addColumn('aksi', function ($item) {
                    $actionButton = new ActionButton(
                        $item->id,
                        url('/admin/majalah/edit') . '?id=' . $item->id,
                        $item->id
                    );
                    return $actionButton->render()->with($actionButton->data());
                })
                ->addColumn('status', function ($item) {
                    $statusBadge = new StatusPublish($item->is_publish);
                    return $statusBadge->render()->with($statusBadge->data());
                })
                ->rawColumns(['image'])
                ->addIndexColumn()
                ->make(true);

            return $datatable;
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            $response = [
                'status' => 'error',
                'message' => 'Database query error: ' . $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json($response, $responseCode);
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
            $request->validate([
                'judul' => 'required|string|max:255',
                'penulis' => 'required|string|max:100',
                'tanggal_terbit' => 'required|date',
                'url' => 'required|url',
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'is_publish' => 'nullable|boolean',
            ]);

            $this->publikasiRepository->createMajalah($request);

            return response()->json([
                'status' => 'success',
                'message' => 'Majalah berhasil dibuat.'
            ], Response::HTTP_CREATED);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $response = [
                'status' => 'success',
                'data' => $this->publikasiRepository->getMajalahById($id)
            ];
            $responseCode = Response::HTTP_OK;
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            $response = [
                'status' => 'error',
                'message' => 'Database query error: ' . $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json($response, $responseCode);
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
            $response = [
                'status' => 'success',
                'data' => $this->publikasiRepository->updateMajalah($id, $request)
            ];
            $responseCode = Response::HTTP_OK;
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            $response = [
                'status' => 'error',
                'message' => 'Database query error: ' . $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json($response, $responseCode);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->publikasiRepository->deleteMajalah($id);
            $response = [
                'status' => 'success',
                'message' => 'Majalah deleted successfully.'
            ];
            $responseCode = Response::HTTP_OK;
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            $response = [
                'status' => 'error',
                'message' => 'Database query error: ' . $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json($response, $responseCode);
    }
}
