<div class="mb-4">
    <h2>Form Peminjaman Buku</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label for="buku_id">Pilih Buku</label>
            <select wire:model="buku_id" id="buku_id" class="form-control">
                <option value="">Pilih Buku</option>
                @foreach($buku as $item)
                    <option value="{{ $item->id }}">{{ $item->judul }} (Stok: {{ $item->stok }})</option>
                @endforeach
            </select>
            @error('buku_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="nama_peminjam">Nama Peminjam</label>
            {{-- <input type="text" id="nama_peminjam" wire:model="nama_peminjam" class="form-control"> --}}
            <select wire:model="nama_peminjam" id="nama_peminjam" class="form-control">
                <option value="">Pilih User</option>
                @foreach($user as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('nama_peminjam') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="tanggal_pinjam">Tanggal Pinjam</label>
            <input type="date" id="tanggal_pinjam" wire:model="tanggal_pinjam" class="form-control">
            @error('tanggal_pinjam') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="tanggal_kembali">Tanggal Kembali</label>
            <input type="date" id="tanggal_kembali" wire:model="tanggal_kembali" class="form-control">
            @error('tanggal_kembali') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Pinjam Buku</button>
    </form>
</div>
