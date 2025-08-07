<?php
namespace App\Interfaces;


interface PengumumanInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index($request);

    /**
     * Store a newly created resource in storage.
     */
    public function store($request);

    /**
     * Display the specified resource.
     */
    public function show($id);

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id);

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id);

}