<?php

namespace App\Repositories;

use App\Interfaces\LowonganKerjaInterface;
use App\Models\KualifikasiLowonganKerja;
use App\Models\LowonganKerja;
use Illuminate\Database\Eloquent\Collection;

class LowonganKerjaRepository implements LowonganKerjaInterface
{
    /**
     * Get all job vacancies.
     *
     * @return Collection|LowonganKerja[]
     */
    public function getAll(): Collection
    {
        return LowonganKerja::with('kualifikasi')->get();
    }
    /**
     * Get a job vacancy by its ID.
     *
     * @param int $id
     * @return LowonganKerja|null
     */
    public function getById(int $id): ?LowonganKerja
    {
        return LowonganKerja::with('kualifikasi')->find($id);
    }
    /**
     * Create a new job vacancy.
     * @param $data
     * @return LowonganKerja
     */ 
    public function create($data): LowonganKerja
    {
        $lowonganKerja = new LowonganKerja();
        $lowonganKerja->posisi = $data->posisi;
        $lowonganKerja->deskripsi = $data->deskripsi;
        $lowonganKerja->tanggal_mulai = $data->tanggal_mulai;
        $lowonganKerja->tanggal_selesai = $data->tanggal_selesai;
        $lowonganKerja->is_publish = $data->is_publish ?? false;
        
        $file =  $data->file('file');
        
        $path = public_path() . '/uploads/lowongan_kerja/';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $fileType = $file->getClientOriginalExtension();
        $fileName = time() . '.' . $fileType;
        $lowonganKerja->file = $fileName;
        $lowonganKerja->save();

        foreach ($data->deskripsi_kualifikasi as $key => $item) {
            KualifikasiLowonganKerja::create([
                'lowongan_kerja_id' => $lowonganKerja->id,
                'deskripsi' => $item
            ]);
        }
        
        return $lowonganKerja;
    }
    /**
     * Update an existing job vacancy.
     * @param int $id
     * @param $data
     * @return LowonganKerja
     * */
    public function update(int $id, $data): LowonganKerja
    {
        $lowonganKerja = LowonganKerja::findOrFail($id);
        $lowonganKerja->posisi = $data->posisi;
        $lowonganKerja->deskripsi = $data->deskripsi;
        $lowonganKerja->tanggal_mulai = $data->tanggal_mulai;
        $lowonganKerja->tanggal_selesai = $data->tanggal_selesai;
        $lowonganKerja->is_publish = $data->is_publish ?? false;
        
        if ($data->hasFile('file')) {   
            $file =  $data->file('file');
            $path = public_path() . '/uploads/lowongan_kerja/';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
        
            $fileType = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $fileType;
            $lowonganKerja->file = $fileName;
        }
        $lowonganKerja->save();

        foreach ($data->deskripsi_kualifikasi as $key => $item) {
            $kualifikasi = KualifikasiLowonganKerja::find($data->kualifikasi_id[$key]);
            if ($kualifikasi) {
                $kualifikasi->deskripsi = $item;
                $kualifikasi->save();
            }
        }

        return $lowonganKerja;
    }
    /**
     * Delete a job vacancy.
     * @param int $id
     * @return bool
     */ 
    public function delete(int $id): bool
    {
        $lowonganKerja = $this->getById($id);
        if ($lowonganKerja) {
            return $lowonganKerja->delete();
        }
        return false;
    }
}