<?php

namespace App\Repositories\DewanYayasan;

use App\Interfaces\DewanYayasan\PimpinanInterface;
use App\Models\GuruStaff;
use App\Models\RiwayatPendidikan;
use App\Models\PengalamanKerja;
use App\Models\Prestasi;
use App\Traits\ImageHandler;
use Illuminate\Support\Facades\DB;

class PimpinanRepository implements PimpinanInterface
{
    use ImageHandler;

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $relative_path = null;

            if (isset($data['image'])) {
                $relative_path = $this->processImage($data['image'], 'DewanYayasan', 'Pimpinan');
            }

            $pimpinan = GuruStaff::create([
                'nama' => $data['nama'],
                'jabatan' => $data['jabatan'],
                'image' => $relative_path ? '/storage/' . $relative_path : null,
                'role' => 'pimpinan',
                'is_publish' => $data['is_publish'] ?? 0,
            ]);

            $id_pimpinan = $pimpinan->id;

            $this->syncRelations($id_pimpinan, $data);


            return $pimpinan;
        });
    }

    public function update(array $data, int $id)
    {
        return DB::transaction(function () use ($data, $id) {
            $pimpinan = GuruStaff::where('id', $id)
                ->where('role', 'pimpinan')
                ->first();


            if (!$pimpinan) {
                return null;
            }

            if (isset($data['image'])) {
                if ($pimpinan->image) {
                    $this->deleteImage($pimpinan->image);
                }
                $relative_path = $this->processImage($data['image'], 'DewanYayasan', 'Pimpinan');
                $pimpinan->image = '/storage/' . $relative_path;
            }

            $pimpinan->nama = $data['nama'];
            $pimpinan->jabatan = $data['jabatan'];
            $pimpinan->is_publish = $data['is_publish'] ?? 0;
            $pimpinan->save();

            $this->syncRelations($id, $data);


            return $pimpinan;
        });
    }

    public function show(int $id)
    {
        $pimpinan = GuruStaff::with(['riwayatPendidikans', 'pengalamanKerjas', 'prestasis'])->where('id', $id)
            ->where('role', 'pimpinan')
            ->first();
        if (!$pimpinan) {
            return null;
        }
        return  $pimpinan;
    }

    public function showAll(int $perPage = 10)
    {
        return GuruStaff::with(['riwayatPendidikans', 'pengalamanKerjas', 'prestasis'])
            ->where('role', 'pimpinan')
            ->paginate($perPage);
    }
        public function showGuest()
    {
        return GuruStaff::where('role', 'pimpinan')->where('is_publish', 1)->get();
    }

    public function showGuestByID($id)
    {
        return GuruStaff::with(['riwayatPendidikans', 'pengalamanKerjas', 'prestasis'])
            ->where('role', 'pimpinan')
            ->where('is_publish', 1)
            ->findOrFail($id);
    }

    public function destroy(int $id)
    {
        return DB::transaction(function () use ($id) {
            $pimpinan = GuruStaff::where('id', $id)
                ->where('role', 'pimpinan')
                ->first();

            if (!$pimpinan) {
                return null;
            }


            if ($pimpinan->image) {
                $this->deleteImage($pimpinan->image);
            }


            RiwayatPendidikan::where('id_guru_staff', $id)->delete();
            PengalamanKerja::where('id_guru_staff', $id)->delete();
            Prestasi::where('id_guru_staff', $id)->delete();

            $pimpinan->delete();

            return $pimpinan;
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