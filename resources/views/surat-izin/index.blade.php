@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-3">
            <div class="card-header bg-light">
                <strong>Ekspor Data Pengajuan Rumah Dinas</strong>
            </div>
            <div class="card-body">
                <p class="mb-3 text-muted">
                    Anda dapat mengunduh seluruh data pengajuan rumah dinas dalam format Excel atau PDF untuk keperluan
                    dokumentasi atau pelaporan. Silakan pilih salah satu tombol di bawah ini:
                </p>
                <div class="d-flex gap-2">
                    <a href="{{ route('exportExcel') }}" class="btn btn-success btn-sm"
                        title="Unduh data dalam format Excel">
                        <i class="fa fa-file-excel-o"></i> Download Excel
                    </a>
                    <a href="{{ route('exportPdf') }}" class="btn btn-danger btn-sm" title="Unduh data dalam format PDF">
                        <i class="fa fa-file-pdf-o"></i> Download PDF
                    </a>
                </div>
                <small class="text-secondary d-block mt-2">
                    * Pastikan data sudah benar sebelum melakukan ekspor.
                </small>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-white" style="background-color: #4b5320;">
                <h5 class="mb-0"><i class="fa fa-home"></i> Daftar Pengajuan Rumah Dinas</h5>
            </div>
            <div class="card-body">

                <table id="pengajuanTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nomor SIP</th>
                            <th>Pangkat</th>
                            <th>Jabatan</th>
                            <th>Kesatuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->Nama }}</td>
                                <td>{{ $item->NomorSIP }}</td>
                                <td>{{ $item->Pangkat }}</td>
                                <td>{{ $item->Jabatan }}</td>
                                <td>{{ $item->Kesatuan }}</td>
                                <td>
                                    <a href="{{ route('surat-izin.show', $item->id) }}" class="btn btn-sm btn-success"
                                        title="Cetak" target="_blank">
                                        <i class="fa fa-print"></i>
                                    </a>
                                    <a href="{{ route('surat-izin.edit', $item->id) }}" class="btn btn-sm btn-warning"><i
                                            class="fa fa-edit"></i></a>
                                    <form action="{{ route('surat-izin.destroy', $item->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script>
        $(function () {
            var table = $('#pengajuanTable').DataTable({
                dom: '<"row mb-3"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-end"f>>tip',
                // dom di atas mengatur search (f) ke kanan, length (l) ke kiri
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Daftar Pengajuan Rumah Dinas',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                        filename: 'daftar_pengajuan_rumah_dinas'
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Daftar Pengajuan Rumah Dinas',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                        filename: 'daftar_pengajuan_rumah_dinas',
                        orientation: 'landscape',
                        pageSize: 'A4'
                    }
                ]
            });

            $('#btnExcel').on('click', function () {
                table.button(0).trigger();
            });
            $('#btnPdf').on('click', function () {
                table.button(1).trigger();
            });
        });
    </script>
@endpush