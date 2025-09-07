<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\TestimoniInterface;
use App\View\Components\ActionButton;
use App\View\Components\StatusPublish;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestimoniController extends Controller
{
    private $testimoniRepository;

    public function __construct(TestimoniInterface $testimoniRepository)
    {
        $this->testimoniRepository = $testimoniRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $testimoni = $this->testimoniRepository->getAll();
            $datatable = datatables()
                ->of($testimoni)
                ->addColumn('nama', function ($item) {
                    return $item->alumni->nama_alumni;
                })
                ->addColumn('tahun_lulus', function ($item) {
                    return $item->alumni->tahun_lulus;
                })
                ->addColumn('testimoni', function ($item) {
                    return $item->testimoni;
                })
                ->addColumn('status', function ($item) {
                    $statusBadge = new StatusPublish($item->is_publish);
                    return $statusBadge->render()->with($statusBadge->data());
                })
                ->addColumn('aksi', function ($item) {
                    $actionButton = new ActionButton(
                        $item->id,
                        url('/admin/testimoni/edit') . '?id=' . $item->id,
                        $item->id
                    );
                    return $actionButton->render()->with($actionButton->data());
                })
                ->addIndexColumn()
                ->make(true);

            return $datatable;
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => 'Failed to retrieve testimonies. ' . $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            $response = [
                'status' => 'error',
                'message' => 'Failed to retrieve testimonies. ' . $e->getMessage()
            ];
            $responseCode = Response::HTTP_BAD_REQUEST;
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
            $validatedData = $request->validate([
                'alumni_id' => 'required|exists:alumnis,id',
                'testimoni' => 'required|string',
                'is_publish' => 'required|boolean',
            ]);

            $testimoni = $this->testimoniRepository->create($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Testimoni berhasil dibuat.',
                'data' => $testimoni
            ], Response::HTTP_CREATED);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY); // Kode 422
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal membuat testimoni. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $testimoni = $this->testimoniRepository->getById($id);
            if (!$testimoni) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Testimony not found.'
                ], Response::HTTP_NOT_FOUND);
            }
            return response()->json([
                'status' => 'success',
                'data' => $testimoni
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve testimony. ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve testimony. ' . $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
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
            // Menambahkan validasi untuk data yang masuk
            $validatedData = $request->validate([
                'alumni_id' => 'required|exists:alumnis,id',
                'testimoni' => 'required|string',
                'is_publish' => 'required|boolean',
            ]);

            $testimoni = $this->testimoniRepository->update($id, $validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Testimoni berhasil diperbarui.',
                'data' => $testimoni
            ], Response::HTTP_OK);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memperbarui testimoni. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->testimoniRepository->delete($id);
            $response = [
                'status' => 'success',
                'message' => 'Testimony deleted successfully.'
            ];
            $responseCode = Response::HTTP_OK;
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => 'Failed to delete testimony. ' . $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            $response = [
                'status' => 'error',
                'message' => 'Failed to delete testimony. ' . $e->getMessage()
            ];
            $responseCode = Response::HTTP_BAD_REQUEST;
        }

        return response()->json($response, $responseCode);
    }
}
