<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Formulir Triase - {{ $record->pasien?->nama }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 8pt;
            /* Ukuran font base lebih kecil */
            color: #000;
        }

        @page {
            margin: 15px;
        }

        .container {
            width: 100%;
        }

        /* Header Disesuaikan */
        .header {
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin-bottom: 8px;
            overflow: hidden;
            /* Clearfix */
        }

        .header-left {
            float: left;
            width: 15%;
            /* Sesuaikan lebar logo */
            text-align: left;
        }

        .header-center {
            float: left;
            width: 70%;
            text-align: center;
        }

        .header-right {
            float: right;
            width: 15%;
            /* Sesuaikan lebar teks kanan */
            text-align: right;
            font-size: 10pt;
            font-weight: bold;
            padding-top: 5px;
            /* Sesuaikan posisi vertikal */
        }

        .header h3 {
            margin: 0;
            font-size: 10pt;
            /* Lebih kecil */
        }

        .header p {
            margin: 0;
            font-size: 7pt;
            line-height: 1.2;
        }

        .logo {
            width: 50px;
            /* Ukuran logo disesuaikan */
            height: auto;
        }


        .title {
            text-align: center;
            font-weight: bold;
            font-size: 10pt;
            margin: 8px 0;
            border: 1px solid #000;
            padding: 3px;
            background-color: #e0e0e0;
            /* Warna abu lebih muda */
        }

        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
            font-size: 7pt;
            /* Font tabel lebih kecil lagi */
        }

        .content-table td,
        .content-table th {
            border: 1px solid black;
            padding: 2px;
            /* Padding lebih kecil */
            vertical-align: top;
            line-height: 1.3;
            /* Sedikit renggang */
        }

        /* No border cell */
        .no-border-cell {
            border: none !important;
        }

        /* No border table */
        .no-border-table {
            width: 100%;
            border-collapse: collapse;
        }

        .no-border-table td {
            border: none !important;
            padding: 0 2px 0 0;
            /* Minimal padding */
            vertical-align: top;
        }


        .content-table th {
            background-color: #d0d0d0;
            /* Warna abu header tabel */
            font-weight: bold;
            text-align: center;
        }

        /* Header kolom spesifik */
        .th-red {
            background-color: #DC143C;
            color: #fff;
        }

        .th-yellow {
            background-color: #FFD700;
        }

        .th-green {
            background-color: #90EE90;
        }

        /* Style baru untuk header False Emergency (Biru) */
        .th-blue {
            background-color: #ADD8E6;
            /* LightBlue */
        }

        /* Style untuk header di dalam TD */
        .td-header {
            font-weight: bold;
            text-align: center;
            padding: 1px;
            /* Padding minimal */
            margin: -2px -2px 2px -2px;
            /* Negatif margin biar nempel border TD */
        }

        .th-black {
            background-color: #000000;
            color: #fff;
        }


        .section-title {
            background-color: #d0d0d0;
            text-align: center;
            font-weight: bold;
            padding: 3px;
            font-size: 8pt;
        }

        .subsection-title {
            font-weight: bold;
            margin: 2px 0;
            /* text-decoration: underline; */
            /* Di gambar tidak underline */
            font-size: 7.5pt;
        }

        .checkbox-item {
            display: inline-block;
            margin-right: 5px;
            /* Jarak lebih rapat */
            white-space: nowrap;
            font-size: 7pt;
        }

        /* Style baru untuk checkbox item block */
        .checkbox-item-block {
            display: block;
            /* Agar setiap item di baris baru */
            margin-bottom: 1px;
            /* Jarak antar item */
            white-space: nowrap;
            font-size: 7pt;
            padding-left: 5px;
            /* Indentasi sedikit */
            line-height: 1.1;
            /* Sedikit rapatkan line-height */
            min-height: 11px;
            /* Beri tinggi minimum biar rata */
        }


        .checkbox {
            display: inline-block;
            width: 9px;
            /* Checkbox lebih kecil */
            height: 9px;
            border: 1px solid black;
            margin-right: 2px;
            text-align: center;
            line-height: 9px;
            vertical-align: middle;
            font-size: 7pt;
            font-weight: bold;
            /* Tanda check bold */
        }

        .color-box {
            display: inline-block;
            width: 15px;
            /* Box warna lebih kecil */
            height: 10px;
            vertical-align: middle;
            margin-left: 2px;
            border: 1px solid #000;
        }

        .red {
            background-color: #DC143C;
        }

        /* Crimson */
        .yellow {
            background-color: #FFD700;
        }

        /* Gold */
        .green {
            background-color: #90EE90;
        }

        /* LightGreen */
        .black {
            background-color: #000000;
        }

        /* === CSS Skala Nyeri Horizontal (dari asesmen_gigi_mulut) === */
        .pain-scale-table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            margin-top: 5px;
        }

        .pain-scale-table td {
            padding: 1px 0;
            vertical-align: top;
            width: 9.09%;
            /* 100% / 11 kolom */
            border: none;
            /* Hapus border sel */
        }

        .pain-scale-labels td {
            font-size: 8pt;
            font-weight: bold;
            padding-bottom: 2px;
        }

        .pain-scale-bar td {
            height: 10px;
            padding: 0;
            font-size: 1px;
            line-height: 1px;
        }

        /* Gradasi warna PDF-safe */
        .grad-0 {
            background-color: #5cb85c;
        }

        .grad-1 {
            background-color: #7EC368;
        }

        .grad-2 {
            background-color: #A0CE74;
        }

        .grad-3 {
            background-color: #C2D980;
        }

        .grad-4 {
            background-color: #E4E48C;
        }

        .grad-5 {
            background-color: #FFFF99;
        }

        .grad-6 {
            background-color: #F8D57D;
        }

        .grad-7 {
            background-color: #F1AC61;
        }

        .grad-8 {
            background-color: #E98445;
        }

        .grad-9 {
            background-color: #E25B29;
        }

        .grad-10 {
            background-color: #d9534f;
        }

        .pain-scale-ticks td {
            font-size: 9pt;
            line-height: 0.5;
            padding-top: 0;
            border-left: 1px solid #000;
        }

        .pain-scale-ticks td:first-child {
            border-left: none;
        }

        /* Hapus border tick pertama */
        .pain-scale-ticks .tick-label {
            display: inline-block;
            margin-top: -2px;
            /* Tarik ke atas */
        }


        .pain-scale-faces td {
            font-size: 7pt;
            line-height: 1.1;
            vertical-align: top;
            padding-top: 3px;
        }

        .pain-scale-faces .emoji {
            line-height: 1;
        }

        /* Style untuk gambar emoji */
        .pain-scale-faces .emoji img {
            width: 25px;
            /* Ukuran gambar disesuaikan */
            height: 25px;
            display: block;
            margin: 0 auto 2px auto;
            /* Posisikan di tengah */
        }

        .pain-scale-faces .face-title {
            font-weight: bold;
        }

        .pain-scale-faces .face-range {
            font-size: 8pt;
            font-weight: bold;
        }

        /* Lingkaran untuk skor terpilih */
        .nyeri-skor-terpilih-baru {
            display: inline-block;
            width: 14px;
            /* Lebar lingkaran */
            height: 14px;
            /* Tinggi lingkaran */
            line-height: 14px;
            /* Vertikal center */
            border: 1px solid #000;
            border-radius: 50%;
            /* Bikin bulat */
            background-color: #ffffa0;
            font-weight: bold;
            font-size: 8pt;
        }

        /* === Akhir CSS Skala Nyeri Horizontal === */


        .gcs-table {
            width: 100%;
            border-collapse: collapse;
            margin: 3px 0;
            text-align: center;
        }

        .gcs-table td {
            border: none;
            padding: 1px 3px;
        }

        .gcs-label {
            font-weight: bold;
            text-align: left;
            width: 15%;
            /* Lebar label GCS */
        }

        .gcs-numbers-cell {
            text-align: left;
            /* Rata kiri angka GCS */
        }

        .gcs-number {
            border: none;
            width: 15px;
            height: 15px;
            display: inline-block;
            line-height: 15px;
            margin: 0 1px;
            text-align: center;
            /* Angka di tengah box */
        }

        .gcs-number.selected {
            background-color: #ffffa0;
            font-weight: bold;
        }

        .signature {
            text-align: right;
            margin-top: 15px;
            /* Lebih dekat */
            font-size: 8pt;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        table {
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        td {
            word-wrap: break-word;
        }

        /* Cegah teks panjang overflow */

        /* Style untuk tabel nested di Triase Sekunder */
        .sekunder-nested-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
        }

        .sekunder-nested-table td {
            border: none !important;
            /* Hapus border internal */
            padding: 0;
            /* Hapus padding internal */
            vertical-align: top;
            /* Pastikan rata atas */
            height: 11px;
            /* Sesuaikan tinggi baris jika perlu */
        }
    </style>
</head>

<body>
    @php
        // Ambil data rekam medis terkait (pastikan relasi 'rekamMedis' ada di model $record)
        $rekamMedis = $record->rekamMedis()->first();

        if ($rekamMedis) {
            // Default GCS jika data tidak ada
            $gcs_e = $rekamMedis->gcs_e ?? null;
            $gcs_v = $rekamMedis->gcs_v ?? null;
            $gcs_m = $rekamMedis->gcs_m ?? null;

            // FIX: Variabel skala nyeri disesuaikan untuk skala horizontal, ambil dari 'skor_nyeri'
            $skala_nyeri =
                $rekamMedis->ada_keluhan_nyeri && isset($rekamMedis->skor_nyeri) ? (int) $rekamMedis->skor_nyeri : -1;

            // Ambil array JSON
            $caraDatang = $rekamMedis->cara_datang ?? [];
            $penanggung = $rekamMedis->penanggung_jawab_biaya ?? [];
            $tandaNegatif = $rekamMedis->tanda_kehidupan_negatif ?? [];

            // FIX: Pisahkan array 'resusitasi' dan 'pemeriksaan_awal' sesuai form
            $resusitasi = $rekamMedis->resusitasi ?? []; // Untuk Airway, Breathing, Circulation
            $pemeriksaanAwal = $rekamMedis->pemeriksaan_awal ?? []; // Ini untuk Disability

            $emergency = $rekamMedis->emergency ?? [];
            $urgent = $rekamMedis->urgent ?? [];
            $nonUrgent = $rekamMedis->non_urgent ?? [];
            $falseEmergency = $rekamMedis->false_emergency ?? [];
        }
    @endphp
    <div class="container">
        <div class="header clearfix">
            <div class="header-left">
                <img src="{{ public_path('images/LogoPuskesmas.png') }}" alt="Logo" class="logo">
            </div>
            <div class="header-center">
                <h3>PEMERINTAH KABUPATEN BENGKALIS</h3>
                <h3>DINAS KESEHATAN</h3>
                <p>UNIT PELAKSANA TEKNIS PUSKESMAS BENGKALIS</p>
                <p>KECAMATAN BENGKALIS<br>Jalan Awang Mahmud, Desa Selat Alam, Kode Pos 28714</p>
            </div>
            <div class="header-right">
                RUANG<br>TINDAKAN
            </div>
        </div>

        <div class="title">Formulir Triase Pasien Gawat Darurat</div>

        @if ($rekamMedis)
            <!-- ================== TABEL 1: INFO PASIEN & TRIASE PRIMER (3 Kolom) ================== -->
            <table class="content-table">
                {{-- ============================================ --}}
                {{-- == BAGIAN ATAS FORMULIR YANG DIMODIFIKASI == --}}
                {{-- ============================================ --}}
                <tr>
                    {{-- Kolom Kiri: Info Pasien --}}
                    <td width="35%" rowspan="2" style="line-height: 1.4;"> <!-- Rowspan 2 -->
                        <table class="no-border-table">
                            <tr>
                                <td width="30%">No RM</td>
                                <td>: {{ $record->pasien?->no_rm ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>: {{ $record->pasien?->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:
                                    <span
                                        style="text-decoration: {{ $record->pasien?->jk == 'P' ? 'line-through' : 'none' }};">Laki-laki</span>
                                    /
                                    <span
                                        style="text-decoration: {{ $record->pasien?->jk == 'L' ? 'line-through' : 'none' }};">Perempuan</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Tgl Lahir/Umur</td>
                                <td>:
                                    {{ $record->pasien?->tgl_lahir ? \Carbon\Carbon::parse($record->pasien->tgl_lahir)->format('d/m/Y') . ' (' . \Carbon\Carbon::parse($record->pasien->tgl_lahir)->age . ' Thn)' : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: {{ $record->pasien?->alamat ?? '-' }}</td>
                            </tr>
                        </table>
                    </td>
                    {{-- Kolom Tengah: Cara Datang & Tanggal/Jam --}}
                    <td width="30%">
                        <b>Cara datang:</b><br>
                        <table class="no-border-table">
                            <tr>
                                <td width="50%">
                                    <span class="checkbox-item-block" style="padding-left:0;"><span
                                            class="checkbox">{{ in_array('Sendiri', $caraDatang) ? 'v' : '' }}</span>
                                        Sendiri</span>
                                    <span class="checkbox-item-block" style="padding-left:0;"><span
                                            class="checkbox">{{ in_array('Diantar Keluarga', $caraDatang) ? 'v' : '' }}</span>
                                        Diantar Keluarga</span>
                                    <span class="checkbox-item-block" style="padding-left:0;"><span
                                            class="checkbox">{{ in_array('Pustu/Poskesdes/Polindes', $caraDatang) ? 'v' : '' }}</span>
                                        Pustu/Poskesdes/Polindes</span>
                                    <span class="checkbox-item-block" style="padding-left:0;"><span
                                            class="checkbox">{{ in_array('Dokter Luar', $caraDatang) ? 'v' : '' }}</span>
                                        Dokter Luar</span>
                                    <span class="checkbox-item-block" style="padding-left:0;"><span
                                            class="checkbox">{{ in_array('Kecelakaan', $caraDatang) ? 'v' : '' }}</span>
                                        Kecelakaan</span>
                                </td>
                                <td width="50%">
                                    <span class="checkbox-item-block" style="padding-left:0;"><span
                                            class="checkbox">{{ in_array('Diantar Polisi', $caraDatang) ? 'v' : '' }}</span>
                                        Diantar Polisi</span>
                                    <span class="checkbox-item-block" style="padding-left:0;"><span
                                            class="checkbox">{{ in_array('Bidan', $caraDatang) ? 'v' : '' }}</span>
                                        Bidan</span>
                                    <span class="checkbox-item-block" style="padding-left:0;"><span
                                            class="checkbox">{{ in_array('Tanpa Idenentitas', $caraDatang) ? 'v' : '' }}</span>
                                        Tanpa Identitas</span>
                                    <span class="checkbox-item-block" style="padding-left:0;"><span
                                            class="checkbox">{{ in_array('Lain-lain', $caraDatang) ? 'v' : '' }}</span>
                                        Lain-lain</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                    {{-- Kolom Kanan: Tanggal & Jam --}}
                    <td width="35%">
                        <table class="no-border-table">
                            <tr>
                                <td width="40%">Tanggal Datang</td>
                                <td>:
                                    {{ $rekamMedis->tanggal_datang ? \Carbon\Carbon::parse($rekamMedis->tanggal_datang)->format('d/m/Y') : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Jam Datang</td>
                                <td>:
                                    {{ $rekamMedis->jam_datang ? \Carbon\Carbon::parse($rekamMedis->jam_datang)->format('H:i') : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Jam Diperiksa</td>
                                <td>:
                                    {{ $rekamMedis->jam_diperiksa ? \Carbon\Carbon::parse($rekamMedis->jam_diperiksa)->format('H:i') : '-' }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    {{-- Kolom Tengah Bawah: Trauma & Riwayat Alergi --}}
                    <!-- ===== FIX HERE: Added width="30%" ===== -->
                    <td width="30%">
                        <table class="no-border-table">
                            <tr>
                                <td width="20%"><b>Trauma</b></td>
                                <td>:
                                    <span class="checkbox-item"><span
                                            class="checkbox">{{ $rekamMedis->trauma ? 'v' : '' }}</span> Ya</span>
                                    <span class="checkbox-item"><span
                                            class="checkbox">{{ !$rekamMedis->trauma ? 'v' : '' }}</span> Non
                                        Trauma</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Riwayat Alergi</b>: {{ $rekamMedis->riwayat_alergi ?: '-' }}</td>
                            </tr>
                        </table>
                    </td>
                    {{-- Kolom Kanan Bawah: DOA, Penanggung Jawab, Tanda Negatif --}}
                    <!-- ===== FIX HERE: Added width="35%" ===== -->
                    <td width="35%">
                        <table class="no-border-table">
                            <tr>
                                <td colspan="2">
                                    <span class="checkbox-item"><span
                                            class="checkbox">{{ $rekamMedis->doa ? 'v' : '' }}</span> DOA Jam</span> :
                                    {{ $rekamMedis->jam_doa ? \Carbon\Carbon::parse($rekamMedis->jam_doa)->format('H:i') : '.......' }}
                                </td>
                            </tr>
                            <tr>
                                <td width="50%"><b>Penanggung Jawab Biaya:</b></td>
                                <td><b>Tanda Kehidupan (-):</b></td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="checkbox-item-block" style="padding-left:0;"><span
                                            class="checkbox">{{ in_array('BPJS/KIS', $penanggung) ? 'v' : '' }}</span>
                                        BPJS/KIS</span>
                                    <span class="checkbox-item-block" style="padding-left:0;"><span
                                            class="checkbox">{{ in_array('Jamkesmasda', $penanggung) ? 'v' : '' }}</span>
                                        Jamkesmasda</span> <!-- Tambah Jamkesmasda -->
                                    <span class="checkbox-item-block" style="padding-left:0;"><span
                                            class="checkbox">{{ in_array('KK/KTP', $penanggung) ? 'v' : '' }}</span>
                                        KK/KTP</span>
                                    <span class="checkbox-item-block" style="padding-left:0;"><span
                                            class="checkbox">{{ in_array('Umum', $penanggung) ? 'v' : '' }}</span>
                                        Umum</span>
                                </td>
                                <td>
                                    <span class="checkbox-item-block" style="padding-left:0;"><span
                                            class="checkbox">{{ in_array('Denyut Nadi (-)', $tandaNegatif) ? 'v' : '' }}</span>
                                        Denyut Nadi (-)</span>
                                    <span class="checkbox-item-block" style="padding-left:0;"><span
                                            class="checkbox">{{ in_array('Respirasi (-)', $tandaNegatif) ? 'v' : '' }}</span>
                                        Respirasi (-)</span>
                                    <span class="checkbox-item-block" style="padding-left:0;"><span
                                            class="checkbox">{{ in_array('Pupil dilatasi maksimal', $tandaNegatif) ? 'v' : '' }}</span>
                                        Pupil dilatasi maksimal</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    {{-- Baris Riwayat Penyakit Dahulu & Keluhan Utama --}}
                    <td colspan="3">
                        <table class="no-border-table">
                            <tr>
                                <td width="20%"><b>Riwayat Penyakit Dahulu</b></td>
                                <td>: {{ $rekamMedis->riwayat_penyakit_dahulu ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td><b>Keluhan Utama</b></td>
                                <td>: {{ $rekamMedis->keluhan_utama ?: '-' }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                {{-- == AKHIR BAGIAN ATAS FORMULIR == --}}

                <tr>
                    <!-- Baris Kondisi (Full Width) -->
                    <td colspan="3">
                        <b>Kondisi:</b>
                        <span class="checkbox-item" style="margin-left: 10px;">
                            <span class="checkbox">{{ $rekamMedis->kondisi == 'Gawat Darurat' ? 'v' : '' }}</span>
                            <span class="color-box red"></span> Gawat Darurat
                        </span>
                        <span class="checkbox-item">
                            <span class="checkbox">{{ $rekamMedis->kondisi == 'Darurat' ? 'v' : '' }}</span>
                            <span class="color-box yellow"></span> Darurat
                        </span>
                        <span class="checkbox-item">
                            <span
                                class="checkbox">{{ $rekamMedis->kondisi == 'Tidak Gawat Tidak Darurat' ? 'v' : '' }}</span>
                            <span class="color-box green"></span> Tidak Gawat Tidak Darurat
                        </span>
                        <span class="checkbox-item">
                            <span class="checkbox">{{ $rekamMedis->kondisi == 'Meninggal' ? 'v' : '' }}</span>
                            <span class="color-box black"></span> Meninggal
                        </span>
                    </td>
                </tr>

                {{-- ============================================= --}}
                {{-- == BAGIAN TRIASE PRIMER (Tetap Sama) == --}}
                {{-- ============================================= --}}
                <tr>
                    <td colspan="3" class="section-title">Triase Primer</td>
                </tr>
                {{-- Header Initial Assessment --}}
                <tr>
                    <td colspan="3" style="padding: 1px 2px;">
                        <table style="width: 100%; border: none;">
                            <tr>
                                <td style="border: none; width: 50%; vertical-align: bottom;">
                                    <b>Initial Assessment</b> | Pupil:
                                    <span class="checkbox-item" style="margin-left: 2px;"><span
                                            class="checkbox">{{ $rekamMedis->pupil == 'isokor' ? 'v' : '' }}</span>
                                        isokhor</span> /
                                    <span class="checkbox-item"><span
                                            class="checkbox">{{ $rekamMedis->pupil == 'anisokor' ? 'v' : '' }}</span>
                                        anisokhor</span>
                                </td>
                                <td style="border: none; width: 50%; vertical-align: bottom;">
                                    Refleks cahaya : {{ $rekamMedis->refleks_cahaya ?? '....... / .......' }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                {{-- Konten Pemeriksaan, Resusitasi, Emergency --}}
                <tr>
                    <td style="width: 30%;"> <!-- Kolom Kiri: Pemeriksaan -->
                        <b>Pemeriksaan</b><br>
                        <div style="margin-left: 5px;">
                            <b><i>Airway & C-Spine Control</i></b><br>
                            <b><i>Breathing</i></b><br><br><br> <!-- Space agar sejajar -->
                            <b><i>Circulation</i></b><br><br><br> <!-- Space agar sejajar -->
                            <b><i>Disability</i></b>
                        </div>
                    </td>
                    <td style="width: 35%;"> <!-- Kolom Tengah: Resusitasi (Pink Muda) -->
                        <div class="td-header th-red">Resusitasi</div>
                        <span class="checkbox-item-block"><span
                                class="checkbox">{{ in_array('Sumbatan', $resusitasi) ? 'v' : '' }}</span>
                            Sumbatan</span>
                        <span class="checkbox-item-block"><span
                                class="checkbox">{{ in_array('Henti Napas', $resusitasi) ? 'v' : '' }}</span> Henti
                            Napas</span>
                        <span class="checkbox-item-block"><span
                                class="checkbox">{{ in_array('Bradipnoe', $resusitasi) ? 'v' : '' }}</span>
                            Bradipnoe</span>
                        <span class="checkbox-item-block"><span
                                class="checkbox">{{ in_array('Sianosis', $resusitasi) ? 'v' : '' }}</span>
                            Sianosis</span>
                        <span class="checkbox-item-block"><span
                                class="checkbox">{{ in_array('Henti Jantung', $resusitasi) ? 'v' : '' }}</span> Henti
                            Jantung</span>
                        <span class="checkbox-item-block"><span
                                class="checkbox">{{ in_array('Nadi tidak teraba', $resusitasi) ? 'v' : '' }}</span>
                            Nadi tidak teraba</span>
                        <span class="checkbox-item-block"><span
                                class="checkbox">{{ in_array('Akral dingin', $resusitasi) ? 'v' : '' }}</span> Akral
                            dingin</span>
                        <span class="checkbox-item-block"><span
                                class="checkbox">{{ in_array('GCS < 9', $pemeriksaanAwal) ? 'v' : '' }}</span> GCS <
                                9</span>
                                <span class="checkbox-item-block"><span
                                        class="checkbox">{{ in_array('Kejang', $pemeriksaanAwal) ? 'v' : '' }}</span>
                                    Kejang</span>
                                <span class="checkbox-item-block"><span
                                        class="checkbox">{{ in_array('Unresponsive', $pemeriksaanAwal) ? 'v' : '' }}</span>
                                    Unresponsive</span>
                    </td>
                    <td style="width: 35%;"> <!-- Kolom Kanan: Emergency (Kuning Muda) -->
                        <div class="td-header th-yellow">Emergency</div>
                        <table style="width: 100%; border: none;">
                            <tr>
                                <td style="border: none; width: 50%;">
                                    <span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Bebas', $emergency) ? 'v' : '' }}</span>
                                        Bebas</span>
                                    <span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Ancaman', $emergency) ? 'v' : '' }}</span>
                                        Ancaman</span>
                                    <span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Takipnoe (>32x/mnt)', $emergency) ? 'v' : '' }}</span>
                                        Takipnoe (>32x/mnt)</span>
                                    <span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Mengi', $emergency) ? 'v' : '' }}</span>
                                        Mengi</span>
                                    <span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Nadi teraba lemah', $emergency) ? 'v' : '' }}</span>
                                        Nadi teraba lemah</span>
                                    <span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Bradikardi', $emergency) ? 'v' : '' }}</span>
                                        Bradikardi</span>
                                    <span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Takikardi (120-150x/mnt)', $emergency) ? 'v' : '' }}</span>
                                        Takikardi (120-150x/mnt)</span>

                                </td>
                                <td style="border: none; width: 50%;">
                                    <span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Pucat', $emergency) ? 'v' : '' }}</span>
                                        Pucat</span>
                                    <span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Akral dingin', $emergency) ? 'v' : '' }}</span>
                                        Akral dingin</span>
                                    <span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('CRT > 2 detik', $emergency) ? 'v' : '' }}</span>
                                        CRT > 2 detik</span>
                                    <span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('GCS 9 - 12', $emergency) ? 'v' : '' }}</span>
                                        GCS 9 - 12</span>
                                    <span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Gelisah', $emergency) ? 'v' : '' }}</span>
                                        Gelisah</span>
                                    <span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Nyeri Dada', $emergency) ? 'v' : '' }}</span>
                                        Nyeri Dada</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                {{-- Baris GCS --}}
                <tr>
                    <td colspan="3">
                        <table class="gcs-table">
                            <tr>
                                <td class="gcs-label">GCS</td>
                                <td class="gcs-label">Eye:</td>
                                <td class="gcs-numbers-cell">
                                    <span class="gcs-number {{ $gcs_e == 4 ? 'selected' : '' }}">4</span>
                                    <span class="gcs-number {{ $gcs_e == 3 ? 'selected' : '' }}">3</span>
                                    <span class="gcs-number {{ $gcs_e == 2 ? 'selected' : '' }}">2</span>
                                    <span class="gcs-number {{ $gcs_e == 1 ? 'selected' : '' }}">1</span>
                                </td>
                                <td class="gcs-label" style="padding-left: 15px;">Verbal:</td>
                                <td class="gcs-numbers-cell">
                                    <span class="gcs-number {{ $gcs_v == 5 ? 'selected' : '' }}">5</span>
                                    <span class="gcs-number {{ $gcs_v == 4 ? 'selected' : '' }}">4</span>
                                    <span class="gcs-number {{ $gcs_v == 3 ? 'selected' : '' }}">3</span>
                                    <span class="gcs-number {{ $gcs_v == 2 ? 'selected' : '' }}">2</span>
                                    <span class="gcs-number {{ $gcs_v == 1 ? 'selected' : '' }}">1</span>
                                </td>
                                <td class="gcs-label" style="padding-left: 15px;">Motorik:</td>
                                <td class="gcs-numbers-cell">
                                    <span class="gcs-number {{ $gcs_m == 6 ? 'selected' : '' }}">6</span>
                                    <span class="gcs-number {{ $gcs_m == 5 ? 'selected' : '' }}">5</span>
                                    <span class="gcs-number {{ $gcs_m == 4 ? 'selected' : '' }}">4</span>
                                    <span class="gcs-number {{ $gcs_m == 3 ? 'selected' : '' }}">3</span>
                                    <span class="gcs-number {{ $gcs_m == 2 ? 'selected' : '' }}">2</span>
                                    <span class="gcs-number {{ $gcs_m == 1 ? 'selected' : '' }}">1</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                {{-- == AKHIR BAGIAN TRIASE PRIMER == --}}

            </table>
            <!-- ================== AKHIR TABEL 1 ================== -->

            <!-- ================== TABEL 2: TRIASE SEKUNDER (4 Kolom) ================== -->
            <table class="content-table" style="margin-top: 5px;">
                {{-- ============================================== --}}
                {{-- == BAGIAN TRIASE SEKUNDER  == --}}
                {{-- ============================================== --}}
                <tr>
                    <td colspan="4" class="section-title">Triase Sekunder</td> <!-- Colspan 4, sekarang benar -->
                </tr>
                <tr>
                    <td style="width: 30%; vertical-align: top;"> <!-- Kolom 1: Tanda Vital -->
                        <b>Tanda Vital</b><br>
                        Keadaan Umum: {{ $rekamMedis->keadaan_umum ?? '-' }}<br>
                        Kesadaran: {{ $rekamMedis->kesadaran ?? '-' }}<br>
                        <table style="width:100%; border:none; margin-top:3px; margin-left: -2px;" cellpadding="0">
                            <tr>
                                <td style="border:none; width:15%;">TD</td>
                                <td style="border:none;">: {{ $rekamMedis->td ?? '............' }} mmHg</td>
                            </tr>
                            <tr>
                                <td style="border:none; width:15%;">HR</td>
                                <td style="border:none;">: {{ $rekamMedis->hr ?? '............' }} x/mnt</td>
                            </tr>
                            <tr>
                                <td style="border:none; width:15%;">RR</td>
                                <td style="border:none;">: {{ $rekamMedis->rr ?? '............' }} x/mnt</td>
                            </tr>
                            <tr>
                                <td style="border:none; width:15%;">T</td>
                                <td style="border:none;">: {{ $rekamMedis->t ?? '............' }} °C</td>
                            </tr>
                            <tr>
                                <td style="border:none; width:15%;">BB</td>
                                <td style="border:none;">: {{ $rekamMedis->bb ?? '............' }} kg</td>
                            </tr>
                            <tr>
                                <td style="border:none; width:15%;">TB</td>
                                <td style="border:none;">: {{ $rekamMedis->tb ?? '............' }} cm</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 23%; vertical-align: top; padding: 0;"> <!-- Kolom 2: Urgent -->
                        <div class="td-header th-yellow">Urgent</div>
                        {{-- Nested table for alignment --}}
                        <table class="sekunder-nested-table">
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Normal', $urgent) ? 'v' : '' }}</span>
                                        Normal</span></td>
                            </tr>
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Mengi', $urgent) ? 'v' : '' }}</span>
                                        Mengi</span></td>
                            </tr>
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Takipnoe', $urgent) ? 'v' : '' }}</span>
                                        Takipnoe</span></td>
                            </tr>
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Nadi Kuat', $urgent) ? 'v' : '' }}</span>
                                        Nadi Kuat</span></td>
                            </tr>
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Takikardi', $urgent) ? 'v' : '' }}</span>
                                        Takikardi</span></td>
                            </tr>
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('GCS > 12', $urgent) ? 'v' : '' }}</span> GCS
                                        > 12</span></td>
                            </tr>
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Apatis', $urgent) ? 'v' : '' }}</span>
                                        Apatis</span></td>
                            </tr>
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Somnolen', $urgent) ? 'v' : '' }}</span>
                                        Somnolen</span></td>
                            </tr>
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('38-39.9 °C', $urgent) ? 'v' : '' }}</span>
                                        38-39.9 °C</span></td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 23%; vertical-align: top; padding: 0;"> <!-- Kolom 3: Non Urgent -->
                        <div class="td-header th-green">Non Urgent</div>
                        {{-- Nested table for alignment --}}
                        <table class="sekunder-nested-table">
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Normal', $nonUrgent) ? 'v' : '' }}</span>
                                        Normal</span></td>
                            </tr>
                            <tr>
                                <td><span class="checkbox-item-block">&nbsp;</span></td>
                            </tr> {{-- Placeholder for Mengi --}}
                            <tr>
                                <td><span class="checkbox-item-block">&nbsp;</span></td>
                            </tr> {{-- Placeholder for Takipnoe --}}
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Nadi Kuat', $nonUrgent) ? 'v' : '' }}</span>
                                        Nadi Kuat</span></td>
                            </tr>
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Frek Normal', $nonUrgent) ? 'v' : '' }}</span>
                                        Frek Normal</span></td>
                            </tr>
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('GCS 15', $nonUrgent) ? 'v' : '' }}</span>
                                        GCS 15</span></td>
                            </tr>
                            <tr>
                                <td><span class="checkbox-item-block">&nbsp;</span></td>
                            </tr> {{-- Placeholder for Apatis --}}
                            <tr>
                                <td><span class="checkbox-item-block">&nbsp;</span></td>
                            </tr> {{-- Placeholder for Somnolen --}}
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('< 38 °C', $nonUrgent) ? 'v' : '' }}</span>
                                        < 38 °C</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 24%; vertical-align: top; padding: 0;"> <!-- Kolom 4: False Emergency -->
                        <div class="td-header th-blue">False Emergency</div>
                        {{-- Nested table for alignment --}}
                        <table class="sekunder-nested-table">
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Normal', $falseEmergency) ? 'v' : '' }}</span>
                                        Normal</span></td>
                            </tr>
                            <tr>
                                <td><span class="checkbox-item-block">&nbsp;</span></td>
                            </tr> {{-- Placeholder for Mengi --}}
                            <tr>
                                <td><span class="checkbox-item-block">&nbsp;</span></td>
                            </tr> {{-- Placeholder for Takipnoe --}}
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Nadi Kuat', $falseEmergency) ? 'v' : '' }}</span>
                                        Nadi Kuat</span></td>
                            </tr>
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('Frek Normal', $falseEmergency) ? 'v' : '' }}</span>
                                        Frek Normal</span></td>
                            </tr>
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('GCS 15', $falseEmergency) ? 'v' : '' }}</span>
                                        GCS 15</span></td>
                            </tr>
                            <tr>
                                <td><span class="checkbox-item-block">&nbsp;</span></td>
                            </tr> {{-- Placeholder for Apatis --}}
                            <tr>
                                <td><span class="checkbox-item-block">&nbsp;</span></td>
                            </tr> {{-- Placeholder for Somnolen --}}
                            {{-- Tampilkan 'Normal' tapi cek value '< 38 °C' dari form --}}
                            <tr>
                                <td><span class="checkbox-item-block"><span
                                            class="checkbox">{{ in_array('< 38 °C', $falseEmergency) ? 'v' : '' }}</span>
                                        Normal</span></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                {{-- Baris Nyeri --}}
                <tr>
                    <td colspan="4"> <!-- Colspan 4, sekarang benar -->
                        <b>Apakah terdapat keluhan nyeri?</b>
                        <span class="checkbox-item"><span
                                class="checkbox">{{ $rekamMedis->ada_keluhan_nyeri ? 'v' : '' }}</span> Ya</span>
                        <span class="checkbox-item"><span
                                class="checkbox">{{ !$rekamMedis->ada_keluhan_nyeri ? 'v' : '' }}</span> Tidak</span>
                        <span style="margin-left: 20px;">/</span>
                        <b>Bila Ya, berapa skala nyerinya?</b>

                        <!-- Skala Nyeri Horizontal Baru -->
                        <table class="pain-scale-table">
                            <!-- Baris 1: Angka 0-10 -->
                            <tr class="pain-scale-labels">
                                <td><span
                                        class="{{ $skala_nyeri == 0 ? 'nyeri-skor-terpilih-baru' : '' }}">0</span>
                                </td>
                                <td><span
                                        class="{{ $skala_nyeri == 1 ? 'nyeri-skor-terpilih-baru' : '' }}">1</span>
                                </td>
                                <td><span
                                        class="{{ $skala_nyeri == 2 ? 'nyeri-skor-terpilih-baru' : '' }}">2</span>
                                </td>
                                <td><span
                                        class="{{ $skala_nyeri == 3 ? 'nyeri-skor-terpilih-baru' : '' }}">3</span>
                                </td>
                                <td><span
                                        class="{{ $skala_nyeri == 4 ? 'nyeri-skor-terpilih-baru' : '' }}">4</span>
                                </td>
                                <td><span
                                        class="{{ $skala_nyeri == 5 ? 'nyeri-skor-terpilih-baru' : '' }}">5</span>
                                </td>
                                <td><span
                                        class="{{ $skala_nyeri == 6 ? 'nyeri-skor-terpilih-baru' : '' }}">6</span>
                                </td>
                                <td><span
                                        class="{{ $skala_nyeri == 7 ? 'nyeri-skor-terpilih-baru' : '' }}">7</span>
                                </td>
                                <td><span
                                        class="{{ $skala_nyeri == 8 ? 'nyeri-skor-terpilih-baru' : '' }}">8</span>
                                </td>
                                <td><span
                                        class="{{ $skala_nyeri == 9 ? 'nyeri-skor-terpilih-baru' : '' }}">9</span>
                                </td>
                                <td><span
                                        class="{{ $skala_nyeri == 10 ? 'nyeri-skor-terpilih-baru' : '' }}">10</span>
                                </td>
                            </tr>
                            <!-- Baris 2: Bar Gradasi -->
                            <tr class="pain-scale-bar">
                                <td class="grad-0">&nbsp;</td>
                                <td class="grad-1">&nbsp;</td>
                                <td class="grad-2">&nbsp;</td>
                                <td class="grad-3">&nbsp;</td>
                                <td class="grad-4">&nbsp;</td>
                                <td class="grad-5">&nbsp;</td>
                                <td class="grad-6">&nbsp;</td>
                                <td class="grad-7">&nbsp;</td>
                                <td class="grad-8">&nbsp;</td>
                                <td class="grad-9">&nbsp;</td>
                                <td class="grad-10">&nbsp;</td>
                            </tr>
                            <!-- Baris 3: Ticks -->
                            <tr class="pain-scale-ticks">
                                <td><span class="tick-label">|</span></td>
                                <td><span class="tick-label">|</span></td>
                                <td><span class="tick-label">|</span></td>
                                <td><span class="tick-label">|</span></td>
                                <td><span class="tick-label">|</span></td>
                                <td><span class="tick-label">|</span></td>
                                <td><span class="tick-label">|</span></td>
                                <td><span class="tick-label">|</span></td>
                                <td><span class="tick-label">|</span></td>
                                <td><span class="tick-label">|</span></td>
                                <td><span class="tick-label">|</span></td>
                            </tr>
                            <!-- Baris 4: Emoticon & Teks -->
                            <tr class="pain-scale-faces">
                                <td>
                                    <!-- 0 -->
                                    <div class="emoji"><img src="{{ public_path('images/emoji/smile.png') }}"
                                            alt="0"></div>
                                    <div class="face-title">Tidak Nyeri</div>
                                    <div class="face-range">0</div>
                                </td>
                                <td></td>
                                <!-- 1 -->
                                <td>
                                    <!-- 2 -->
                                    <div class="emoji"><img
                                            src="{{ public_path('images/emoji/slight-smile.png') }}" alt="1-3">
                                    </div>
                                    <div class="face-title">Ringan</div>
                                    <div class="face-range">1–3</div>
                                </td>
                                <td></td>
                                <!-- 3 -->
                                <td>
                                    <!-- 4 -->
                                    <div class="emoji"><img src="{{ public_path('images/emoji/neutral.png') }}"
                                            alt="4-6"></div>
                                    <div class="face-title">Sedang</div>
                                    <div class="face-range">4–6</div>
                                </td>
                                <td></td>
                                <!-- 5 -->
                                <td>
                                    <!-- 6 -->
                                    <div class="emoji"><img src="{{ public_path('images/emoji/worried.png') }}"
                                            alt="7"></div>
                                    <div class="face-title">Berat</div>
                                    <div class="face-range">7</div>
                                </td>
                                <td></td>
                                <!-- 7 -->
                                <td>
                                    <!-- 8 -->
                                    <div class="emoji"><img src="{{ public_path('images/emoji/pain.png') }}"
                                            alt="8-9"></div>
                                    <div class="face-title">Sangat Berat</div>
                                    <div class="face-range">8–9</div>
                                </td>
                                <td></td>
                                <!-- 9 -->
                                <td>
                                    <!-- 10 -->
                                    <div class="emoji"><img src="{{ public_path('images/emoji/crying.png') }}"
                                            alt="10"></div>
                                    <div class="face-title">Tak Tahan</div>
                                    <div class="face-range">10</div>
                                </td>
                            </tr>
                        </table>
                        <!-- Akhir Skala Nyeri Horizontal Baru -->
                    </td>
                </tr>
                {{-- == AKHIR BAGIAN TRIASE SEKUNDER == --}}

            </table>
            <!-- ================== AKHIR TABEL 2 ================== -->

            <div class="signature">
                Petugas Triase<br><br><br><br>
                <!-- Space untuk TTD -->
                ( {{ $rekamMedis->petugasTriase?->name ?? '............................' }} )
                <!-- Ambil nama petugas jika ada relasi -->
            </div>
        @else
            <div style="text-align: center; padding: 30px; border: 1px solid #ccc; margin-top: 20px;">
                Data Formulir Triase Gawat Darurat belum diisi untuk pendaftaran ini.
            </div>
        @endif
    </div>
</body>

</html>
