<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Asesmen Rawat Jalan Gigi - {{ $record->pasien?->nama }}</title>
    <style>
        /* CSS Lengkap untuk Tampilan Presisi Sesuai Gambar */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 9pt;
            /* Ukuran font base sedikit lebih kecil */
            color: #000;
        }

        @page {
            margin: 10px;
            /* Margin halaman lebih kecil (dari 12px) */
        }

        .main-container {
            border: 2px solid #000;
            padding: 5px;
            /* Padding dikurangi (dari 6px) */
            width: 100%;
            box-sizing: border-box;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
            /* Margin dikurangi (dari 5px) */
            border-bottom: 2px solid #000;
            padding-bottom: 4px;
            /* Padding dikurangi */
        }

        .header-table td {
            vertical-align: top;
            padding: 0;
        }

        .logo {
            width: 50px;
            height: 50px;
        }

        .puskesmas-info {
            display: inline-block;
            vertical-align: top;
            padding-left: 8px;
        }


        .puskesmas-info div {
            line-height: 1.2;
        }

        /* Info Pasien di Kanan (Tanpa Border) */
        .pasien-info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pasien-info-table td {
            padding: 1px 2px;
            vertical-align: top;
        }

        .pasien-info-table .label {
            font-weight: normal;
            width: 35%;
            /* Sedikit lebih lebar */
        }

        .pasien-info-table .separator {
            width: 2%;
        }

        .pasien-info-table .value {
            width: 63%;
            /* Menyesuaikan */
        }

        /* Kotak Judul */
        .title {
            text-align: center;
            font-weight: bold;
            font-size: 11pt;
            margin-bottom: 0px;
        }

        .subtitle {
            text-align: center;
            font-weight: bold;
            font-size: 10pt;
            margin-bottom: 2px;
            /* Margin dikurangi (dari 3px) */
        }

        .section-title {
            font-weight: bold;
            font-size: 10pt;
            background-color: #e0e0e0;
            padding: 1px;
            /* Padding dikurangi (dari 2px) */
            text-align: center;
            border: 1px solid #000;
            margin-top: 3px;
            /* Margin dikurangi (dari 4px) */
            margin-bottom: 1px;
            /* Margin dikurangi (dari 2px) */
        }

        .field-group {
            margin-bottom: 0px;
            /* Lebih Rapat (dari 1px) */
        }

        .checkbox-container {
            margin-top: 2px;
            margin-bottom: 3px;
            /* Margin dikurangi (dari 5px) */
        }

        .checkbox-item {
            display: inline-block;
            margin-right: 8px;
            /* Jarak antar item */
        }

        /* Menggunakan style [ ] dan [X] seperti di gambar */
        .checkbox-label {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 1px solid black;
            text-align: center;
            line-height: 12px;
            vertical-align: middle;
            font-size: 9pt;
            font-weight: bold;
            margin-right: 3px;
        }

        .data-content {
            padding-left: 15px;
            /* Indentasi untuk data S, A, P */
            min-height: 15px;
        }

        table.full-width {
            width: 100%;
            border-collapse: collapse;
        }

        .full-width td,
        .full-width th {
            padding: 1px 2px;
            /* Padding dikurangi */
            border: 1px solid black;
            vertical-align: top;
            font-size: 8pt;
            /* Ukuran font tabel lebih kecil */
        }

        .full-width th {
            font-weight: bold;
            text-align: center;
            background-color: #f0f0f0;
        }

        .signature-box {
            margin-top: 4px;
            /* Margin dikurangi (dari 8px) */
            width: 100%;
            overflow: auto;
            /* Menambahkan overflow untuk clear float */
        }

        .signature-box .signer-left {
            width: 45%;
            /* Lebar untuk tanda tangan kiri */
            text-align: center;
            float: left;
        }

        .signature-box .signer-right {
            margin-left: 70%;
            width: 250px;
            text-align: center;
            display: inline-block;
        }

        .signature-space {
            height: 25px;
        }
        .signature-space-right {
            height: 2px;
            margin-top: 0px;
        }

        .flex-container {
            display: -webkit-box;
            display: -webkit-flex;
            display: flex;
            width: 100%;
            margin-bottom: 5px;
        }

        .flex-item {
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            flex: 1;
        }

        .text-right {
            text-align: right;
        }

        /* Style untuk Tanda Vital Sesuai Gambar */
        .ttv-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2px;
            /* Menambahkan margin top kecil (dari 3px) */
        }

        .ttv-table td {
            padding: 1px;
            vertical-align: middle;
        }

        .ttv-label {
            font-weight: bold;
            width: 6%;
            /* Dikecilkan */
        }

        .ttv-value {
            width: 5%;
            /* Dikecilkan */
            border-bottom: 1px dotted #000;
            text-align: center;
        }

        .ttv-unit {
            width: 8%;
            /* Dikecilkan */
        }

        .ttv-spacer {
            width: 5%;
        }

        /* Checkbox inline untuk gambar */
        .inline-check {
            display: inline-block;
            margin-right: 5px;
        }

        .inline-check .checkbox-label {
            margin-right: 2px;
        }

        /* === CSS BARU: Skala Nyeri Versi Tabel (PDF-SAFE) === */
        .pain-scale-table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            margin-top: 3px;
            /* Margin dikurangi (dari 5px) */
        }

        .pain-scale-table td {
            padding: 1px 0;
            vertical-align: top;
            width: 9.09%;
            /* 100% / 11 kolom */
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
            /* font-size: 16pt; */
            /* DIHAPUS: tidak perlu lagi */
            line-height: 1;
        }

        /* BARU: Style untuk gambar emoji */
        .pain-scale-faces .emoji img {
            width: 25px;
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

        /* Lingkaran untuk skor terpilih (BARU) */
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
    </style>
</head>

<body>
    <div class="main-container">
        <!-- KOP SURAT -->
        <table class="header-table">
            <tr>
                <td style="width: 58%;">
                    <!-- Lebar disesuaikan -->
                    <img src="{{ public_path('images/LogoPuskesmas.png') }}" alt="Logo" class="logo">
                    <div class="puskesmas-info">
                        <div style="font-weight:bold; font-size: 11pt;">UPT PUSKESMAS BENGKALIS</div>
                        <div style="font-size:8pt;">Jalan Awang Mahmud Desa Sel. Alam</div>
                        <div style="font-size:8pt;">Hp. 0811760071 Kode Pos 28734</div>
                    </div>
                </td>
                <td style="width: 42%;">
                    <!-- Lebar disesuaikan -->
                    <!-- AREA PASIEN SESUAI GAMBAR -->
                    <table class="pasien-info-table">
                        <tr>
                            <td class="label">Nama</td>
                            <td class="separator">:</td>
                            <td class="value">{{ $record->pasien?->nama ?? '-' }}</td>
                            <td style="width: 15%; text-align: right;">
                                {{ $record->pasien?->jk == 'L' ? 'L' : 'P' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="label">Tanggal Lahir</td>
                            <td class="separator">:</td>
                            <td class="value" colspan="2">
                                {{ $record->pasien?->tgl_lahir ? \Carbon\Carbon::parse($record->pasien->tgl_lahir)->format('d/m/Y') . ' (' . \Carbon\Carbon::parse($record->pasien->tgl_lahir)->age . ' Thn)' : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="label">No. RM</td>
                            <td class="separator">:</td>
                            <td class="value" colspan="2">{{ $record->pasien?->no_rm ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="label">No. BPJS</td>
                            <td class="separator">:</td>
                            <td class="value" colspan="2">{{ $record->pasien?->no_bpjs ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Alamat</td>
                            <td class="separator">:</td>
                            <td class="value" colspan="2">{{ $record->pasien?->alamat ?? '-' }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- AREA JUDUL -->
        <div class="title">ASESMEN RAWAT JALAN</div>
        <div class="subtitle">Asesmen Keperawatan</div>

        <table style="width: 100%; margin-bottom: 2px;">
            
            <tr>
                <td style="width: 60%;">
                    <b>Hari/ Tanggal:</b>
                    {{ $record->tanggal_asesmen ? \Carbon\Carbon::parse($record->tanggal_asesmen)->format('d F Y') : '.....................................' }}
                </td>
                <td style="width: 40%; text-align: right;">
                    <b>Jam:</b>
                    {{ $record->tanggal_asesmen ? \Carbon\Carbon::parse($record->tanggal_asesmen)->format('H:i') : '..............' }}
                    WIB
                </td>
            </tr>
        </table>

        @php $hambatan = $record->hambatan_pelayanan ?? []; @endphp
        <div class="field-group">
            <b>HAMBATAN PELAYANAN:</b>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Tidak ada', $hambatan) ? 'X' : '' }}</span> Tidak ada
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Ada', $hambatan) ? 'X' : '' }}</span> Ada,
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Bahasa', $hambatan) ? 'X' : '' }}</span> Bahasa
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Fisik', $hambatan) ? 'X' : '' }}</span> Fisik
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Tuli', $hambatan) ? 'X' : '' }}</span> Tuli
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Bisu', $hambatan) ? 'X' : '' }}</span> Bisu
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Buta', $hambatan) ? 'X' : '' }}</span> Buta
            </span>
        </div>

        <div class="field-group">
            <b>STATUS SOSIAL:</b>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ $record->status_sosial == 'Menikah' ? 'X' : '' }}</span> Menikah
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ $record->status_sosial == 'Belum Menikah' ? 'X' : '' }}</span> Belum
                Menikah
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ $record->status_sosial == 'Cerai' ? 'X' : '' }}</span> Cerai
            </span>
        </div>

        <div class="field-group">
            <b>S:</b>
            <div class="data-content">{!! nl2br(e($record->s_keperawatan ?? '-')) !!}</div>
        </div>

        @php $riwayat = $record->riwayat_kesehatan ?? []; @endphp
        <div class="field-group">
            <b>RIWAYAT KESEHATAN:</b>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Hipertensi', $riwayat) ? 'X' : '' }}</span> Hipertensi
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Jantung', $riwayat) ? 'X' : '' }}</span> Jantung
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Diabetes', $riwayat) ? 'X' : '' }}</span> Diabetes
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('TB Paru', $riwayat) ? 'X' : '' }}</span> TB Paru
            </span>
            <b>Lain-lain:</b> {{ $record->riwayat_kesehatan_lainnya ?? '.........' }}
        </div>

        @php $kebiasaan = $record->kebiasaan ?? []; @endphp
        <div class="field-group">
            <b>KEBIASAAN:</b>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Rokok', $kebiasaan) ? 'X' : '' }}</span> Rokok
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Alkohol', $kebiasaan) ? 'X' : '' }}</span> Alkohol
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Obat Tidur', $kebiasaan) ? 'X' : '' }}</span> Obat Tidur
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Olahraga', $kebiasaan) ? 'X' : '' }}</span> Olahraga
            </span>
        </div>

        <div class="field-group">
            <b>ALERGI:</b>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ !$record->ada_alergi ? 'X' : '' }}</span> Tidak
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ $record->ada_alergi ? 'X' : '' }}</span> Ya, jelaskan:
                {{ $record->alergi_keterangan ?? '.........' }}
            </span>
        </div>

        @php $psikologis = $record->status_psikologis ?? []; @endphp
        <div class="field-group">
            <b>STATUS PSIKOLOGIS:</b>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Tenang', $psikologis) ? 'X' : '' }}</span> Tenang
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Cemas', $psikologis) ? 'X' : '' }}</span> Cemas
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Takut', $psikologis) ? 'X' : '' }}</span> Takut
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Marah', $psikologis) ? 'X' : '' }}</span> Marah
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Sedih', $psikologis) ? 'X' : '' }}</span> Sedih
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Cenderung Bunuh Diri', $psikologis) ? 'X' : '' }}</span>
                Cenderung Bunuh Diri
            </span>
        </div>

        <div class="field-group">
            <b>O:</b>
            <div class="data-content">{!! nl2br(e($record->o_keperawatan ?? '-')) !!}</div>
        </div>

        <table class="ttv-table">
            <tr>
                <td class="ttv-label">TD:</td>
                <td class="ttv-value">{{ $record->td ?? '-' }}</td>
                <td class="ttv-unit">mmHg,</td>
                <td class="ttv-label">RR:</td>
                <td class="ttv-value">{{ $record->rr ?? '-' }}</td>
                <td class="ttv-unit">x/mnt,</td>
                <td class="ttv-label">HR:</td>
                <td class="ttv-value">{{ $record->hr ?? '-' }}</td>
                <td class="ttv-unit">x/mnt,</td>
                <td class="ttv-label">T:</td>
                <td class="ttv-value">{{ $record->t ?? '-' }}</td>
                <td class="ttv-unit">°C,</td>
                <td class="ttv-label">Lingkar Perut:</td>
                <td class="ttv-value">{{ $record->lingkar_perut ?? '-' }}</td>
                <td class="ttv-unit">cm</td>
            </tr>
            <tr>
                <td class="ttv-label">TB:</td>
                <td class="ttv-value">{{ $record->tb ?? '-' }}</td>
                <td class="ttv-unit">cm,</td>
                <td class="ttv-label">BB:</td>
                <td class="ttv-value">{{ $record->bb ?? '-' }}</td>
                <td class="ttv-unit">kg,</td>
                <td class="ttv-label">IMT:</td>
                <td class="ttv-value">{{ $record->imt ?? '-' }}</td>
                <td class="ttv-unit">cm,</td>
                <td class="ttv-label">LILA:</td>
                <td class="ttv-value">{{ $record->lila ?? '-' }}</td>
                <td class="ttv-unit">cm,</td>
                <td class="ttv-label">SpO₂:</td>
                <td class="ttv-value">{{ $record->spo2 ?? '-' }}</td>
                <td class="ttv-unit">%</td>
            </tr>
        </table>
        <div style="font-size: 8pt; font-style;bold;">(Usia 0-59 bulan), <span>lingkar kepala{{ $record->lingkar_kepala ?? '-' }}</span></div>

        <div class="field-group" style="margin-top: 2px;">
            
            <b>NYERI:</b>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ !$record->skala_nyeri ? 'X' : '' }}</span> Tidak
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ $record->skala_nyeri ? 'X' : '' }}</span> Ya, Skor:
                {{ $record->skor_nyeri ?? '-' }}
            </span>

            @php $skor = ($record->skala_nyeri && isset($record->skor_nyeri)) ? (int)$record->skor_nyeri : -1; @endphp

            <table class="pain-scale-table">
                <!-- Baris 1: Angka 0-10 -->
                <tr class="pain-scale-labels">
                    <td><span class="{{ ($skor == 0) ? 'nyeri-skor-terpilih-baru' : '' }}">0</span></td>
                    <td><span class="{{ ($skor == 1) ? 'nyeri-skor-terpilih-baru' : '' }}">1</span></td>
                    <td><span class="{{ ($skor == 2) ? 'nyeri-skor-terpilih-baru' : '' }}">2</span></td>
                    <td><span class="{{ ($skor == 3) ? 'nyeri-skor-terpilih-baru' : '' }}">3</span></td>
                    <td><span class="{{ ($skor == 4) ? 'nyeri-skor-terpilih-baru' : '' }}">4</span></td>
                    <td><span class="{{ ($skor == 5) ? 'nyeri-skor-terpilih-baru' : '' }}">5</span></td>
                    <td><span class="{{ ($skor == 6) ? 'nyeri-skor-terpilih-baru' : '' }}">6</span></td>
                    <td><span class="{{ ($skor == 7) ? 'nyeri-skor-terpilih-baru' : '' }}">7</span></td>
                    <td><span class="{{ ($skor == 8) ? 'nyeri-skor-terpilih-baru' : '' }}">8</span></td>
                    <td><span class="{{ ($skor == 9) ? 'nyeri-skor-terpilih-baru' : '' }}">9</span></td>
                    <td><span class="{{ ($skor == 10) ? 'nyeri-skor-terpilih-baru' : '' }}">10</span></td>
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
                        <div class="emoji"><img src="{{ public_path('images/emoji/smile.png') }}" alt="0"></div>
                        <div class="face-title">Tidak Nyeri</div>
                        <div class="face-range">0</div>
                    </td>
                    <td></td> <!-- 1 -->
                    <td>
                        <!-- 2 -->
                        <div class="emoji"><img src="{{ public_path('images/emoji/slight-smile.png') }}" alt="1-3">
                        </div>
                        <div class="face-title">Ringan</div>
                        <div class="face-range">1–3</div>
                    </td>
                    <td></td> <!-- 3 -->
                    <td>
                        <!-- 4 -->
                        <div class="emoji"><img src="{{ public_path('images/emoji/neutral.png') }}" alt="4-6"></div>
                        <div class="face-title">Sedang</div>
                        <div class="face-range">4–6</div>
                    </td>
                    <td></td> <!-- 5 -->
                    <td>
                        <!-- 6 -->
                        <div class="emoji"><img src="{{ public_path('images/emoji/worried.png') }}" alt="7"></div>
                        <div class="face-title">Berat</div>
                        <div class="face-range">7</div>
                    </td>
                    <td></td> <!-- 7 -->
                    <td>
                        <!-- 8 -->
                        <div class="emoji"><img src="{{ public_path('images/emoji/pain.png') }}" alt="8-9"></div>
                        <div class="face-title">Sangat Berat</div>
                        <div class="face-range">8–9</div>
                    </td>
                    <td></td> <!-- 9 -->
                    <td>
                        <!-- 10 -->
                        <div class="emoji"><img src="{{ public_path('images/emoji/crying.png') }}" alt="10"></div>
                        <div class="face-title">Tak Tahan</div>
                        <div class="face-range">10</div>
                    </td>
                </tr>
            </table>
        </div>


        <div class="field-group" style="margin-top: 2px;">
            
            <b>STATUS FUNGSIONAL:</b>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ $record->status_fungsional == 'Mandiri' ? 'X' : '' }}</span> Mandiri
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ $record->status_fungsional == 'Perlu Bantuan' ? 'X' : '' }}</span>
                Perlu Bantuan
            </span>
            <span class="checkbox-item">
                <span
                    class="checkbox-label">{{ $record->status_fungsional == 'Ketergantungan Total' ? 'X' : '' }}</span>
                Ketergantungan Total
            </span>
        </div>

        <b style="display: block; margin-top: 2px;">RISIKO JATUH:</b> 
        <table class="full-width">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Penilaian</th>
                    <th width="10%">Ya</th>
                    <th width="10%">Tidak</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">1</td>
                    <td>Cara berjalan pasien (Tidak seimbang/sempoyongan/limbung) / Jalan menggunakan alat bantu</td>
                    <td style="text-align: center; font-weight: bold;">
                        {{ $record->risiko_jatuh_penilaian_1 ? 'X' : '' }}</td>
                    <td style="text-align: center; font-weight: bold;">
                        {{ !$record->risiko_jatuh_penilaian_1 ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td style="text-align: center;">2</td>
                    <td>Menopang saat akan duduk</td>
                    <td style="text-align: center; font-weight: bold;">
                        {{ $record->risiko_jatuh_penilaian_2 ? 'X' : '' }}</td>
                    <td style="text-align: center; font-weight: bold;">
                        {{ !$record->risiko_jatuh_penilaian_2 ? 'X' : '' }}</td>
                </tr>
            </tbody>
        </table>

        <table class="full-width" style="margin-top: 1px;">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Hasil Penilaian</th>
                    <th>Tindakan</th>
                    <th width="10%">Check</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">1</td>
                    <td><b>TIDAK BERISIKO</b> <br> <small>(tidak ditemukan no 1 & 2)</small></td>
                    <td>Tidak ada tindakan</td>
                    <td style="text-align: center; font-weight: bold;">
                        {{ $record->risiko_jatuh_hasil == 'Tidak Berisiko' ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td style="text-align: center;">2</td>
                    <td><b>RISIKO RENDAH</b> <br> <small>(ditemukan salah satu no 1 & 2)</small></td>
                    <td>Edukasi</td>
                    <td style="text-align: center; font-weight: bold;">
                        {{ $record->risiko_jatuh_hasil == 'Risiko Rendah' ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td style="text-align: center;">3</td>
                    <td><b>RISIKO TINGGI</b> <br> <small>(ditemukan no 1 & 2)</small></td>
                    <td>Pemantauan</td>
                    <td style="text-align: center; font-weight: bold;">
                        {{ $record->risiko_jatuh_hasil == 'Risiko Tinggi' ? 'X' : '' }}</td>
                </tr>
            </tbody>
        </table>

        <div class="field-group" style="margin-top: 2px;">
            <b>A:</b>
            <div class="data-content">{!! nl2br(e($record->a_keperawatan ?? '-')) !!}</div>
        </div>
        <div class="field-group">
            <b>P:</b>
            <div class="data-content">{!! nl2br(e($record->p_keperawatan ?? '-')) !!}</div>
        </div>

        <div class="signature-box" style="height: 50px;">
            <div class="signer-right">
                ______________________
                <div class="signature-space-right"></div> 
                (Nama dan TTD Perawat)
            </div>
        </div>

        <div class="section-title">Asesmen Medis</div>
        <div class="field-group" style="margin-top: 2px;">
            <b>ANAMNESIS (S):</b>
            <div class="data-content">{!! nl2br(e($record->anamnesis_medis ?? '-')) !!}</div>
        </div>
        <div class="field-group">
            <b>PEMERIKSAAN FISIK (O):</b>
            <div style="padding-left: 15px;">
                Keadaan Umum: {{ $record->pemeriksaan_fisik_o_ku ?? '.........' }}
                Kesadaran: {{ $record->pemeriksaan_fisik_o_kesadaran ?? '.........' }}
            </div>
            {{-- Data Odontogram lama bisa ditaruh di sini jika perlu --}}
            <div class="data-content">
                {!! nl2br(e($record->pemeriksaan_fisik_o_lainnya ?? '')) !!}
            </div>
        </div>
        <div class="field-group">
            <b>PEMERIKSAAN PENUNJANG:</b>
            <div style="padding-left: 15px;">
                Laboratorium: {{ $record->pemeriksaan_penunjang_lab ?? '.........' }}
            </div>
        </div>
        <div class="field-group">
            <b>DIAGNOSA (A):</b>
            <div class="data-content">{!! nl2br(e($record->assessment_diagnosa_medis ?? '-')) !!}</div>
        </div>
        <div class="field-group">
            <b>RENCANA TERAPI (P):</b>
            <div class="data-content">{!! nl2br(e($record->rencana_terapi_medis ?? '-')) !!}</div>
        </div>


        <!-- RENCANA TINDAK LANJUT -->
        <div class="section-title"
            style="text-align: left; padding-left: 5px; background-color: #fff; border: none; border-top: 1px solid #000; border-bottom: 1px solid #000; margin-top: 3px;">
            RENCANA TINDAK LANJUT:
        </div>

        @php $rujuk_internal = $record->rujuk_internal ?? []; @endphp
        <div class="field-group" style="margin-top: 1px;">
            <b>Rujuk Internal:</b>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Gizi', $rujuk_internal) ? 'X' : '' }}</span> Gizi
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Gigi', $rujuk_internal) ? 'X' : '' }}</span> Gigi
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('R. Tindakan', $rujuk_internal) ? 'X' : '' }}</span> R. Tindakan
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('VCT/IMS', $rujuk_internal) ? 'X' : '' }}</span> VCT/IMS
            </span>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('Lain-lain', $rujuk_internal) ? 'X' : '' }}</span> Lain-lain
            </span>
        </div>

        @php $rujuk_eksternal = $record->rujuk_eksternal ?? []; @endphp
        <div class="field-group">
            <b>Rujuk Eksternal:</b>
            <span class="checkbox-item">
                <span class="checkbox-label">{{ in_array('RSUD Bengkalis', $rujuk_eksternal) ? 'X' : '' }}</span> RSUD
                Bengkalis
            </span>
        </div>

        <div class="signature-box" style="margin-top: 4px;">
            <div class="signer-right">
                DOKTER PEMERIKSA
                <div class="signature-space"></div>
                ( {{ $dokter->name ?? '____________________' }} )
            </div>
        </div>

    </div> <!-- End of main-container -->
</body>

</html>

