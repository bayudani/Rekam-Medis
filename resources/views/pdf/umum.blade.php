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

        /* CSS BARU UNTUK INFO PASIEN */
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
            /* Lebih rapat */
            vertical-align: top;
        }

        .pasien-info-box .label {
            font-weight: bold;
            width: 35%;
        }

        /* CSS BARU UNTUK KOTAK JUDUL */
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

        .signature-box {
            margin-top: 30px;
            width: 100%;
        }

        .signature-box .signer {
            display: inline-block;
            width: 48%;
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
                    <!-- AREA PASIEN YANG DIPERBAIKI -->
                    <div class="pasien-info-box">
                        <table>
                            <tr>
                                <td class="label">Nama</td>
                                <td>: {{ $record->pasien?->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="label">Tgl. Lahir/Umur</td>
                                <td>:
                                    {{ $record->pasien?->tgl_lahir ? \Carbon\Carbon::parse($record->pasien->tgl_lahir)->format('d/m/Y') . ' (' . \Carbon\Carbon::parse($record->pasien->tgl_lahir)->age . ' Thn)' : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Jenis Kelamin</td>
                                <td>: {{ $record->pasien?->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            </tr>
                            <tr>
                                <td class="label">No. RM</td>
                                <td>: {{ $record->pasien?->no_rm ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="label">No. BPJS</td>
                                <td>: {{ $record->pasien?->no_bpjs ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="label">Alamat</td>
                                <td>: {{ $record->pasien?->alamat ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

        <!-- AREA JUDUL YANG DIPERBAIKI -->
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
        {{-- <hr style="border-top: 1px dotted #000; margin-top: 2px; margin-bottom: 5px;"> --}}

        <!-- Sisa konten tetap sama -->
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

        {{-- kebiasaan --}}
        <div class="field-group">
            <b>Kebiasaan:</b>
            @php $kebiasaan = $record->kebiasaan ?? []; @endphp
            <span class="checkbox-item"><span class="checkbox">{{ in_array('Rokok', $kebiasaan) ? 'X' : '' }}</span>
                Rokok</span>
            <span class="checkbox-item"><span class="checkbox">{{ in_array('Alkohol', $kebiasaan) ? 'X' : '' }}</span>
                Alkohol</span>
            <span class="checkbox-item"><span class="checkbox">{{ in_array('Obat Tidur', $kebiasaan) ? 'X' : '' }}</span>
                Obat Tidur</span>
            <span class="checkbox-item"><span class="checkbox">{{ in_array('Olahraga', $kebiasaan) ? 'X' : '' }}</span>
                Olahraga</span>
            <b>Lain-lain:</b> {{ $record->kebiasaan_lainnya ?? '-' }}

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
            </tr>
            <tr>
                <td style="border: none;">TB: {{ $record->tb ?? '-' }} cm</td>
                <td style="border: none;">BB: {{ $record->bb ?? '-' }} kg</td>
                <td style="border: none;">IMT: {{ $record->imt ?? '-' }}</td>
                <td style="border: none;">SpO₂: {{ $record->spo2 ?? '-' }} %</td>
            </tr>
        </table>

        <div class="field-group">
            <b>Skala Nyeri:</b>
            <div class="checkbox-container">
                <span class="checkbox-item"><span class="checkbox">{{ !$record->skala_nyeri ? 'X' : '' }}</span>
                    Tidak</span>
                <span class="checkbox-item"><span class="checkbox">{{ $record->skala_nyeri ? 'X' : '' }}</span> Ya,
                    Skor: {{ $record->skor_nyeri ?? '-' }}</span>
            </div>
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
                    <th>No</th>
                    <th>Penilaian</th>
                    <th>Ya</th>
                    <th>Tidak</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">1</td>
                    <td>Cara berjalan pasien (Tidak seimbang/sempoyongan/limbung)</td>
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
        <div style="margin-top: 5px;"><b>Hasil:</b> {{ $record->risiko_jatuh_hasil ?? '-' }}</div>

        <div class="field-group" style="margin-top: 10px;"><b>A:</b>
            <div class="textarea-content">{!! nl2br(e($record->a_keperawatan ?? '-')) !!}</div>
        </div>
        <div class="field-group"><b>P:</b>
            <div class="textarea-content">{!! nl2br(e($record->p_keperawatan ?? '-')) !!}</div>
        </div>

        <hr> <!-- Pemisah antar bagian -->
        <div class="section-title">ASESMEN MEDIS</div>
        <div class="field-group"><b>Anamnesis (S):</b>
            <div class="textarea-content">{!! nl2br(e($record->anamnesis_medis ?? '-')) !!}</div>
        </div>
        <div class="field-group"><b>Objektif (O) Odontogram:</b>
            <div class="textarea-content">{{ $record->odontogram ? implode(', ', $record->odontogram) : '-' }}</div>
        </div>
        <div class="field-group"><b>Assessment/Diagnosa (A):</b>
            <div class="textarea-content">{!! nl2br(e($record->assessment_diagnosa_medis ?? '-')) !!}</div>
        </div>
        <div class="field-group"><b>ICD X:</b> {{ $record->icd_x ?? '-' }}</div>
        <div class="field-group"><b>Rencana Terapi/Planning (P):</b>
            <div class="textarea-content">{!! nl2br(e($record->rencana_terapi_medis ?? '-')) !!}</div>
        </div>

        <hr> <!-- Pemisah antar bagian -->
        <div class="section-title">RENCANA TINDAK LANJUT</div>
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

        <div class="signature-box">
            <div class="signer">
                Dokter Gigi Pemeriksa
                <div class="signature-space"></div>
                ( {{ $record->dokter?->name ?? '____________________' }} )
            </div>
            <div class="signer" style="float: right;">
                (Nama dan TTD Perawat)
                <div class="signature-space"></div>
                ( ____________________ )
            </div>
        </div>
    </div> <!-- End of main-container -->
</body>

</html>
