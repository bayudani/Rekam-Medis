<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Catatan Perkembangan - {{ $record->pasien?->nama }}</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 10pt;
            color: #000;
        }

        @page {
            margin: 25px;
        }

        .container {
            width: 100%;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .header-table td {
            vertical-align: top;
        }

        .pasien-info {
            width: 100%;
            margin-bottom: 15px;
        }

        .pasien-info td {
            padding: 2px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
            font-size: 12pt;
            text-decoration: underline;
        }

        .content-table {
            width: 100%;
            border-collapse: collapse;
        }

        .content-table th,
        .content-table td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
            vertical-align: top;
        }

        .content-table th {
            font-weight: bold;
            text-align: center;
            background-color: #f2f2f2;
        }

        .text-xs {
            font-size: 0.50rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- INFO PASIEN SEDERHANA -->
        {{-- <table class="pasien-info">
            <tr>
                <td width="15%"><b>Nama Pasien</b></td>
                <td width="35%">: {{ $record->pasien?->nama ?? '-' }}</td>
                <td width="15%"><b>No. RM</b></td>
                <td width="35%">: {{ $record->pasien?->no_rm ?? '-' }}</td>
            </tr>
            <tr>
                <td><b>Tgl. Lahir</b></td>
                <td>: {{ $record->pasien?->tgl_lahir ? \Carbon\Carbon::parse($record->pasien->tgl_lahir)->format('d/m/Y') : '-' }}</td>
                <td><b>Poli Tujuan</b></td>
                <td>: {{ $record->poli?->nama_poli ?? '-' }}</td>
            </tr>
        </table> --}}

        <div class="title">CATATAN PERKEMBANGAN PASIEN TERINTEGRASI</div>

        <!-- TABEL KONTEN UTAMA -->
        <table class="content-table">
            <thead>
                <tr>
                    <th width="15%">TANGGAL / JAM</th>
                    <th width="15%">PROFESIONAL PEMBERI ASUHAN (PPA)</th>
                    <th width="35%">HASIL PEMERIKSAAN, ANALISIS, RENCANA DAN PENATALAKSANAAN
                        <p class="text-xs"> (ditulis dengan format SOAP,disertai dengan target dan tujuan
                            terstruktur,evaluasi hasil tatalaksana dituliskan dalam assesment. Harap tambahan nama dan
                            paraf pada setiap akhir catatan)</p>
                    </th>
                    <th width="25%">INSTRUKSI PPA
                        <p class="text-xs">(Instruksi ditulis dengan rinci dan jelas)</p>
                    </th>
                    <th width="10%">PARAF DAN NAMA JELAS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($record->catatanPerkembangans as $catatan)
                    <tr>
                        <td>{{ $catatan->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            {{-- Menampilkan Role & Nama --}}
                            {{ ucfirst($catatan->ppa?->role) }}
                        </td>
                        <td>{!! nl2br(e($catatan->hasil_pemeriksaan)) !!}</td>
                        <td>{!! nl2br(e($catatan->instruksi_ppa)) !!}</td>
                        <td style="text-align: center;">
                            {{-- Tanda tangan digital adalah nama yang tercatat --}}
                            {{ $catatan->ppa?->name }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">Belum ada catatan perkembangan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
