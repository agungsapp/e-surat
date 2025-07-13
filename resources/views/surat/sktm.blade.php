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
				<img style="position: absolute; height: 100px;" src="https://diratiara.my.id/surat/image/logo.png" alt="Logo"
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
						<tr>
								<td>Nama</td>
								<td style="font-weight: bold">: {{ $data['OrangTua']['Nama'] }}</td>
						</tr>
						<tr>
								<td>Nomor NIK</td>
								<td>: {{ $data['OrangTua']['NIK'] }}</td>
						</tr>
						<tr>
								<td>Tempat / Tgl. Lahir</td>
								<td>: {{ $data['OrangTua']['TempatLahir'] }}, {{ $data['OrangTua']['TanggalLahir'] }}</td>
						</tr>
						<tr>
								<td>Jenis Kelamin</td>
								<td>: {{ $data['OrangTua']['JenisKelamin'] }}</td>
						</tr>
						<tr>
								<td>Warga Negara</td>
								<td>: Indonesia</td>
						</tr>
						<tr>
								<td>Agama</td>
								<td>: {{ $data['OrangTua']['Agama'] }}</td>
						</tr>
						<tr>
								<td>Pekerjaan</td>
								<td>: {{ $data['OrangTua']['Pekerjaan'] }}</td>
						</tr>
						<tr>
								<td>Alamat</td>
								<td>: {{ $data['OrangTua']['Alamat'] }}</td>
						</tr>
				</table>

				Benar adalah orang tua dari
				<table class="table">
						<tr>
								<td style="width: 170px">Nama</td>
								<td style="font-weight: bold">: {{ $data['Anak']['Nama'] }}</td>
						</tr>
						<tr>
								<td>Nomor KTP/NIK</td>
								<td>: {{ $data['Anak']['NIK'] }}</td>
						</tr>
						<tr>
								<td>Tempat / Tgl. Lahir</td>
								<td>: {{ $data['Anak']['TempatLahir'] }}, {{ $data['Anak']['TanggalLahir'] }}</td>
						</tr>
						<tr>
								<td>Jenis Kelamin</td>
								<td>: {{ $data['Anak']['JenisKelamin'] }}</td>
						</tr>
						<tr>
								<td>Warga Negara</td>
								<td>: Indonesia</td>
						</tr>
						<tr>
								<td>Agama</td>
								<td>: {{ $data['Anak']['Agama'] }}</td>
						</tr>
						<tr>
								<td>Pekerjaan</td>
								<td>: {{ $data['Anak']['Pekerjaan'] }}</td>
						</tr>
						<tr>
								<td>Alamat KTP</td>
								<td>: {{ $data['Anak']['AlamatKTP'] }}</td>
						</tr>
				</table>

				Yang tersebut di atas adalah Penduduk Kampung Juku Batu dan berdasarkan data dan pengamatan kami, orang tersebut
				adalah
				<span class="bold" style="text-transform: capitalize;">keluarga tidak mampu</span>, dengan penghasilan sebesar
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
												<span>Pada Tanggal: {{ $data['TanggalPenerbitan'] }}</span><br><br>
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
