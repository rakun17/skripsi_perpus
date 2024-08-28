<?php

namespace App\Http\Livewire\Petugas;

use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\User;
use Livewire\Component;

class FormPeminjaman extends Component
{
    public $buku_id, $nama_peminjam, $tanggal_pinjam, $tanggal_kembali;

    protected $rules = [
        'buku_id' => 'required|exists:buku,id',
        'nama_peminjam' => 'required|string|max:255',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
    ];

    public function submit()
    {
        $this->validate();

        $peminjaman = Peminjaman::create([
            'kode_pinjam' => random_int(100000000, 999999999),
            'buku_id' => $this->buku_id,
            'peminjam_id' => $this->nama_peminjam,
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => $this->tanggal_kembali,
            'status' => 2, // 1 = belum dipinjam
            'petugas_pinjam' => auth()->user()->id,
        ]);
        DetailPeminjaman::create([
            'peminjaman_id' => $peminjaman->id,
            'buku_id' => $this->buku_id
        ]);

        // Kurangi stok buku
        $buku = Buku::find($this->buku_id);
        $buku->decrement('stok');

        session()->flash('message', 'Peminjaman berhasil dibuat.');

        // Reset form
        $this->reset();
    }

    public function render() //pengecekan
    {
        $buku = Buku::where('stok', '>', 0)->get(); // Hanya buku yang stoknya masih tersedia
        $user = User::all(); // Hanya buku yang stoknya masih tersedia
        return view('livewire.petugas.form-peminjaman', ['buku' => $buku,'user' => $user]);
    }
}
