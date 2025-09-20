<?php

namespace App\Repositories;

use App\Interfaces\GuruStaffInterface;
use App\Models\GuruStaff;
use App\Models\RiwayatPendidikan;
use App\Models\PengalamanKerja;
use App\Models\Prestasi;
use App\Traits\ImageHandler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GuruStaffRepository implements GuruStaffInterface
{
    use ImageHandler;

    public function store(array $data, $image = null)
    {
        return DB::transaction(function () use ($data, $image) {
            $guruStaffData = [
                'nama'       => $data['nama'],
                'jabatan'    => $data['jabatan'],
                'role'       => 'gurustaff',
                'is_publish' => $data['is_publish'] ?? 0,
            ];

            if ($image) {
                $guruStaffData['image'] = $this->processImage($image, 'GuruStaff');
            }

            $guru_staff = GuruStaff::create($guruStaffData);

            $this->syncRelations($guru_staff->id, $data);

            return $guru_staff;
        });
    }

    public function update(int $id, array $data, $image = null)
    {
        return DB::transaction(function () use ($id, $data, $image) {
            $guru_staff = GuruStaff::where('id', $id)
                ->where('role', 'gurustaff')
                ->first();
            if (!$guru_staff) {
                return null;
            }

            // Siapkan data utama untuk diupdate
            $updateData = [
                'nama'       => $data['nama'],
                'jabatan'    => $data['jabatan'],
                'is_publish' => $data['is_publish'] ?? 0,
            ];

            if ($image) {
                if ($guru_staff->image) {
                    $this->deleteImage($guru_staff->image);
                }
                $updateData['image'] = $this->processImage($image, 'GuruStaff');
            }

            $guru_staff->update($updateData);

            $this->syncRelations($id, $data);

            return $guru_staff;
        });
    }

    public function show(int $id)
    {
        $guru_staff = GuruStaff::with(['riwayatPendidikans', 'pengalamanKerjas', 'prestasis'])->where('id', $id)
            ->where('role', 'gurustaff')
            ->first();
        if (!$guru_staff) {
            return null;
        }

        if ($guru_staff->image && Storage::disk('public')->exists($guru_staff->image)) {
            $guru_staff->image_url = Storage::url($guru_staff->image);
        } else {
            $guru_staff->image_url = 'https://placehold.co/400x400/e2e8f0/cbd5e0?text=No+Image';
        }
        return $guru_staff;
    }


    public function showGuestByID($id)
    {
        return GuruStaff::with(['riwayatPendidikans', 'pengalamanKerjas', 'prestasis'])
            ->where('role', 'gurustaff')
            ->where('is_publish', 1)
            ->findOrFail($id);
    }

    public function showAll()
    {
        return GuruStaff::where('role', 'gurustaff')
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function showGuest()
    {
        return GuruStaff::where('role', 'gurustaff')->where('is_publish', 1)->get();
    }

    public function destroy(int $id)
    {
        return DB::transaction(function () use ($id) {
            $guru_staff = GuruStaff::where('id', $id)
                ->where('role', 'gurustaff')
                ->first();

            if (!$guru_staff) {
                return null;
            }


            if ($guru_staff->image) {
                $this->deleteImage($guru_staff->image);
            }

            RiwayatPendidikan::where('id_guru_staff', $id)->delete();
            PengalamanKerja::where('id_guru_staff', $id)->delete();
            Prestasi::where('id_guru_staff', $id)->delete();

            $guru_staff->delete();

            return true;
        });
    }

    private function syncRelations(int $id, array $data)
    {

        RiwayatPendidikan::where('id_guru_staff', $id)->delete();
        foreach ($data['riwayat_pendidikan'] ?? [] as $riwayat) {
            RiwayatPendidikan::create([
                'id_guru_staff' => $id,
                'tingkat_pendidikan' => $riwayat['tingkat_pendidikan'],
                'instansi' => $riwayat['instansi'] ?? null,
                'tahun_mulai' => $riwayat['tahun_mulai'],
                'tahun_akhir' => $riwayat['tahun_akhir'] ?? null,
            ]);
        }

        PengalamanKerja::where('id_guru_staff', $id)->delete();
        foreach ($data['pengalaman_kerja'] ?? [] as $pengalaman) {
            PengalamanKerja::create([
                'id_guru_staff' => $id,
                'posisi' => $pengalaman['posisi'],
                'kota' => $pengalaman['kota'],
                'perusahaan' => $pengalaman['perusahaan'] ?? null,
                'tahun_mulai' => $pengalaman['tahun_mulai'],
                'tahun_akhir' => $pengalaman['tahun_akhir'] ?? null,
            ]);
        }

        Prestasi::where('id_guru_staff', $id)->delete();
        foreach ($data['prestasis'] ?? [] as $prestasi) {
            Prestasi::create([
                'id_guru_staff' => $id,
                'nama_lomba' => $prestasi['nama_lomba'],
                'penyelenggara' => $prestasi['penyelenggara'] ?? null,
                'tingkat' => $prestasi['tingkat'],
                'predikat' => $prestasi['predikat'],
                'tahun' => $prestasi['tahun'],
            ]);
        }
    }
}
