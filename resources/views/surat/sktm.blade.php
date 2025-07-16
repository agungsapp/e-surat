<!DOCTYPE html>
<html lang="en">

<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Surat Keterangan Tidak Mampu</title>

		<style>
				body {
						font-family: Arial, sans-serif;
						margin: 40px;
						line-height: 1.6;
				}

				.center {
						text-align: center;
				}

				.bold {
						font-weight: bold;
				}

				.underline {
						text-decoration: underline;
				}

				.content {
						margin-top: 20px;
				}

				.table {
						margin-top: 10px;
						margin-bottom: 10px;
				}

				.table td {
						padding: 2px 4px;
						vertical-align: top;
						text-transform: capitalize;
						line-height: 1;
				}

				.signature {
						margin-top: 40px;
						float: right;
						text-align: left;
				}

				* {
						font-size: 12px;
				}
		</style>
</head>

<body>
		<div style="position: relative">
				<img style="position: absolute; height: 100px;" src="https://jukubatu.my.id/surat/image/logo.png" alt="Logo"
						width="80">
				<br>
				<div class="center">
						<div style="font-size: 14px" class="bold">
								PEMERINTAH KABUPATEN WAY KANAN
						</div>
						<div style="font-size: 14px" class="bold">
								KAMPUNG JUKU BATU
						</div>
						<div style="font-size: 14px" class="bold">KECAMATAN BANJIT</div>
						<div style="max-width: 70%; margin: 0 auto; font-size: 8px">
								Alamat: Jl. Curup Putri Malu Kampung Juku Batu Kecamatan Banjit Kabupaten Waykanan Kode Pos 347766
						</div>
						<br />
				</div>
		</div>

		<div style="border: 2px solid black; margin-bottom: 2px"></div>
		<div style="border: 1px solid black; margin-bottom: 1.5rem"></div>

		<div class="bold center underline">SURAT KETERANGAN TIDAK MAMPU</div>
		<div class="center bold">Nomor: {{ $permohonan->nomor_surat }}</div>

		<div class="content">
				<table class="table">
						<tr>
								<td>KEPALA KAMPUNG</td>
								<td>: Juku Batu</td>
						</tr>
				</table>

				<table class="table">
						<tr>
								<td style="width: 170px">MENERANGKAN BAHWA</td>
								<td>: Saudara</td>
						</tr>
						@php
								$pemohon = \App\Models\Penduduk::find($permohonan->id_penduduk);
						@endphp
						@if ($pemohon)
								<tr>
										<td>Nama</td>
										<td style="font-weight: bold">: {{ $pemohon->nama }}</td>
								</tr>
								<tr>
										<td>Nomor NIK</td>
										<td>: {{ $pemohon->nik }}</td>
								</tr>
								<tr>
										<td>Tempat / Tgl. Lahir</td>
										<td>: {{ $pemohon->tempat_lahir }}, {{ $pemohon->tanggal_lahir }}</td>
								</tr>
								<tr>
										<td>Jenis Kelamin</td>
										<td>: {{ $pemohon->jenis_kelamin }}</td>
								</tr>
								<tr>
										<td>Warga Negara</td>
										<td>: Indonesia</td>
								</tr>
								<tr>
										<td>Agama</td>
										<td>: {{ $pemohon->agama }}</td>
								</tr>
								<tr>
										<td>Pekerjaan</td>
										<td>: {{ $pemohon->pekerjaan }}</td>
								</tr>
								<tr>
										<td>Alamat</td>
										<td>: {{ $pemohon->alamat }}</td>
								</tr>
						@endif
				</table>

				<table class="table">
						<tr>
								<td style="width: 170px">Benar adalah orang tua dari</td>
								<td>:</td>
						</tr>
						{{-- @php
								$anak = \App\Models\Penduduk::where('nik', $data['NIKAnak'])->first();
						@endphp --}}
						{{-- @dd($anak) --}}
						@if ($anak)
								<tr>
										<td>Nama</td>
										<td style="font-weight: bold">: {{ $anak->nama }}</td>
								</tr>
								<tr>
										<td>Nomor NIK</td>
										<td>: {{ $anak->nik }}</td>
								</tr>
								<tr>
										<td>Tempat / Tgl. Lahir</td>
										<td>: {{ $anak->tempat_lahir }}, {{ $anak->tanggal_lahir }}</td>
								</tr>
								<tr>
										<td>Jenis Kelamin</td>
										<td>: {{ $anak->jenis_kelamin }}</td>
								</tr>
								<tr>
										<td>Warga Negara</td>
										<td>: Indonesia</td>
								</tr>
								<tr>
										<td>Agama</td>
										<td>: {{ $anak->agama }}</td>
								</tr>
								<tr>
										<td>Pekerjaan</td>
										<td>: {{ $anak->pekerjaan }}</td>
								</tr>
								<tr>
										<td>Alamat KTP</td>
										<td>: {{ $anak->alamat }}</td>
								</tr>
						@endif
				</table>

				Yang tersebut di atas adalah Penduduk Kampung Juku Batu dan berdasarkan data dan pengamatan kami, orang tersebut
				adalah <span class="bold" style="text-transform: capitalize;">keluarga tidak mampu</span>, dengan penghasilan
				sebesar
				<span class="bold">Rp {{ number_format($data['Penghasilan'], 0, ',', '.') }}</span>.

				<br />
				Demikianlah Surat Keterangan Tidak Mampu ini dibuat untuk dapat dipergunakan sebagaimana mestinya. Atas perhatian
				dan kerjasamanya, kami ucapkan terima kasih.
		</div>

		<div class="signature" style="margin-top: 40px; width: 100%;">
				<table style="width: 100%;">
						<tr>
								<td style="width: 70%;"></td> <!-- Spacer -->
								<td style="width: 30%; text-align: center;">
										<div style="margin-bottom: 1rem; text-align: left;">
												<span>Dikeluarkan di: Juku Batu</span><br>
												<span>Pada Tanggal: {{ now()->format('d-m-Y') }}</span><br><br>
												<span>Kepala Kampung Juku Batu,</span>
										</div>
										<div style="text-align: center;">
												<div style="margin-bottom: 5px;">
														@if ($qrBase64)
																<img width="70" style="padding: 5px; border: 1px solid #000;" src="{{ $qrBase64 }}"
																		alt="QR Code Tanda Tangan">
														@else
																<img width="70" style="padding: 5px; border: 1px solid #000;"
																		src="{{ asset('surat/image/sampel.png') }}" alt="Tanda Tangan Sampel">
														@endif
												</div>
												<div>
														<span style="font-weight: bold; text-decoration: underline;">M. A. Khoirin, S.Pd</span>
												</div>
										</div>
								</td>
						</tr>
				</table>
		</div>
</body>

</html>
