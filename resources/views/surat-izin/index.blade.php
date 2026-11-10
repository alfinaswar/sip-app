@extends('layouts.app')

@section('content-header')
    <div class="row mb-2 align-items-center">
        <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold text-dark">Daftar Pengajuan Rumah Dinas</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Daftar Pengajuan</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>

        @can('sip.export')
        <div class="card card-tni mb-3">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-file-export mr-2"></i>Ekspor Data Pengajuan Rumah Dinas
                </h3>
            </div>
            <div class="card-body">
                <p class="mb-3 text-muted">
                    Anda dapat mengunduh seluruh data pengajuan rumah dinas dalam format Excel atau PDF untuk keperluan
                    dokumentasi atau pelaporan. Silakan pilih salah satu tombol di bawah ini:
                </p>
                <div class="d-flex flex-wrap">
                    <a href="{{ route('exportExcel') }}" class="btn btn-success btn-sm mr-2 mb-1"
                        title="Unduh data dalam format Excel">
                        <i class="fas fa-file-excel mr-1"></i> Download Excel
                    </a>
                    <a href="{{ route('exportPdf') }}" class="btn btn-danger btn-sm mb-1"
                        title="Unduh data dalam format PDF">
                        <i class="fas fa-file-pdf mr-1"></i> Download PDF
                    </a>
                </div>
                <small class="text-secondary d-block mt-2">
                    * Pastikan data sudah benar sebelum melakukan ekspor.
                </small>
            </div>
        </div>
        @endcan

        <div class="card card-tni">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-home mr-2"></i>Daftar Pengajuan Rumah Dinas
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="pengajuanTable" class="table table-bordered table-striped table-hover table-tni"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">No</th>
                                <th>Nama</th>
                                <th>Nomor SIP</th>
                                <th>Pangkat</th>
                                <th>Jabatan</th>
                                <th>Kesatuan</th>
                                <th class="text-center" style="width: 14%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td>{{ $item->Nama }}</td>
                                    <td>{!! $item->NomorSIP !!}</td>
                                    <td>{{ $item->Pangkat }}</td>
                                    <td>{{ $item->Jabatan }}</td>
                                    <td>{{ $item->Kesatuan }}</td>
                                    <td class="text-center text-nowrap">
                                        @can('sip.view')
                                            <a href="{{ route('surat-izin.show', $item->id) }}" class="btn btn-sm btn-success"
                                                title="Cetak" target="_blank">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        @endcan
                                        @can('sip.edit')
                                            <a href="{{ route('surat-izin.edit', $item->id) }}" class="btn btn-sm btn-warning"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('sip.delete')
                                            <form action="{{ route('surat-izin.destroy', $item->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script>
        $(function () {
            var table = $('#pengajuanTable').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    zeroRecords: "Data tidak ditemukan",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    }
                },
                dom: '<"row mb-2"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 text-right"f>>rtip',
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
