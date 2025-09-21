<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\DewanYayasan\PengasuhInterface;
use App\Interfaces\DewanYayasan\PimpinanInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DewanController extends Controller
{
    public function __construct(
        protected PimpinanInterface $pimpinanRepo,
        protected PengasuhInterface $pengasuhRepo
    ) {}

    /**
     * Menampilkan halaman index (daftar data) secara dinamis.
     */
    public function index(string $type)
    {
        return view('pages.admin.dewan.index', [
            'title'       => 'Dewan Yayasan',
            'breadcrumb3' => ucfirst($type)
        ]);
    }

    /**
     * Menampilkan form untuk membuat data baru secara dinamis.
     */
    public function create(string $type)
    {
        return view('pages.admin.dewan.create', [
            'pageTitle' => 'Tambah Data ' . ucfirst($type),
            'backUrl'   => route('admin.dewan.' . $type . '.index'),
            'postUrl'   => url('api/admin/dewan-yayasan/' . $type . '/create')
        ]);
    }

    /**
     * Menampilkan form untuk mengedit data secara dinamis.
     */
    public function edit($id, string $type)
    {
        $repository = ($type === 'pimpinan') ? $this->pimpinanRepo : $this->pengasuhRepo;
        $data = $repository->show((int) $id);

        if (!$data) {
            abort(404, 'Data ' . $type . ' tidak ditemukan.');
        }

        $imagePath = $data->image ? str_replace('/storage/', '', $data->image) : null;
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            $data->image_url = Storage::url($imagePath);
        } else {
            $data->image_url = 'https://placehold.co/400x400/e2e8f0/cbd5e0?text=No+Image';
        }

        return view('pages.admin.dewan.edit', [
            'dewan'     => $data,
            'pageTitle' => 'Edit Data ' . ucfirst($type),
            'backUrl'   => route('admin.dewan.' . $type . '.index'),
            'fetchUrl'  => url('api/admin/dewan-yayasan/' . $type . '/show/' . $id),
            'updateUrl' => url('api/admin/dewan-yayasan/' . $type . '/update/' . $id)
        ]);
    }
}
