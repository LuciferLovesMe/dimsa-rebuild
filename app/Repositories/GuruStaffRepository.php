<?php

namespace App\Repositories;

use App\Interfaces\GuruStaffInterface;
use App\Models\GuruStaff;
use App\Models\RiwayatPendidikan;
use App\Models\PengalamanKerja;
use App\Models\Prestasi;
use App\Traits\ImageHandler;
use Illuminate\Support\Facades\DB;

class GuruStaffRepository implements GuruStaffInterface
{
    use ImageHandler;

    public function store(array $data, $image = null)
    {
        return DB::transaction(function () use ($data, $image) {
            $relative_path = null;
            if ($image) {
                $relative_path = $this->processImage($image, 'GuruStaff');
                $data['image'] = '/storage/' . $relative_path;
            }

            $data['role'] = 'gurustaff';
            $data['is_publish'] = $data['is_publish'] ?? 0;

            $guru_staff = GuruStaff::create($data);

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

            if ($image) {
                if ($guru_staff->image) {
                    $this->deleteImage($guru_staff->image);
                }
                $relative_path = $this->processImage($image, 'GuruStaff');
                $data['image'] = '/storage/' . $relative_path;
            }

            $guru_staff->update([
                'nama'       => $data['nama'],
                'jabatan'    => $data['jabatan'],
                'image'      => $data['image'] ?? $guru_staff->image,
                'is_publish' => $data['is_publish'] ?? 0,
            ]);

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
        return  $guru_staff;
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
