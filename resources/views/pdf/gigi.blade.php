<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Asesmen Rawat Jalan Gigi & Mulut - {{ $record->pasien?->nama }}</title>
    <style>
        /* CSS Lengkap dari Template Rawat Jalan Biasa */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 9pt;
            color: #000;
        }

        @page {
            margin: 15px;
        }

        .main-container {
            border: 2px solid #000;
            padding: 8px;
            width: 100%;
            box-sizing: border-box;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
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
        }

        .pasien-info-table .separator {
            width: 2%;
        }

        .pasien-info-table .value {
            width: 63%;
        }

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
            margin-bottom: 5px;
        }

        .section-title {
            font-weight: bold;
            font-size: 10pt;
            background-color: #e0e0e0;
            padding: 2px;
            text-align: center;
            border: 1px solid #000;
            margin-top: 5px;
            margin-bottom: 3px;
        }

        .field-group {
            margin-bottom: 2px;
        }

        .checkbox-container {
            margin-top: 2px;
            margin-bottom: 5px;
        }

        .checkbox-item {
            display: inline-block;
            margin-right: 8px;
        }

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
            min-height: 15px;
        }

        table.full-width {
            width: 100%;
            border-collapse: collapse;
        }

        .full-width td,
        .full-width th {
            padding: 2px;
            border: 1px solid black;
            vertical-align: top;
            font-size: 8pt;
        }

        .full-width th {
            font-weight: bold;
            text-align: center;
            background-color: #f0f0f0;
        }

        /* DIUBAH: CSS TTD jadi lebih PDF-safe */
        .signature-box {
            margin-top: 15px;
            width: 100%;
            text-align: right;
            /* Kontainer akan rata kanan */
        }

        .signature-box .signer-left {
            width: 250px;
            /* DIUBAH: dari 45% ke 250px */
            text-align: center;
            display: inline-block;
            /* DIUBAH: jadi inline-block */
            /* float: left; */
            /* Hapus float */
        }

        .signature-box .signer-right {
            width: 250px;
            /* DIUBAH: dari 45% ke 250px */
            text-align: center;
            display: inline-block;
            /* DIUBAH: jadi inline-block */
            /* float: right; */
            /* Hapus float */
        }

        .signature-space {
            height: 50px;
        }

        .ttv-table {
            width: 100%;
            border-collapse: collapse;
        }

        .ttv-table td {
            padding: 1px;
            vertical-align: middle;
        }

        .ttv-label {
            font-weight: bold;
            width: 6%;
        }

        .ttv-value {
            width: 5%;
            border-bottom: 1px dotted #000;
            text-align: center;
        }

        .ttv-unit {
            width: 8%;
        }

        
        /* === CSS TAMBAHAN UNTUK ODONTOGRAM === */
        .odontogram-pdf-container {
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .odontogram-pdf {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 8pt;
        }

        .odontogram-pdf td {
            border: 1px solid black;
            width: 5.8%;
            /* Disesuaikan untuk 17 kolom */
            height: 25px;
            position: relative;
            padding: 1px;
            vertical-align: top;
        }

        .gigi-nomor {
            font-size: 7pt;
            color: #333;
        }

        .gigi-kondisi {
            font-weight: bold;
            font-size: 14pt;
            line-height: 1;
        }

        .gigi-kosong {
            border: none;
        }

        .pembatas-horizontal {
            border-top: 1px solid black;
            height: 5px;
        }

        .pembatas-vertikal {
            border-left: 1px solid black;
            border-right: 1px solid black;
            width: 1px !important;
        }

        .gigi-lubang .gigi-kondisi {
            color: red;
            letter-spacing: -1px;
            /* Biar /// lebih rapat */
        }

        /* === CSS BARU: Skala Nyeri Versi Tabel (PDF-SAFE) === */
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
        .grad-0 { background-color: #5cb85c; }
        .grad-1 { background-color: #7EC368; }
        .grad-2 { background-color: #A0CE74; }
        .grad-3 { background-color: #C2D980; }
        .grad-4 { background-color: #E4E48C; }
        .grad-5 { background-color: #FFFF99; }
        .grad-6 { background-color: #F8D57D; }
        .grad-7 { background-color: #F1AC61; }
        .grad-8 { background-color: #E98445; }
        .grad-9 { background-color: #E25B29; }
        .grad-10 { background-color: #d9534f; }

        .pain-scale-ticks td {
            font-size: 9pt;
            line-height: 0.5;
            padding-top: 0;
            border-left: 1px solid #000;
        }
        .pain-scale-ticks td:first-child { border-left: none; } /* Hapus border tick pertama */
        .pain-scale-ticks .tick-label {
            display: inline-block;
            margin-top: -2px; /* Tarik ke atas */
        }


        .pain-scale-faces td {
            font-size: 7pt;
            line-height: 1.1;
            vertical-align: top;
            padding-top: 3px;
        }

        .pain-scale-faces .emoji {
            /* font-size: 16pt; */ /* DIHAPUS: tidak perlu lagi */
            line-height: 1;
        }
        /* BARU: Style untuk gambar emoji */
        .pain-scale-faces .emoji img {
            width: 25px;
            height: 25px;
            display: block;
            margin: 0 auto 2px auto; /* Posisikan di tengah */
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
            width: 14px; /* Lebar lingkaran */
            height: 14px; /* Tinggi lingkaran */
            line-height: 14px; /* Vertikal center */
            border: 1px solid #000;
            border-radius: 50%; /* Bikin bulat */
            background-color: #ffffa0;
            font-weight: bold;
            font-size: 8pt;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <!-- KOP SURAT (dari template lama) -->
        <table class="header-table">
            <tr>
                <td style="width: 58%;">
                    <img src="{{ public_path('images/LogoPuskesmas.png') }}" alt="Logo" class="logo">
                    <div class="puskesmas-info">
                        <div style="font-weight:bold; font-size: 11pt;">UPT PUSKESMAS BENGKALIS</div>
                        <div style="font-size:8pt;">Jalan Awang Mahmud Desa Sel. Alam</div>
                        <div style="font-size:8pt;">Hp. 0811760071 Kode Pos 28734</div>
                    </div>
                </td>
                <td style="width: 42%;">
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

        <!-- JUDUL BARU -->
        <div class="title">ASESMEN RAWAT JALAN GIGI & MULUT</div>
        <div class="subtitle">Asesmen Keperawatan</div>

        <!-- Layout Tanggal (dari template lama) -->
        <table style="width: 100%; margin-bottom: 5px;">
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

        <!-- ASESMEN KEPERAWATAN (dari template lama) -->
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

        <!-- TANDA VITAL (dari template lama) -->
        <table class="ttv-table" style="margin-top: 5px;">
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
        <div style="font-size: 8pt; font-style: italic;">*Bila 0-59 bulan, Lingkar Kepala ........ cm, LILA: ........ cm
        </div>

        <!-- SKALA NYERI (DIUBAH TOTAL ke Versi Tabel) -->
        <div class="field-group" style="margin-top: 5px;">
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
                 <!-- Baris 4: Emoticon & Teks -->
                <tr class="pain-scale-faces">
                    <td> <!-- 0 -->
                        {{-- DIUBAH: dari emoji teks ke gambar --}}
                        <div class="emoji"><img src="{{ public_path('images/emoji/smile.png') }}" alt="0"></div>
                        <div class="face-title">Tidak Nyeri</div>
                        <div class="face-range">0</div>
                    </td>
                    <td></td> <!-- 1 -->
                    <td> <!-- 2 -->
                        {{-- DIUBAH: dari emoji teks ke gambar --}}
                        <div class="emoji"><img src="{{ public_path('images/emoji/slight-smile.png') }}" alt="1-3"></div>
                        <div class="face-title">Ringan</div>
                        <div class="face-range">1–3</div>
                    </td>
                    <td></td> <!-- 3 -->
                    <td> <!-- 4 -->
                        {{-- DIUBAH: dari emoji teks ke gambar --}}
                         <div class="emoji"><img src="{{ public_path('images/emoji/neutral.png') }}" alt="4-6"></div>
                        <div class="face-title">Sedang</div>
                        <div class="face-range">4–6</div>
                    </td>
                    <td></td> <!-- 5 -->
                    <td> <!-- 6 -->
                        {{-- DIUBAH: dari emoji teks ke gambar --}}
                        <div class="emoji"><img src="{{ public_path('images/emoji/worried.png') }}" alt="7"></div>
                        <div class="face-title">Berat</div>
                        <div class="face-range">7</div>
                    </td>
                    <td></td> <!-- 7 -->
                    <td> <!-- 8 -->
                        {{-- DIUBAH: dari emoji teks ke gambar --}}
                        <div class="emoji"><img src="{{ public_path('images/emoji/pain.png') }}" alt="8-9"></div>
                        <div class="face-title">Sangat Berat</div>
                        <div class="face-range">8–9</div>
                    </td>
                    <td></td> <!-- 9 -->
                    <td> <!-- 10 -->
                        {{-- DIUBAH: dari emoji teks ke gambar --}}
                        <div class="emoji"><img src="{{ public_path('images/emoji/crying.png') }}" alt="10"></div>
                        <div class="face-title">Tak Tahan</div>
                        <div class="face-range">10</div>
                    </td>
                </tr>
            </table>
        </div>


        <!-- STATUS FUNGSIONAL & RISIKO JATUH (dari template lama) -->
        <div class="field-group">
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

        <b style="display: block; margin-top: 5px;">RISIKO JATUH:</b>
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

        <table class="full-width" style="margin-top: 3px;">
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

        <div class="field-group" style="margin-top: 5px;">
            <b>A:</b>
            <div class="data-content">{!! nl2br(e($record->a_keperawatan ?? '-')) !!}</div>
        </div>
        <div class="field-group">
            <!-- DIHAPUS: "AQ" yang nyasar -->
            <b>P:</b>
            <div class="data-content">{!! nl2br(e($record->p_keperawatan ?? '-')) !!}</div>
        </div>

        <div class="signature-box" style="height: 80px;"> 
            <div class="signer-right"> 
                ______________________
                <div class="signature-space"></div>
                (Nama dan TTD Perawat)
            </div>
        </div>

        <!-- ASESMEN MEDIS (Konten BARU untuk GIGI) -->
        <div class="section-title">Asesmen Medis</div>

        <div class="field-group"><b>Anamnesis (S):</b>
            <div class="data-content">{!! nl2br(e($record->anamnesis_medis ?? '-')) !!}</div>
        </div>

        <!-- === ODONTOGRAM PDF (dari kode baru) === -->
        <div class="field-group odontogram-pdf-container">
            <b>Objektif (O) Odontogram:</b>
            @php
                $gigiData = [
                    'atas_kanan' => [18, 17, 16, 15, 14, 13, 12, 11],
                    'atas_kiri' => [21, 22, 23, 24, 25, 26, 27, 28],
                    'susu_atas_kanan' => [55, 54, 53, 52, 51],
                    'susu_atas_kiri' => [61, 62, 63, 64, 65],
                    'bawah_kanan' => [48, 47, 46, 45, 44, 43, 42, 41],
                    'bawah_kiri' => [31, 32, 33, 34, 35, 36, 37, 38],
                    'susu_bawah_kanan' => [85, 84, 83, 82, 81],
                    'susu_bawah_kiri' => [71, 72, 73, 74, 75],
                ];
                $odontogramRecord = $record->odontogram ?? [];

                $renderGigiCell = function ($nomorGigi, $odontogram) {
                    $kondisi = $odontogram[(string) $nomorGigi] ?? [];
                    $simbol = '&nbsp;';
                    $class = '';

                    if (in_array('cabut', $kondisi)) {
                        $simbol = 'X';
                    } elseif (in_array('tambal', $kondisi)) {
                        $simbol = 'O';
                    } elseif (in_array('lubang', $kondisi)) {
                        $simbol = '///'; /* DIUBAH: Simbol jadi /// */
                        $class = 'gigi-lubang'; /* DIUBAH: Class baru */
                    }

                    return '<td class="' .
                        $class .
                        '">
                                <div class="gigi-nomor">' .
                        $nomorGigi .
                        '</div>
                                <div class="gigi-kondisi">' .
                        $simbol .
                        '</div>
                            </td>';
                };
            @endphp

            <table class="odontogram-pdf">
                <tbody>
                    <!-- BARIS 1: DEWASA ATAS -->
                    <tr>
                        @foreach ($gigiData['atas_kanan'] as $g)
                            {!! $renderGigiCell($g, $odontogramRecord) !!}
                        @endforeach
                        <td class="gigi-kosong pembatas-vertikal"></td>
                        @foreach ($gigiData['atas_kiri'] as $g)
                            {!! $renderGigiCell($g, $odontogramRecord) !!}
                        @endforeach
                    </tr>
                    <!-- BARIS 2: SUSU ATAS -->
                    <tr>
                        <td class="gigi-kosong" colspan="3"></td>
                        @foreach ($gigiData['susu_atas_kanan'] as $g)
                            {!! $renderGigiCell($g, $odontogramRecord) !!}
                        @endforeach
                        <td class="gigi-kosong pembatas-vertikal"></td>
                        @foreach ($gigiData['susu_atas_kiri'] as $g)
                            {!! $renderGigiCell($g, $odontogramRecord) !!}
                        @endforeach
                        <td class="gigi-kosong" colspan="3"></td>
                    </tr>
                    <!-- PEMBATAS -->
                    <tr>
                        <td class="gigi-kosong pembatas-horizontal" colspan="17"></td>
                    </tr>
                    <!-- BARIS 3: SUSU BAWAH -->
                    <tr>
                        <td class="gigi-kosong" colspan="3"></td>
                        @foreach (array_reverse($gigiData['susu_bawah_kanan']) as $g)
                            {!! $renderGigiCell($g, $odontogramRecord) !!}
                        @endforeach
                        <td class="gigi-kosong pembatas-vertikal"></td>
                        @foreach ($gigiData['susu_bawah_kiri'] as $g)
                            {!! $renderGigiCell($g, $odontogramRecord) !!}
                        @endforeach
                        <td class="gigi-kosong" colspan="3"></td>
                    </tr>
                    <!-- BARIS 4: DEWASA BAWAH -->
                    <tr>
                        @foreach (array_reverse($gigiData['bawah_kanan']) as $g)
                            {!! $renderGigiCell($g, $odontogramRecord) !!}
                        @endforeach
                        <td class="gigi-kosong pembatas-vertikal"></td>
                        @foreach ($gigiData['bawah_kiri'] as $g)
                            {!! $renderGigiCell($g, $odontogramRecord) !!}
                        @endforeach
                    </tr>
                </tbody>
            </table>
            <div style="font-size: 7pt; text-align: left; margin-top: 2px;">
                Keterangan Simbol: <b>X</b> = Dicabut, <b>O</b> = Tambalan, <b>Arsiran</b> = Berlubang
            </div>
        </div>

        <div class="field-group"><b>Assessment/Diagnosa (A):</b>
            <div class="data-content">{!! nl2br(e($record->assessment_diagnosa_medis ?? '-')) !!}</div>
        </div>
        <!-- ICD X (BARU) -->
        <div class="field-group"><b>ICD X:</b> {{ $record->icd_x ?? '-' }}</div>

        <div class="field-group"><b>Rencana Terapi/Planning (P):</b>
            <div class="data-content">{!! nl2br(e($record->rencana_terapi_medis ?? '-')) !!}</div>
        </div>


        <!-- RENCANA TINDAK LANJUT (dari template lama) -->
        <div class="section-title"
            style="text-align: left; padding-left: 5px; background-color: #fff; border: none; border-top: 1px solid #000; border-bottom: 1px solid #000; margin-top: 8px;">
            RENCANA TINDAK LANJUT:
        </div>

        @php $rujuk_internal = $record->rujuk_internal ?? []; @endphp
        <div class="field-group" style="margin-top: 4px;">
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

        <!-- TTD DOKTER GIGI (BARU) -->
        <div class="signature-box">
            <div class="signer-right">
                Dokter Gigi Pemeriksa
                <div class="signature-space"></div>
                ( {{ $dokter?->name ?? '____________________' }} )
            </div>
        </div>

    </div> <!-- End of main-container -->
</body>

</html>


