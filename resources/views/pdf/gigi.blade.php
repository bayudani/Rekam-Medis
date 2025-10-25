<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Asesmen Rawat Jalan Gigi - {{ $record->pasien?->nama }}</title>
    <style>
        /* CSS Lengkap untuk Tampilan Presisi */
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 9pt;
            color: #000;
        }

        @page {
            margin: 25px;
        }

        .main-container {
            border: 1px solid #000;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
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

        .pasien-info-box {
            border: 1px solid black;
            padding: 5px;
        }

        .pasien-info-box table {
            width: 100%;
            border-collapse: collapse;
        }

        .pasien-info-box td {
            padding: 2px;
            vertical-align: top;
        }

        /* Disesuaikan agar lebih rapat seperti di gambar */
        .pasien-info-box .label {
            font-weight: normal;
            /* Di gambar tidak bold */
            width: 30%;
        }

        .title-box {
            border-bottom: 1px solid black;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 11pt;
            text-decoration: underline;
            margin-bottom: 3px;
        }

        .subtitle {
            text-align: center;
            font-weight: bold;
            font-size: 10pt;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 4px;
            font-size: 10pt;
        }

        /* Judul Section Terpusat (BARU) */
        .section-title-center {
            text-align: center;
            font-weight: bold;
            font-size: 10pt;
            margin-top: 10px;
            margin-bottom: 5px;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 2px 0;
        }


        .field-group {
            margin-bottom: 5px;
        }

        .checkbox-container {
            margin-top: 3px;
        }

        .checkbox-item {
            display: inline-block;
            margin-right: 10px;
        }

        .checkbox {
            display: inline-block;
            width: 10px;
            height: 10px;
            border: 1px solid black;
            margin-right: 4px;
            text-align: center;
            line-height: 10px;
            vertical-align: middle;
        }

        .textarea-content {
            border: 1px dotted #666;
            padding: 3px;
            min-height: 20px;
            margin-top: 2px;
        }

        table.full-width {
            width: 100%;
            border-collapse: collapse;
        }

        .full-width td,
        .full-width th {
            padding: 3px;
            border: 1px solid black;
            vertical-align: top;
        }

        .full-width th {
            font-weight: bold;
            text-align: center;
        }

        /* Box Tanda Tangan (BARU) */
        .signature-box-right {
            margin-top: 10px;
            margin-bottom: 10px;
            width: 100%;
            text-align: right;
        }

        .signature-box-right .signer {
            display: inline-block;
            width: 250px;
            /* Disesuaikan agar di kanan */
            text-align: center;
        }

        /* Box Tanda Tangan Bawah (Diedit) */
        .signature-box-bottom {
            margin-top: 30px;
            width: 100%;
            text-align: right;
            /* Diarahkan ke kanan */
        }

        .signature-box-bottom .signer {
            display: inline-block;
            width: 250px;
            /* Disesuaikan */
            text-align: center;
        }


        .signature-space {
            height: 60px;
        }

        .flex-container {
            display: -webkit-box;
            display: -webkit-flex;
            display: flex;
            width: 100%;
        }

        .flex-item {
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            flex: 1;
        }

        .text-right {
            text-align: right;
        }

        /* === CSS UNTUK ODONTOGRAM PDF (DIPERBAIKI) === */
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
            /* DIUBAH: Disesuaikan untuk 17 kolom */
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

        .arsiran {
            background: repeating-linear-gradient(45deg,
                    #cccccc,
                    #cccccc 1px,
                    rgba(255, 255, 255, 0) 1px,
                    rgba(255, 255, 255, 0) 4px);
        }

        /* DIUBAH: CSS Skala Nyeri dompdf-safe */
        .nyeri-skala-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .nyeri-skala-table td {
            width: 16.6%;
            /* 100 / 6 */
            text-align: center;
            vertical-align: top;
            padding: 2px;
            border: none;
            /* Hapus border */
        }

        .nyeri-skala-icon img {
            width: 25px;
            height: 25px;
        }

        .nyeri-skala-icon {
            font-size: 18pt;
            /* Ukuran emoji */
            line-height: 1;
        }

        .nyeri-skala-label {
            font-size: 7pt;
            /* Kecilkan font label */
            font-weight: bold;
            line-height: 1.2;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <!-- KOP SURAT -->
        <table class="header-table">
            <tr>
                <td style="width: 55%;">
                    <img src="{{ public_path('images/LogoPuskesmas.png') }}" alt="Logo" class="logo">
                    <div class="puskesmas-info">
                        <div style="font-weight:bold; font-size: 11pt;">UPT PUSKESMAS BENGKALIS</div>
                        <div style="font-size:8pt;">Jalan Awang Mahmud Desa Sel. Alam<br>Hp. 0811760071 Kode Pos 28734
                        </div>
                    </div>
                </td>
                <td style="width: 45%;">
                    <div class="pasien-info-box">
                        <table>
                            <tr>
                                <td class="label">Nama</td>
                                <td>: {{ $record->pasien?->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="label">Tgl. Lahir</td>
                                <!-- Diringkas -->
                                <td>:
                                    {{ $record->pasien?->tgl_lahir ? \Carbon\Carbon::parse($record->pasien->tgl_lahir)->format('d/m/Y') . ' (' . \Carbon\Carbon::parse($record->pasien->tgl_lahir)->age . ' Thn)' : '-' }}
                                </td>
                            </tr>
                            <!-- Jenis Kelamin dipindah ke bawah jika perlu, atau dihapus dari box ini -->
                            <tr>
                                <td class="label">Alamat</td>
                                <td>: {{ $record->pasien?->alamat ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="label">No. RM</td>
                                <td>: {{ $record->pasien?->no_rm ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="label">No. BPJS</td>
                                <td>: {{ $record->pasien?->no_bpjs ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

        <!-- JUDUL -->
        <div class="title-box">
            <div class="title">ASESMEN RAWAT JALAN GIGI & MULUT</div>
            <div class="subtitle">(Asesmen Keperawatan)</div>
        </div>

        <div class="flex-container">
            <div class="flex-item"><b>Hari/Tanggal:</b>
                {{ $record->tanggal_asesmen ? \Carbon\Carbon::parse($record->tanggal_asesmen)->format('d F Y') : '-' }}
            </div>
            <div class="flex-item text-right"><b>Jam:</b>
                {{ $record->tanggal_asesmen ? \Carbon\Carbon::parse($record->tanggal_asesmen)->format('H:i') : '-' }}
                WIB</div>
        </div>
        <hr style="border-top: 1px dotted #000; margin-top: 2px; margin-bottom: 5px;">

        <!-- KONTEN LAINNYA ... -->
        <div class="field-group">
            <b>Hambatan Pelayanan:</b>
            <div class="checkbox-container">
                @php $hambatan = $record->hambatan_pelayanan ?? []; @endphp
                <span class="checkbox-item"><span
                        class="checkbox">{{ in_array('Tidak ada', $hambatan) ? 'X' : '' }}</span> Tidak ada</span>
                <span class="checkbox-item"><span class="checkbox">{{ in_array('Ada', $hambatan) ? 'X' : '' }}</span>
                    Ada</span>
                <span class="checkbox-item"><span
                        class="checkbox">{{ in_array('Bahasa', $hambatan) ? 'X' : '' }}</span> Bahasa</span>
                <span class="checkbox-item"><span class="checkbox">{{ in_array('Fisik', $hambatan) ? 'X' : '' }}</span>
                    Fisik</span>
                <span class="checkbox-item"><span class="checkbox">{{ in_array('Tuli', $hambatan) ? 'X' : '' }}</span>
                    Tuli</span>
                <span class="checkbox-item"><span class="checkbox">{{ in_array('Bisu', $hambatan) ? 'X' : '' }}</span>
                    Bisu</span>
                <span class="checkbox-item"><span class="checkbox">{{ in_array('Buta', $hambatan) ? 'X' : '' }}</span>
                    Buta</span>
            </div>
        </div>

        <div class="field-group">
            <b>Status Sosial:</b>
            <div class="checkbox-container">
                <span class="checkbox-item"><span
                        class="checkbox">{{ $record->status_sosial == 'Menikah' ? 'X' : '' }}</span> Menikah</span>
                <span class="checkbox-item"><span
                        class="checkbox">{{ $record->status_sosial == 'Belum Menikah' ? 'X' : '' }}</span> Belum
                    Menikah</span>
                <span class="checkbox-item"><span
                        class="checkbox">{{ $record->status_sosial == 'Cerai' ? 'X' : '' }}</span> Cerai</span>
            </div>
        </div>
        <div class="field-group"><b>S:</b>
            <div class="textarea-content">{!! nl2br(e($record->s_keperawatan ?? '-')) !!}</div>
        </div>

        <div class="field-group">
            <b>Riwayat Kesehatan:</b>
            @php $riwayat = $record->riwayat_kesehatan ?? []; @endphp
            <span class="checkbox-item"><span class="checkbox">{{ in_array('Hipertensi', $riwayat) ? 'X' : '' }}</span>
                Hipertensi</span>
            <span class="checkbox-item"><span class="checkbox">{{ in_array('Jantung', $riwayat) ? 'X' : '' }}</span>
                Jantung</span>
            <span class="checkbox-item"><span class="checkbox">{{ in_array('Diabetes', $riwayat) ? 'X' : '' }}</span>
                Diabetes</span>
            <span class="checkbox-item"><span class="checkbox">{{ in_array('TB Paru', $riwayat) ? 'X' : '' }}</span> TB
                Paru</span>
            <b>Lain-lain:</b> {{ $record->riwayat_kesehatan_lainnya ?? '-' }}
        </div>

        <!-- BARU: Kebiasaan -->
        <div class="field-group">
            <b>Kebiasaan:</b>
            @php $kebiasaan = $record->kebiasaan ?? []; @endphp
            <span class="checkbox-item"><span class="checkbox">{{ in_array('Rokok', $kebiasaan) ? 'X' : '' }}</span>
                Rokok</span>
            <span class="checkbox-item"><span class="checkbox">{{ in_array('Alkohol', $kebiasaan) ? 'X' : '' }}</span>
                Alkohol</span>
            <span class="checkbox-item"><span
                    class="checkbox">{{ in_array('Obat Tidur', $kebiasaan) ? 'X' : '' }}</span>
                Obat Tidur</span>
            <span class="checkbox-item"><span class="checkbox">{{ in_array('Olahraga', $kebiasaan) ? 'X' : '' }}</span>
                Olahraga</span>
        </div>

        <div class="field-group">
            <b>Alergi:</b>
            <div class="checkbox-container">
                <span class="checkbox-item"><span class="checkbox">{{ !$record->ada_alergi ? 'X' : '' }}</span>
                    Tidak</span>
                <span class="checkbox-item"><span class="checkbox">{{ $record->ada_alergi ? 'X' : '' }}</span> Ya,
                    jelaskan: {{ $record->alergi_keterangan ?? '-' }}</span>
            </div>
        </div>

        <div class="field-group">
            <b>Status Psikologis:</b>
            <div class="checkbox-container">
                @php $psikologis = $record->status_psikologis ?? []; @endphp
                <span class="checkbox-item"><span
                        class="checkbox">{{ in_array('Tenang', $psikologis) ? 'X' : '' }}</span> Tenang</span>
                <span class="checkbox-item"><span
                        class="checkbox">{{ in_array('Cemas', $psikologis) ? 'X' : '' }}</span> Cemas</span>
                <span class="checkbox-item"><span
                        class="checkbox">{{ in_array('Takut', $psikologis) ? 'X' : '' }}</span> Takut</span>
                <span class="checkbox-item"><span
                        class="checkbox">{{ in_array('Marah', $psikologis) ? 'X' : '' }}</span> Marah</span>
                <span class="checkbox-item"><span
                        class="checkbox">{{ in_array('Sedih', $psikologis) ? 'X' : '' }}</span> Sedih</span>
                <span class="checkbox-item"><span
                        class="checkbox">{{ in_array('Cenderung Bunuh Diri', $psikologis) ? 'X' : '' }}</span>
                    Cenderung Bunuh Diri</span>
            </div>
        </div>

        <div class="field-group"><b>O:</b>
            <div class="textarea-content">{!! nl2br(e($record->o_keperawatan ?? '-')) !!}</div>
        </div>

        <b>Tanda-Tanda Vital:</b>
        <table class="full-width" style="border: none;">
            <tr>
                <td style="border: none;">TD: {{ $record->td ?? '-' }} mmHg</td>
                <td style="border: none;">RR: {{ $record->rr ?? '-' }} x/mnt</td>
                <td style="border: none;">HR: {{ $record->hr ?? '-' }} x/mnt</td>
                <td style="border: none;">T: {{ $record->t ?? '-' }} °C</td>
                <!-- BARU: Lingkar Perut -->
                <td style="border: none;">Lingkar Perut: {{ $record->lingkar_perut ?? '-' }} cm</td>
            </tr>
            <tr>
                <td style="border: none;">TB: {{ $record->tb ?? '-' }} cm</td>
                <td style="border: none;">BB: {{ $record->bb ?? '-' }} kg</td>
                <td style="border: none;">IMT: {{ $record->imt ?? '-' }}</td>
                <td style="border: none;">SpO₂: {{ $record->spo2 ?? '-' }} %</td>
                <td style="border: none;">&nbsp;</td>
                <!-- Placeholder -->
            </tr>
            <!-- BARU: Lingkar Kepala & LILA -->
            <tr>
                <td colspan="3" style="border: none;">(usia 0-60 bulan) Lingkar Kepala:
                    {{ $record->lingkar_kepala ?? '-' }} cm</td>
                <td colspan="2" style="border: none;">LILA: {{ $record->lila ?? '-' }} cm</td>
            </tr>
        </table>

        <div class="field-group">
            <!-- Diedit: Skala Nyeri -> NYERI -->
            <b>NYERI:</b>
            <div class="checkbox-container">
                <span class="checkbox-item"><span class="checkbox">{{ !$record->skala_nyeri ? 'X' : '' }}</span>
                    Tidak</span>
                <span class="checkbox-item"><span class="checkbox">{{ $record->skala_nyeri ? 'X' : '' }}</span> Ya,
                    Skor: {{ $record->skor_nyeri ?? '-' }}</span>
            </div>

            <!-- DIUBAH: Skala Nyeri Emoticon diganti Tabel (dompdf-safe) & Label baru -->
            <table class="nyeri-skala-table">
                <tr>
                    <td class="nyeri-skala-icon">
                        <img src="{{ public_path('images/emoji/smile.png') }}" alt="0">
                    </td>
                    <td class="nyeri-skala-icon">
                        <img src="{{ public_path('images/emoji/slight-smile.png') }}" alt="1-3">
                    </td>
                    <td class="nyeri-skala-icon">
                        <img src="{{ public_path('images/emoji/neutral.png') }}" alt="4-6">
                    </td>
                    <td class="nyeri-skala-icon">
                        <img src="{{ public_path('images/emoji/worried.png') }}" alt="7">
                    </td>
                    <td class="nyeri-skala-icon">
                        <img src="{{ public_path('images/emoji/pain.png') }}" alt="8-9">
                    </td>
                    <td class="nyeri-skala-icon">
                        <img src="{{ public_path('images/emoji/crying.png') }}" alt="10">
                    </td>
                </tr>
                <tr>
                    <td class="nyeri-skala-label">0<br>Tidak Nyeri</td>
                    <td class="nyeri-skala-label">1-3<br>Ringan</td>
                    <td class="nyeri-skala-label">4-6<br>Sedang</td>
                    <td class="nyeri-skala-label">7<br>Berat</td>
                    <td class="nyeri-skala-label">8-9<br>Sangat Berat</td>
                    <td class="nyeri-skala-label">10<br>Tak Tertahankan</td>
                </tr>
            </table>
            <!-- Akhir Skala Nyeri -->
        </div>

        <div class="field-group">
            <b>Status Fungsional:</b>
            <div class="checkbox-container">
                <span class="checkbox-item"><span
                        class="checkbox">{{ $record->status_fungsional == 'Mandiri' ? 'X' : '' }}</span>
                    Mandiri</span>
                <span class="checkbox-item"><span
                        class="checkbox">{{ $record->status_fungsional == 'Perlu Bantuan' ? 'X' : '' }}</span> Perlu
                    Bantuan</span>
                <span class="checkbox-item"><span
                        class="checkbox">{{ $record->status_fungsional == 'Ketergantungan Total' ? 'X' : '' }}</span>
                    Ketergantungan Total</span>
            </div>
        </div>

        <b>Risiko Jatuh:</b>
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
                    <td>Cara berjalan pasien (Tidak seimbang/sempoyongan/limbung) / Jalan menggunakan alat bantu
                    </td>
                    <td style="text-align: center;">{{ $record->risiko_jatuh_penilaian_1 ? 'V' : '' }}</td>
                    <td style="text-align: center;">{{ !$record->risiko_jatuh_penilaian_1 ? 'V' : '' }}</td>
                </tr>
                <tr>
                    <td style="text-align: center;">2</td>
                    <td>Menopang saat akan duduk</td>
                    <td style="text-align: center;">{{ $record->risiko_jatuh_penilaian_2 ? 'V' : '' }}</td>
                    <td style="text-align: center;">{{ !$record->risiko_jatuh_penilaian_2 ? 'V' : '' }}</td>
                </tr>
            </tbody>
        </table>

        <table class="full-width" style="margin-top: 5px;">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Hasil Penilaian</th>
                    <th colspan="2">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">1</td>
                    <td><b>TIDAK BERISIKO</b> <br> <small>(tidak ditemukan no 1 & 2)</small></td>
                    <td>Tidak ada tindakan</td>
                    <td style="text-align: center;">
                        {{ $record->risiko_jatuh_hasil == 'Tidak Berisiko' ? 'V' : '' }}</td>
                </tr>
                <tr>
                    <td style="text-align: center;">2</td>
                    <td><b>RISIKO RENDAH</b> <br> <small>(ditemukan salah satu no 1 & 2)</small></td>
                    <td>Edukasi</td>
                    <td style="text-align: center;">
                        {{ $record->risiko_jatuh_hasil == 'Risiko Rendah' ? 'V' : '' }}</td>
                </tr>
                <tr>
                    <td style="text-align: center;">3</td>
                    <td><b>RISIKO TINGGI</b> <br> <small>(ditemukan no 1 & 2)</small></td>
                    <td>Pemantauan</td>
                    <td style="text-align: center;">
                        {{ $record->risiko_jatuh_hasil == 'Risiko Tinggi' ? 'V' : '' }}</td>
                </tr>
            </tbody>
        </table>

        <div class="field-group" style="margin-top: 10px;"><b>A:</b>
            <div class="textarea-content">{!! nl2br(e($record->a_keperawatan ?? '-')) !!}</div>
        </div>

        <!-- BARU: Tanda Tangan Perawat Dipindah ke sini -->
        <div class="signature-box-right">
            <div class="signer">
                (Nama dan TTD Perawat)
                <div class="signature-space"></div>
                ( ____________________ )
            </div>
        </div>


        <!-- BARU: Judul Section Terpusat -->
        <div class="section-title-center">ASESMEN MEDIS</div>

        <div class="field-group"><b>Anamnesis (S):</b>
            <div class="textarea-content">{!! nl2br(e($record->anamnesis_medis ?? '-')) !!}</div>
        </div>

        <!-- === ODONTOGRAM PDF (VERSI FINAL ANTI-KEPOTONG) === -->
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
                        $class = 'arsiran';
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
            <div class="textarea-content">{!! nl2br(e($record->assessment_diagnosa_medis ?? '-')) !!}</div>
        </div>
        <div class="field-group"><b>ICD X:</b> {{ $record->icd_x ?? '-' }}</div>
        <div class="field-group"><b>Rencana Terapi/Planning (P):</b>
            <div class="textarea-content">{!! nl2br(e($record->rencana_terapi_medis ?? '-')) !!}</div>
        </div>

        <!-- BARU: Judul Section -->
        <div class="section-title" style="margin-top: 10px;">RENCANA TINDAK LANJUT</div>

        <div class="field-group">
            <b>Rujuk Internal:</b>
            <div class="checkbox-container">
                @php $rujuk_internal = $record->rujuk_internal ?? []; @endphp
                <span class="checkbox-item"><span
                        class="checkbox">{{ in_array('Gizi', $rujuk_internal) ? 'X' : '' }}</span> Gizi</span>
                <span class="checkbox-item"><span
                        class="checkbox">{{ in_array('Gigi', $rujuk_internal) ? 'X' : '' }}</span> Gigi</span>
                <span class="checkbox-item"><span
                        class="checkbox">{{ in_array('R. Tindakan', $rujuk_internal) ? 'X' : '' }}</span> R.
                    Tindakan</span>
                <span class="checkbox-item"><span
                        class="checkbox">{{ in_array('VCT/IMS', $rujuk_internal) ? 'X' : '' }}</span> VCT/IMS</span>
                <span class="checkbox-item"><span
                        class="checkbox">{{ in_array('Lain-lain', $rujuk_internal) ? 'X' : '' }}</span>
                    Lain-lain</span>
            </div>
        </div>
        <div class="field-group">
            <b>Rujuk Eksternal:</b>
            <div class="checkbox-container">
                @php $rujuk_eksternal = $record->rujuk_eksternal ?? []; @endphp
                <span class="checkbox-item"><span
                        class="checkbox">{{ in_array('RSUD Bengkalis', $rujuk_eksternal) ? 'X' : '' }}</span> RSUD
                    Bengkalis</span>
            </div>
        </div>

        <!-- Diedit: Tanda Tangan Dokter Saja, di Kanan -->
        <div class="signature-box-bottom">
            <div class="signer">
                Dokter Gigi Pemeriksa
                <div class="signature-space"></div>
                ( {{ $record->dokter?->name ?? '____________________' }} )
            </div>
        </div>

    </div> <!-- End of main-container -->
</body>

</html>
