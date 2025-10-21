<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Formulir Triase - {{ $record->pasien?->nama }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 9pt; color: #000; }
        @page { margin: 20px; }
        .container { width: 100%; }
        .header { text-align: center; margin-bottom: 15px; }
        .header h3 { margin: 0; font-size: 12pt; }
        .header p { margin: 0; font-size: 8pt; }
        .content-table { width: 100%; border-collapse: collapse; }
        .content-table td { border: 1px solid black; padding: 4px; vertical-align: top; }
        .label { font-weight: bold; }
        .section-title { background-color: #d3d3d3; text-align: center; font-weight: bold; padding: 4px; }
        .checkbox-item { display: inline-block; margin-right: 10px; }
        .checkbox { display: inline-block; width: 10px; height: 10px; border: 1px solid black; margin-right: 4px; text-align: center; line-height: 10px; vertical-align: middle; }
    </style>
</head>
<body>
    @php
        // Ambil data rekam medis terbaru (atau yang pertama)
        $rekamMedis = $record->rekamMedis->first();
    @endphp
    
    @if(!$rekamMedis)
        <div style="text-align: center; padding: 50px;">
            <h3>Data Formulir Triase belum tersedia</h3>
        </div>
    @else
    <div class="container">
        <div class="header">
            <h3>PEMERINTAH KABUPATEN BENGKALIS</h3>
            <h3>DINAS KESEHATAN</h3>
            <p>UNIT PELAKSANA TEKNIS PUSKESMAS BENGKALIS<br>Jalan Awang Mahmud, Desa Selat Alam, Kode Pos 28714</p>
        </div>
        <div style="text-align: center; font-weight: bold; font-size: 11pt; margin-bottom: 10px; text-decoration: underline;">
            FORMULIR TRIASE PASIEN GAWAT DARURAT
        </div>

        <table class="content-table">
            {{-- Baris Info Pasien & Info Kedatangan --}}
            <tr>
                <td width="50%">
                    <b>No. RM:</b> {{ $record->pasien?->no_rm }} <br>
                    <b>Nama Pasien:</b> {{ $record->pasien?->nama }} <br>
                    <b>Tgl. Lahir/Umur:</b> 
                    @if($record->pasien?->tgl_lahir)
                        {{ \Carbon\Carbon::parse($record->pasien->tgl_lahir)->format('d/m/Y') }} 
                        ({{ \Carbon\Carbon::parse($record->pasien->tgl_lahir)->age }} Thn)
                    @else
                        -
                    @endif
                    <br>
                    <b>Jenis Kelamin:</b> {{ $record->pasien?->jk == 'L' ? 'Laki-laki' : 'Perempuan' }} <br>
                    <b>Alamat:</b> {{ $record->pasien?->alamat }} <br>
                    <hr>
                    <b>Riwayat Penyakit Dahulu:</b><br>{{ $rekamMedis->riwayat_penyakit_dahulu ?? '-' }}<br>
                    <b>Trauma:</b> {{ $rekamMedis->trauma ? 'Ya' : 'Tidak' }}<br>
                </td>
                <td width="50%">
                    <b>Cara datang:</b> {{ $rekamMedis->cara_datang ? implode(', ', $rekamMedis->cara_datang) : '-' }}<br>
                    <b>Tanggal Datang:</b> {{ $rekamMedis->tanggal_datang ? \Carbon\Carbon::parse($rekamMedis->tanggal_datang)->format('d/m/Y') : '-' }} <br>
                    <b>Jam Datang:</b> {{ $rekamMedis->jam_datang ? \Carbon\Carbon::parse($rekamMedis->jam_datang)->format('H:i') : '-' }} <br>
                    <b>Jam Diperiksa:</b> {{ $rekamMedis->jam_diperiksa ? \Carbon\Carbon::parse($rekamMedis->jam_diperiksa)->format('H:i') : '-' }} <br>
                    <b>Jam DOA:</b> {{ $rekamMedis->jam_doa ? \Carbon\Carbon::parse($rekamMedis->jam_doa)->format('H:i') : '-' }} <br>
                    <b>Riwayat Alergi:</b> {{ $rekamMedis->riwayat_alergi ?? '-' }} <br>
                    <b>Penanggung Jawab Biaya:</b> {{ $rekamMedis->penanggung_jawab_biaya ? implode(', ', $rekamMedis->penanggung_jawab_biaya) : '-' }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Tanda Kehidupan (-):</b> {{ $rekamMedis->tanda_kehidupan_negatif ? implode(', ', $rekamMedis->tanda_kehidupan_negatif) : 'Tidak ada' }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Kondisi:</b> 
                    @foreach(['Gawat Darurat', 'Darurat', 'Tidak Gawat Tidak Darurat', 'Meninggal'] as $kondisi)
                        <span class="checkbox-item">
                            <span class="checkbox">{{ $rekamMedis->kondisi == $kondisi ? 'X' : '' }}</span> 
                            {{ $kondisi }}
                        </span>
                    @endforeach
                </td>
            </tr>
            
            {{-- Initial Assessment & Triase Primer --}}
            <tr>
                <td colspan="2" class="section-title">INITIAL ASSESSMENT & TRIASE PRIMER</td>
            </tr>
            <tr>
                <td>
                    <b>Initial Assessment:</b><br>
                    <b>Pupil:</b> {{ $rekamMedis->pupil ?? '-' }}<br>
                    <b>GCS Awal:</b> {{ $rekamMedis->gcs_awal ?? '-' }}<br>
                    <b>Refleks Cahaya:</b> {{ $rekamMedis->refleks_cahaya ?? '-' }}<br>
                    <b>Pemeriksaan:</b> {{ $rekamMedis->pemeriksaan_awal ? implode(', ', $rekamMedis->pemeriksaan_awal) : '-' }}
                </td>
                <td>
                    <b>Resusitasi:</b> {{ $rekamMedis->resusitasi ? implode(', ', $rekamMedis->resusitasi) : '-' }}<br>
                    <b>Emergency:</b> {{ $rekamMedis->emergency ? implode(', ', $rekamMedis->emergency) : '-' }}
                </td>
            </tr>
            
            {{-- Triase Sekunder --}}
            <tr>
                <td colspan="2" class="section-title">TRIASE SEKUNDER</td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Urgent:</b> {{ $rekamMedis->urgent ? implode(', ', $rekamMedis->urgent) : '-' }} <br>
                    <b>Non Urgent:</b> {{ $rekamMedis->non_urgent ? implode(', ', $rekamMedis->non_urgent) : '-' }} <br>
                    <b>False Emergency:</b> {{ $rekamMedis->false_emergency ? implode(', ', $rekamMedis->false_emergency) : '-' }}
                </td>
            </tr>
            
            {{-- Tanda Vital --}}
            <tr>
                <td colspan="2" class="section-title">TANDA VITAL & KEADAAN UMUM</td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Kesadaran:</b> {{ $rekamMedis->kesadaran ?? '-' }}<br>
                    <b>TD:</b> {{ $rekamMedis->td ?? '-' }} mmHg &nbsp;
                    <b>HR:</b> {{ $rekamMedis->hr ?? '-' }} x/mnt &nbsp;
                    <b>RR:</b> {{ $rekamMedis->rr ?? '-' }} x/mnt &nbsp;
                    <b>T:</b> {{ $rekamMedis->t ?? '-' }} °C <br>
                    <b>BB:</b> {{ $rekamMedis->bb ?? '-' }} kg &nbsp;
                    <b>TB:</b> {{ $rekamMedis->tb ?? '-' }} cm <br>
                    <b>Ada Keluhan Nyeri:</b> {{ $rekamMedis->ada_keluhan_nyeri ? 'Ya, Skor: ' . $rekamMedis->skor_nyeri : 'Tidak' }}
                </td>
            </tr>
        </table>
    </div>
    @endif
</body>
</html>