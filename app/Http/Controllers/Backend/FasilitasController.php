<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\FasilitasInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FasilitasController extends Controller
{
    private $fasilitasRepository;

    public function __construct(FasilitasInterface $fasilitasRepository)
    {
        $this->fasilitasRepository = $fasilitasRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('backend.fasilitas.index');
        }

        try {
            $response = [
                'status' => 'success',
                'data' => $this->fasilitasRepository->index()
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
                'message' => 'Database query error'
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
            $fasilitas = $this->fasilitasRepository->store($request);
            $response = [
                'status' => 'success',
                'data' => $fasilitas
            ];
            $responseCode = Response::HTTP_CREATED;
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            $response = [
                'status' => 'error',
                'message' => 'Database query error'
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json($response, $responseCode);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $fasilitas = $this->fasilitasRepository->show($id);
            $response = [
                'status' => 'success',
                'data' => $fasilitas
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
                'message' => 'Database query error'
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
            $fasilitas = $this->fasilitasRepository->update($id, $request);
            $response = [
                'status' => 'success',
                'data' => $fasilitas
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
                'message' => 'Database query error'
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
            $this->fasilitasRepository->destroy($id);
            $response = [
                'status' => 'success',
                'message' => 'Resource deleted successfully'
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
                'message' => 'Database query error'
            ];
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json($response, $responseCode);
    }
}
