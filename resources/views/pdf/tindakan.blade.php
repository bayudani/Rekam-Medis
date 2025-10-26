<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Formulir Triase - {{ $record->pasien?->nama }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 8pt; /* Ukuran font base lebih kecil */
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
            overflow: hidden; /* Clearfix */
        }
        .header-left {
            float: left;
            width: 15%; /* Sesuaikan lebar logo */
            text-align: left;
        }
        .header-center {
            float: left;
            width: 70%;
            text-align: center;
        }
        .header-right {
            float: right;
            width: 15%; /* Sesuaikan lebar teks kanan */
            text-align: right;
            font-size: 10pt;
            font-weight: bold;
            padding-top: 5px; /* Sesuaikan posisi vertikal */
        }
        .header h3 {
            margin: 0;
            font-size: 10pt; /* Lebih kecil */
        }
        .header p {
            margin: 0;
            font-size: 7pt;
            line-height: 1.2;
        }
        .logo {
            width: 50px; /* Ukuran logo disesuaikan */
            height: auto;
        }


        .title {
            text-align: center;
            font-weight: bold;
            font-size: 10pt;
            margin: 8px 0;
            border: 1px solid #000;
            padding: 3px;
            background-color: #e0e0e0; /* Warna abu lebih muda */
        }

        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
            font-size: 7pt; /* Font tabel lebih kecil lagi */
        }

        .content-table td,
        .content-table th {
            border: 1px solid black;
            padding: 2px; /* Padding lebih kecil */
            vertical-align: top;
            line-height: 1.3; /* Sedikit renggang */
        }

        .content-table th {
            background-color: #d0d0d0; /* Warna abu header tabel */
            font-weight: bold;
            text-align: center;
        }
        /* Header kolom spesifik */
        .th-red { background-color: #DC143C; color: #fff; }
        .th-yellow { background-color: #FFD700; }
        .th-green { background-color: #90EE90; }
        .th-black { background-color: #000000; color: #fff; }


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
            /* text-decoration: underline; */ /* Di gambar tidak underline */
            font-size: 7.5pt;
        }

        .checkbox-item {
            display: inline-block;
            margin-right: 5px; /* Jarak lebih rapat */
            white-space: nowrap;
            font-size: 7pt;
        }

        .checkbox {
            display: inline-block;
            width: 9px; /* Checkbox lebih kecil */
            height: 9px;
            border: 1px solid black;
            margin-right: 2px;
            text-align: center;
            line-height: 9px;
            vertical-align: middle;
            font-size: 7pt;
            font-weight: bold; /* Tanda check bold */
        }

        .color-box {
            display: inline-block;
            width: 15px; /* Box warna lebih kecil */
            height: 10px;
            vertical-align: middle;
            margin-left: 2px;
            border: 1px solid #000;
        }

        .red { background-color: #DC143C; } /* Crimson */
        .yellow { background-color: #FFD700; } /* Gold */
        .green { background-color: #90EE90; } /* LightGreen */
        .black { background-color: #000000; }

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
            width: 9.09%; /* 100% / 11 kolom */
            border: none; /* Hapus border sel */
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
            line-height: 1;
        }
        /* Style untuk gambar emoji */
        .pain-scale-faces .emoji img {
            width: 25px; /* Ukuran gambar disesuaikan */
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

        /* Lingkaran untuk skor terpilih */
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
        }
        .gcs-number {
             border: 1px solid #000;
             width: 15px;
             height: 15px;
             display: inline-block;
             line-height: 15px;
             margin: 0 1px;
        }
         .gcs-number.selected {
             background-color: #ffffa0;
             font-weight: bold;
         }

        .signature {
            text-align: right;
            margin-top: 15px; /* Lebih dekat */
            font-size: 8pt;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        table { page-break-inside: auto; }
        tr { page-break-inside: avoid; page-break-after: auto; }
        td { word-wrap: break-word; } /* Cegah teks panjang overflow */

    </style>
</head>

<body>
    @php
        // Ambil data rekam medis terkait (pastikan relasi 'rekamMedis' ada di model $record)
        $rekamMedis = $record->rekamMedis()->first();
        // Default GCS jika data tidak ada
        $gcs_e = $rekamMedis->gcs_e ?? null;
        $gcs_v = $rekamMedis->gcs_v ?? null;
        $gcs_m = $rekamMedis->gcs_m ?? null;
        // Variabel skala nyeri disesuaikan untuk skala horizontal
        $skala_nyeri = ($rekamMedis && $rekamMedis->ada_keluhan_nyeri && isset($rekamMedis->skala_nyeri_angka)) ? (int)$rekamMedis->skala_nyeri_angka : -1;
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
            <table class="content-table">
                {{-- Baris Info Pasien & Info Kedatangan --}}
                <tr>
                    <td width="35%" rowspan="3"> <!-- Rowspan 3 untuk info pasien -->
                        <b>No. RM:</b> {{ $record->pasien?->no_rm ?? '-' }} <br>
                        <b>Nama Pasien:</b> {{ $record->pasien?->nama ?? '-' }} <br>
                        <b>Jenis Kelamin:</b>
                         {{ $record->pasien?->jk == 'L' ? 'Laki-laki / Perempuan' : 'Laki-laki / Perempuan' }}<br> <!-- Diperbaiki -->
                        <b>Tgl Lahir/Umur:</b>
                        {{ $record->pasien?->tgl_lahir ? \Carbon\Carbon::parse($record->pasien->tgl_lahir)->format('d/m/Y') . ' (' . \Carbon\Carbon::parse($record->pasien->tgl_lahir)->age . ' Thn)' : '-' }}
                        <br>
                        <b>Alamat:</b> {{ $record->pasien?->alamat ?? '-' }}
                    </td>
                    <td width="30%" rowspan="2"> <!-- Rowspan 2 untuk Cara datang -->
                        <b>Cara datang:</b><br>
                        @php $caraDatang = $rekamMedis->cara_datang ?? []; @endphp
                        <span class="checkbox-item"><span class="checkbox">{{ in_array('Sendiri', $caraDatang) ? '✓' : '' }}</span> Sendiri</span><br>
                        <span class="checkbox-item"><span class="checkbox">{{ in_array('Diantar Keluarga', $caraDatang) ? '✓' : '' }}</span> Diantar Keluarga</span><br>
                        <span class="checkbox-item"><span class="checkbox">{{ in_array('Diantar Polisi', $caraDatang) ? '✓' : '' }}</span> Diantar Polisi</span><br>
                        <span class="checkbox-item"><span class="checkbox">{{ in_array('Rujukan/Ambulance', $caraDatang) ? '✓' : '' }}</span> Rujukan/Ambulance</span><br> <!-- Sesuai gambar -->
                        <span class="checkbox-item"><span class="checkbox">{{ in_array('Dokter Luar', $caraDatang) ? '✓' : '' }}</span> Dokter Luar</span><br> <!-- Sesuai gambar -->
                        <span class="checkbox-item"><span class="checkbox">{{ in_array('Kecelakaan', $caraDatang) ? '✓' : '' }}</span> Kecelakaan</span><br> <!-- Sesuai gambar -->
                    </td>
                    <td width="35%"> <!-- Tanggal & Jam Datang -->
                        <b>Tanggal Datang:</b>
                        {{ $rekamMedis->tanggal_datang ? \Carbon\Carbon::parse($rekamMedis->tanggal_datang)->format('d/m/Y') : '-' }}<br>
                        <b>Jam Datang:</b>
                        {{ $rekamMedis->jam_datang ? \Carbon\Carbon::parse($rekamMedis->jam_datang)->format('H:i') : '-' }}
                    </td>
                </tr>
                 <tr><!-- Baris kedua, kolom 3 untuk Jam Diperiksa & DOA -->
                    <td>
                        <b>Jam Diperiksa:</b>
                        {{ $rekamMedis->jam_diperiksa ? \Carbon\Carbon::parse($rekamMedis->jam_diperiksa)->format('H:i') : '-' }}<br>
                         <span class="checkbox-item"><span class="checkbox">{{ $rekamMedis->doa ? '✓' : '' }}</span> DOA - Jam:</span> <!-- Sesuai gambar -->
                        {{ $rekamMedis->jam_doa ? \Carbon\Carbon::parse($rekamMedis->jam_doa)->format('H:i') : '.......' }}
                    </td>
                </tr>
                <tr><!-- Baris ketiga, kolom 2 & 3 -->
                    <td> <!-- Trauma -->
                        <b>Trauma:</b>
                        <span class="checkbox-item"><span class="checkbox">{{ !$rekamMedis->trauma ? '✓' : '' }}</span> Non Trauma</span>
                        <span class="checkbox-item"><span class="checkbox">{{ $rekamMedis->trauma ? '✓' : '' }}</span> Trauma</span>
                    </td>
                     <td> <!-- Penanggung Jawab & Tanda Kehidupan (-) -->
                        <b>Penanggung Jawab Biaya:</b><br>
                        @php $penanggung = $rekamMedis->penanggung_jawab_biaya ?? []; @endphp
                        <span class="checkbox-item"><span class="checkbox">{{ in_array('BPJS/KIS', $penanggung) ? '✓' : '' }}</span> BPJS/KIS</span>
                        <span class="checkbox-item"><span class="checkbox">{{ in_array('Jampersal', $penanggung) ? '✓' : '' }}</span> Jampersal</span><br>
                         <span class="checkbox-item"><span class="checkbox">{{ in_array('Askes/Swasta', $penanggung) ? '✓' : '' }}</span> Askes/Swasta</span> <!-- Sesuai gambar -->
                         <span class="checkbox-item"><span class="checkbox">{{ in_array('KK/KTP', $penanggung) ? '✓' : '' }}</span> KK/KTP</span><br>
                        <span class="checkbox-item"><span class="checkbox">{{ in_array('Umum', $penanggung) ? '✓' : '' }}</span> Umum</span><br>
                         <b>Tanda Kehidupan (-):</b><br>
                        @php $tandaNegatif = $rekamMedis->tanda_kehidupan_negatif ?? []; @endphp
                        <span class="checkbox-item"><span class="checkbox">{{ in_array('Denyut Nadi (-)', $tandaNegatif) ? '✓' : '' }}</span> Denyut Nadi (-)</span><br>
                        <span class="checkbox-item"><span class="checkbox">{{ in_array('Respirasi (-)', $tandaNegatif) ? '✓' : '' }}</span> Respirasi (-)</span><br>
                        <span class="checkbox-item"><span class="checkbox">{{ in_array('Pupil dilatasi maksimal', $tandaNegatif) ? '✓' : '' }}</span> Pupil dilatasi maksimal</span>
                    </td>
                </tr>
                <tr><!-- Baris keempat -->
                    <td colspan="2"> <!-- Riwayat Penyakit & Alergi -->
                         <b>Riwayat Penyakit Dahulu:</b><br>{{ $rekamMedis->riwayat_penyakit_dahulu ?: '-' }}
                         <br><br>
                         <b>Riwayat Alergi:</b><br>{{ $rekamMedis->riwayat_alergi ?: '-' }}
                    </td>
                    <td> <!-- Keluhan Utama -->
                        <b>Keluhan Utama:</b><br>
                         {{ $rekamMedis->keluhan_utama ?: '-' }}
                    </td>
                </tr>
                <tr> <!-- Baris Kelima: Kondisi -->
                    <td colspan="3">
                        <b>Kondisi:</b>
                        <span class="checkbox-item" style="margin-left: 10px;">
                            <span class="checkbox">{{ $rekamMedis->kondisi == 'Gawat Darurat' ? '✓' : '' }}</span>
                            <span class="color-box red"></span> Gawat Darurat
                        </span>
                        <span class="checkbox-item">
                            <span class="checkbox">{{ $rekamMedis->kondisi == 'Darurat' ? '✓' : '' }}</span>
                            <span class="color-box yellow"></span> Darurat
                        </span>
                        <span class="checkbox-item">
                            <span class="checkbox">{{ $rekamMedis->kondisi == 'Tidak Gawat Tidak Darurat' ? '✓' : '' }}</span>
                            <span class="color-box green"></span> Tidak Gawat Tidak Darurat
                        </span>
                        <span class="checkbox-item">
                            <span class="checkbox">{{ $rekamMedis->kondisi == 'Meninggal' ? '✓' : '' }}</span>
                            <span class="color-box black"></span> Meninggal
                        </span>
                    </td>
                </tr>

                {{-- Initial Assessment & Triase Primer --}}
                <tr>
                    <td colspan="3" class="section-title">Triase Primer</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="subsection-title">Initial Assessment</div>
                        <b>Pupil:</b>
                         <span class="checkbox-item"><span class="checkbox">{{ $rekamMedis->pupil == 'isokor' ? '✓' : '' }}</span> isokor</span> /
                         <span class="checkbox-item"><span class="checkbox">{{ $rekamMedis->pupil == 'anisokor' ? '✓' : '' }}</span> anisokor</span><br>
                         <b>Refleks cahaya:</b> {{ $rekamMedis->refleks_cahaya ?? '- / +' }}<br> <!-- Sesuai gambar -->
                        <b>Pemeriksaan:</b><br>
                        @php $pemeriksaanAwal = $rekamMedis->pemeriksaan_awal ?? []; @endphp
                        <table style="width:100%; border:none; margin-left:-2px;" cellpadding="1"> <!-- Rapatkan -->
                            <tr>
                                <td style="border:none; width:35%; font-weight:bold;">Airway & C-Spine Control</td>
                                <td style="border:none;">
                                     <span class="checkbox-item"><span class="checkbox">{{ in_array('Sumbatan', $pemeriksaanAwal) ? '✓' : '' }}</span> Sumbatan</span>
                                     <span class="checkbox-item"><span class="checkbox">{{ in_array('Bebas', $pemeriksaanAwal) ? '✓' : '' }}</span> Bebas</span> <!-- Sesuai gambar -->
                                </td>
                            </tr>
                            <tr>
                                <td style="border:none; font-weight:bold;">Breathing</td>
                                <td style="border:none;">
                                    <span class="checkbox-item"><span class="checkbox">{{ in_array('Henti Napas', $pemeriksaanAwal) ? '✓' : '' }}</span> Henti Napas</span>
                                    <span class="checkbox-item"><span class="checkbox">{{ in_array('Bradipnoe', $pemeriksaanAwal) ? '✓' : '' }}</span> Bradipnoe</span>
                                    <span class="checkbox-item"><span class="checkbox">{{ in_array('Sianosis', $pemeriksaanAwal) ? '✓' : '' }}</span> Sianosis</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="border:none; font-weight:bold;">Circulation</td>
                                <td style="border:none;">
                                    <span class="checkbox-item"><span class="checkbox">{{ in_array('Henti Jantung', $pemeriksaanAwal) ? '✓' : '' }}</span> Henti Jantung</span>
                                    <span class="checkbox-item"><span class="checkbox">{{ in_array('Nadi tidak teraba', $pemeriksaanAwal) ? '✓' : '' }}</span> Nadi tidak teraba</span>
                                    <span class="checkbox-item"><span class="checkbox">{{ in_array('Akral dingin', $pemeriksaanAwal) ? '✓' : '' }}</span> Akral dingin</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="border:none; font-weight:bold;">Disability</td>
                                <td style="border:none;">
                                    <span class="checkbox-item"><span class="checkbox">{{ in_array('GCS < 9', $pemeriksaanAwal) ? '✓' : '' }}</span> GCS < 9</span>
                                    <span class="checkbox-item"><span class="checkbox">{{ in_array('Kejang', $pemeriksaanAwal) ? '✓' : '' }}</span> Kejang</span>
                                    <span class="checkbox-item"><span class="checkbox">{{ in_array('Unresponsive', $pemeriksaanAwal) ? '✓' : '' }}</span> Unresponsive</span>
                                </td>
                            </tr>
                        </table>
                         <div class="subsection-title">GCS:</div>
                         <table class="gcs-table">
                              <tr>
                                   <td class="gcs-label">Eye:</td>
                                   <td><span class="gcs-number {{ $gcs_e == 4 ? 'selected' : '' }}">4</span></td>
                                   <td><span class="gcs-number {{ $gcs_e == 3 ? 'selected' : '' }}">3</span></td>
                                   <td><span class="gcs-number {{ $gcs_e == 2 ? 'selected' : '' }}">2</span></td>
                                   <td><span class="gcs-number {{ $gcs_e == 1 ? 'selected' : '' }}">1</span></td>
                                   <td style="width: 50%;"></td> <!-- Spacer -->
                              </tr>
                              <tr>
                                   <td class="gcs-label">Verbal:</td>
                                   <td><span class="gcs-number {{ $gcs_v == 5 ? 'selected' : '' }}">5</span></td>
                                   <td><span class="gcs-number {{ $gcs_v == 4 ? 'selected' : '' }}">4</span></td>
                                   <td><span class="gcs-number {{ $gcs_v == 3 ? 'selected' : '' }}">3</span></td>
                                   <td><span class="gcs-number {{ $gcs_v == 2 ? 'selected' : '' }}">2</span></td>
                                   <td><span class="gcs-number {{ $gcs_v == 1 ? 'selected' : '' }}">1</span></td>
                              </tr>
                              <tr>
                                   <td class="gcs-label">Motorik:</td>
                                   <td><span class="gcs-number {{ $gcs_m == 6 ? 'selected' : '' }}">6</span></td>
                                   <td><span class="gcs-number {{ $gcs_m == 5 ? 'selected' : '' }}">5</span></td>
                                   <td><span class="gcs-number {{ $gcs_m == 4 ? 'selected' : '' }}">4</span></td>
                                   <td><span class="gcs-number {{ $gcs_m == 3 ? 'selected' : '' }}">3</span></td>
                                   <td><span class="gcs-number {{ $gcs_m == 2 ? 'selected' : '' }}">2</span></td>
                                   <td><span class="gcs-number {{ $gcs_m == 1 ? 'selected' : '' }}">1</span></td>
                              </tr>
                         </table>
                    </td>
                    <td style="background-color: #fffacd;"> <!-- Warna kuning muda untuk Emergency -->
                        <div class="subsection-title" style="text-align: center;">Emergency</div>
                        @php $emergency = $rekamMedis->emergency ?? []; @endphp
                         <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Bebas', $emergency) ? '✓' : '' }}</span> Bebas</span>
                         <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Ancaman', $emergency) ? '✓' : '' }}</span> Ancaman</span><br>
                         <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Takipnoe (> 32 x / mnt)', $emergency) ? '✓' : '' }}</span> Takipnoe (> 32 x / mnt)</span>
                         <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Mengi', $emergency) ? '✓' : '' }}</span> Mengi</span><br>
                         <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Nadi teraba lemah', $emergency) ? '✓' : '' }}</span> Nadi teraba lemah</span>
                         <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Pucat', $emergency) ? '✓' : '' }}</span> Pucat</span>
                         <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Bradikardi', $emergency) ? '✓' : '' }}</span> Bradikardi</span>
                         <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Akral dingin', $emergency) ? '✓' : '' }}</span> Akral dingin</span>
                         <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Takikardi (120-150x/mnt)', $emergency) ? '✓' : '' }}</span> Takikardi (120-150x/mnt)</span>
                         <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('CRT > 2 detik', $emergency) ? '✓' : '' }}</span> CRT > 2 detik</span><br>
                         <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('GCS 9 - 12', $emergency) ? '✓' : '' }}</span> GCS 9 - 12</span>
                         <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Gelisah', $emergency) ? '✓' : '' }}</span> Gelisah</span>
                         <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Nyeri Dada', $emergency) ? '✓' : '' }}</span> Nyeri Dada</span>
                    </td>
                </tr>

                {{-- Triase Sekunder --}}
                <tr>
                    <td colspan="3" class="section-title">Triase Sekunder</td>
                </tr>
                <tr>
                    <th class="th-yellow" style="width:33%;">Urgent</th> <!-- Kuning -->
                    <th class="th-green" style="width:33%;">Non Urgent</th> <!-- Hijau -->
                    <th style="background-color: #ADD8E6; width:34%;">False Emergency</th> <!-- Biru Muda -->
                </tr>
                <tr>
                    <td>
                        @php $urgent = $rekamMedis->urgent ?? []; @endphp
                        <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Normal Airway', $urgent) ? '✓' : '' }}</span> Normal Airway</span>
                        <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Mengi', $urgent) ? '✓' : '' }}</span> Mengi</span>
                        <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Takipnoe', $urgent) ? '✓' : '' }}</span> Takipnoe</span><br>
                        <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Nadi Kuat', $urgent) ? '✓' : '' }}</span> Nadi Kuat</span>
                        <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Takikardi', $urgent) ? '✓' : '' }}</span> Takikardi</span><br>
                        <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('GCS > 12', $urgent) ? '✓' : '' }}</span> GCS > 12</span>
                        <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Apatis', $urgent) ? '✓' : '' }}</span> Apatis</span>
                        <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Somnolen', $urgent) ? '✓' : '' }}</span> Somnolen</span><br>
                        <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('38 - 39.9 °C', $urgent) ? '✓' : '' }}</span> 38 - 39.9 °C</span>
                    </td>
                    <td>
                        @php $nonUrgent = $rekamMedis->non_urgent ?? []; @endphp
                        <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Normal Airway', $nonUrgent) ? '✓' : '' }}</span> Normal Airway</span><br><br> <!-- Space -->
                        <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Nadi Kuat', $nonUrgent) ? '✓' : '' }}</span> Nadi Kuat</span>
                        <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Frek Normal', $nonUrgent) ? '✓' : '' }}</span> Frek Normal</span><br>
                        <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('GCS 15', $nonUrgent) ? '✓' : '' }}</span> GCS 15</span><br><br> <!-- Space -->
                        <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('< 38 °C', $nonUrgent) ? '✓' : '' }}</span> < 38 °C</span>
                    </td>
                    <td>
                        @php $falseEmergency = $rekamMedis->false_emergency ?? []; @endphp
                         <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Normal Airway', $falseEmergency) ? '✓' : '' }}</span> Normal Airway</span><br><br> <!-- Space -->
                         <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Nadi Kuat', $falseEmergency) ? '✓' : '' }}</span> Nadi Kuat</span>
                         <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Frek Normal', $falseEmergency) ? '✓' : '' }}</span> Frek Normal</span><br>
                         <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('GCS 15', $falseEmergency) ? '✓' : '' }}</span> GCS 15</span><br><br> <!-- Space -->
                         <span class="checkbox-item" style="display:block;"><span class="checkbox">{{ in_array('Normal Temp', $falseEmergency) ? '✓' : '' }}</span> Normal Temp</span> <!-- Sesuai gambar -->
                    </td>
                </tr>

                {{-- Tanda Vital --}}
                <tr>
                    <td colspan="3" class="section-title">Tanda Vital</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Keadaan Umum:</b> {{ $rekamMedis->keadaan_umum ?? '-' }}<br>
                        <b>Kesadaran:</b> {{ $rekamMedis->kesadaran ?? '-' }}<br>
                        <table style="width:100%; border:none; margin-top:3px;" cellpadding="1">
                            <tr>
                                <td style="border:none; width:10%;"><b>TD</b></td>
                                <td style="border:none; width:23%;">{{ $rekamMedis->td ?? '............' }} mmHg</td>
                                <td style="border:none; width:10%;"><b>HR</b></td>
                                <td style="border:none; width:23%;">{{ $rekamMedis->hr ?? '............' }} x/mnt</td>
                                <td style="border:none; width:10%;"><b>RR</b></td>
                                <td style="border:none; width:24%;">{{ $rekamMedis->rr ?? '............' }} x/mnt</td>
                            </tr>
                            <tr>
                                <td style="border:none;"><b>T</b></td>
                                <td style="border:none;">{{ $rekamMedis->t ?? '............' }} °C</td>
                                <td style="border:none;"><b>BB</b></td>
                                <td style="border:none;">{{ $rekamMedis->bb ?? '............' }} kg</td>
                                <td style="border:none;"><b>TB</b></td>
                                <td style="border:none;">{{ $rekamMedis->tb ?? '............' }} cm</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Apakah terdapat keluhan nyeri?</b>
                        <span class="checkbox-item"><span class="checkbox">{{ $rekamMedis->ada_keluhan_nyeri ? '✓' : '' }}</span> Ya</span>
                        <span class="checkbox-item"><span class="checkbox">{{ !$rekamMedis->ada_keluhan_nyeri ? '✓' : '' }}</span> Tidak</span>
                        <span style="margin-left: 20px;">/</span>
                        <b>Bila Ya, berapa skala nyerinya?</b>

                         <!-- Skala Nyeri Horizontal Baru -->
                         <table class="pain-scale-table">
                            <!-- Baris 1: Angka 0-10 -->
                            <tr class="pain-scale-labels">
                                <td><span class="{{ ($skala_nyeri == 0) ? 'nyeri-skor-terpilih-baru' : '' }}">0</span></td>
                                <td><span class="{{ ($skala_nyeri == 1) ? 'nyeri-skor-terpilih-baru' : '' }}">1</span></td>
                                <td><span class="{{ ($skala_nyeri == 2) ? 'nyeri-skor-terpilih-baru' : '' }}">2</span></td>
                                <td><span class="{{ ($skala_nyeri == 3) ? 'nyeri-skor-terpilih-baru' : '' }}">3</span></td>
                                <td><span class="{{ ($skala_nyeri == 4) ? 'nyeri-skor-terpilih-baru' : '' }}">4</span></td>
                                <td><span class="{{ ($skala_nyeri == 5) ? 'nyeri-skor-terpilih-baru' : '' }}">5</span></td>
                                <td><span class="{{ ($skala_nyeri == 6) ? 'nyeri-skor-terpilih-baru' : '' }}">6</span></td>
                                <td><span class="{{ ($skala_nyeri == 7) ? 'nyeri-skor-terpilih-baru' : '' }}">7</span></td>
                                <td><span class="{{ ($skala_nyeri == 8) ? 'nyeri-skor-terpilih-baru' : '' }}">8</span></td>
                                <td><span class="{{ ($skala_nyeri == 9) ? 'nyeri-skor-terpilih-baru' : '' }}">9</span></td>
                                <td><span class="{{ ($skala_nyeri == 10) ? 'nyeri-skor-terpilih-baru' : '' }}">10</span></td>
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
                                <td> <!-- 0 -->
                                    <div class="emoji"><img src="{{ public_path('images/emoji/smile.png') }}" alt="0"></div>
                                    <div class="face-title">Tidak Nyeri</div>
                                    <div class="face-range">0</div>
                                </td>
                                <td></td> <!-- 1 -->
                                <td> <!-- 2 -->
                                    <div class="emoji"><img src="{{ public_path('images/emoji/slight-smile.png') }}" alt="1-3"></div>
                                    <div class="face-title">Ringan</div>
                                    <div class="face-range">1–3</div>
                                </td>
                                <td></td> <!-- 3 -->
                                <td> <!-- 4 -->
                                     <div class="emoji"><img src="{{ public_path('images/emoji/neutral.png') }}" alt="4-6"></div>
                                    <div class="face-title">Sedang</div>
                                    <div class="face-range">4–6</div>
                                </td>
                                <td></td> <!-- 5 -->
                                <td> <!-- 6 -->
                                    <div class="emoji"><img src="{{ public_path('images/emoji/worried.png') }}" alt="7"></div>
                                    <div class="face-title">Berat</div>
                                    <div class="face-range">7</div>
                                </td>
                                <td></td> <!-- 7 -->
                                <td> <!-- 8 -->
                                    <div class="emoji"><img src="{{ public_path('images/emoji/pain.png') }}" alt="8-9"></div>
                                    <div class="face-title">Sangat Berat</div>
                                    <div class="face-range">8–9</div>
                                </td>
                                <td></td> <!-- 9 -->
                                <td> <!-- 10 -->
                                    <div class="emoji"><img src="{{ public_path('images/emoji/crying.png') }}" alt="10"></div>
                                    <div class="face-title">Tak Tahan</div>
                                    <div class="face-range">10</div>
                                </td>
                            </tr>
                        </table>
                         <!-- Akhir Skala Nyeri Horizontal Baru -->
                    </td>
                </tr>
            </table>

            <div class="signature">
                Petugas Triase<br><br><br><br> <!-- Space untuk TTD -->
                ( {{ $rekamMedis->petugasTriase?->name ?? '............................' }} ) <!-- Ambil nama petugas jika ada relasi -->
            </div>
        @else
            <div style="text-align: center; padding: 30px; border: 1px solid #ccc; margin-top: 20px;">
                Data Formulir Triase Gawat Darurat belum diisi untuk pendaftaran ini.
            </div>
        @endif
    </div>
</body>

</html>

