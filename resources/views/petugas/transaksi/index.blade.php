@extends('admin-lte/app')
@section('title', 'Transaksi')
@section('active-transaksi', 'active')

@section('content')
<livewire:petugas.form-peminjaman />
<livewire:petugas.transaksi></livewire:petugas.transaksi>


@endsection
@section('script')
<script>
    $(document).ready(function() {
    $('#nama_peminjam').select2({
        theme:'bootstrap'
    });
    $('#buku_id').select2({
        theme:'bootstrap'
    });
});
</script>

@endsection
