<?php

namespace App\Repositories\DewanYayasan;

use App\Interfaces\DewanYayasan\PengasuhInterface;
use App\Models\GuruStaff;
use App\Models\RiwayatPendidikan;
use App\Models\PengalamanKerja;
use App\Models\Prestasi;
use App\Traits\ImageHandler;
use Illuminate\Support\Facades\DB;

class PengasuhRepository implements PengasuhInterface
{
    use ImageHandler;

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $relative_path = null;

            if (isset($data['image'])) {
                $relative_path = $this->processImage($data['image'], 'DewanYayasan', 'Pengasuh');
            }

            $pengasuh = GuruStaff::create([
                'nama' => $data['nama'],
                'jabatan' => $data['jabatan'],
                'image' => $relative_path ? '/storage/' . $relative_path : null,
                'role' => 'pengasuh',
                'is_publish' => $data['is_publish'] ?? 0,
            ]);

            $id_pengasuh = $pengasuh->id;

            $this->syncRelations($id_pengasuh, $data);
            return $pengasuh;
        });
    }

    public function update(array $data, int $id)
    {
        return DB::transaction(function () use ($data, $id) {
            $pengasuh = GuruStaff::where('id', $id)
                ->where('role', 'pengasuh')
                ->first();

            if (!$pengasuh) {
                return null;
            }

            if (isset($data['image'])) {
                if ($pengasuh->image) {
                    $this->deleteImage($pengasuh->image);
                }
                $relative_path = $this->processImage($data['image'], 'DewanYayasan', 'Pengasuh');
                $pengasuh->image = '/storage/' . $relative_path;
            }

            $pengasuh->nama = $data['nama'];
            $pengasuh->jabatan = $data['jabatan'];
            $pengasuh->is_publish = $data['is_publish'] ?? 0;
            $pengasuh->save();

            $this->syncRelations($id, $data);

            return $pengasuh;
        });
    }

    public function show(int $id)
    {
        $pengasuh = GuruStaff::with(['riwayatPendidikans', 'pengalamanKerjas', 'prestasis'])->where('id', $id)
            ->where('role', 'pengasuh')
            ->first();
        if (!$pengasuh) {
            return null;
        }
        return  $pengasuh;
    }

    public function showAll(int $perPage = 10)
    {
        return GuruStaff::with(['riwayatPendidikans', 'pengalamanKerjas', 'prestasis'])
            ->where('role', 'pengasuh')
            ->paginate($perPage);
    }

    public function destroy(int $id)
    {
        return DB::transaction(function () use ($id) {
            $pengasuh = GuruStaff::where('id', $id)
                ->where('role', 'pengasuh')
                ->first();

            if (!$pengasuh) {
                return null;
            }


            if ($pengasuh->image) {
                $this->deleteImage($pengasuh->image);
            }


            RiwayatPendidikan::where('id_guru_staff', $id)->delete();
            PengalamanKerja::where('id_guru_staff', $id)->delete();
            Prestasi::where('id_guru_staff', $id)->delete();

            $pengasuh->delete();

            return $pengasuh;
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
