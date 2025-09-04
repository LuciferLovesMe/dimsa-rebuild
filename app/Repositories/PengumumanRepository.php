<?php

namespace App\Repositories;

use App\Interfaces\PengumumanInterface;
use App\Models\Pengumuman;

class PengumumanRepository implements PengumumanInterface
{
    protected $pengumuman;
    public function __construct(Pengumuman $pengumuman)
    {
        $this->pengumuman = $pengumuman;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index($type = 'all', $limit = null)
    {
        if ($type === 'published') {
            $pengumuman = $this->pengumuman
                ->where('is_publish', true);
        } else {
            $pengumuman = $this->pengumuman;
        }

        if ($limit) {
            $pengumuman = $pengumuman->limit($limit);
        }

        return $pengumuman
            ->orderBy('id', 'desc')
            ->get();
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $data
     * @return \App\Models\Pengumuman
     */
    public function store($data)
    {
        return $this->pengumuman->create($data);
    }
    
    /**
     * Display the specified resource.
     *  
     *  @param  int  $id
     *  @return \App\Models\Pengumuman
     */
    public function show($id)
    {
        return $this->pengumuman->findOrFail($id);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  array  $data
     * @param  int  $id
     * @return \App\Models\Pengumuman
     */
    public function update($data, $id)
    {
        $pengumuman = $this->pengumuman->findOrFail($id);
        $pengumuman->update($data);
        return $pengumuman;
    }
    
    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return bool|null
     */
    public function destroy($id)
    {
        $pengumuman = $this->pengumuman->findOrFail($id);
        return $pengumuman->delete();
    }

    /**
     * Additional methods can be added here as needed.
     */
}