@extends('layouts.template')

@section('title', 'Data Penduduk Sementara')

@section('bread')
<li><a href="{{ url('admin') }}"><i class="icon-laptop"></i> Home</a></li>
<li class="active">Data Penduduk Sementara</li>
@endsection

@section('button', '')
@section('main')

	<div class="row">
		<div class="col-sm-12">	
			@include('errors/pesan_muncul')				
			<div class="clear panel panel-default">						
				<div class="panel-body">
					<div class="row">
						<div class="col-md-8">
							<h4>Data Penduduk Sementara</h4>
						</div>
						<div class="col-md-4">
							<a class="btn btn-large btn-warning item" href="{{url('data-penduduk-sementara/cetak/semua')}}" style="margin-left:10px" target="_blank"><i class="clip-file-pdf"></i> Cetak</a>
							<a class="btn btn-large btn-green item" href="#"  data-target="#tambah" data-toggle="modal"><i class="clip-plus-circle"></i> Tambah</a>
						</div>
					</div>
					<hr style="margin-top:0px">
					<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
						<thead>
							<tr>			
								<th rowspan="2" class="no">Nomor Urut</th>
								<th rowspan="2">Nama Lengkap</th>
								<th colspan="2">Jenis Kelamin</th>
								<th rowspan="2">Nomor<br>Identitas /<br>Tanda Pengenal</th>
								<th rowspan="2">Tempat dan<br> Tanggal<br>Lahir / Umur</th>
								<th rowspan="2">Pekerjaan</th>
								<th colspan="2">Kewarganegaraan</th>
								<th rowspan="2">Datang Dari</th>
								<th rowspan="2">Maksud dan Tujuan<br>Kedatangan</th>
								<th rowspan="2">Nama dan<br>Alamat yg<br>Didatangi</th>
								<th rowspan="2">Datang<br>Tanggal</th>
								<th rowspan="2">Pergi<br>Tanggal</th>
								{{-- <th rowspan="2">KET.</th> --}}
								<th rowspan="2" class="pilihan">Opsi</th>
							</tr>
							<tr>
								<th>L</th>
								<th>P</th>
								<th>Kebangsaan</th>	
								<th>Keturunan</th>	
							</tr>
						</thead>
						<tbody>
							@php
								$i = 1;
							@endphp
							@foreach ($penduduksementara as $p)
								<tr>
									<td align="center">{{$i++}}</td>
									<td>{{$p->nama}}</td>
									<td>@if($p->jenis_kelamin == 'L')L @endif</td>
									<td>@if($p->jenis_kelamin == 'P')P @endif</td>
									<td>{{$p->nomor_identitas}}</td>
									<td>{{$p->tmp_lahir}}, {{tgl_id($p->tgl_lahir)}}</td>
									<td>{{$p->pekerjaan}}</td>
									<td>@if($p->kewarganegaraan == 'WNI')WNI @endif</td>
									<td>@if($p->kewarganegaraan == 'WNA')WNA @endif</td>
									<td>{{$p->datang_dari}}</td>
									<td>{{$p->tujuan}}</td>
									<td>{{$p->nama_didatangi}},<br>{{$p->alamat_didatangi}}</td>
									<td>{{tgl_id($p->datang_tgl)}}</td>
									<td>{{tgl_id($p->pergi_tgl)}}</td>
									{{-- <td>{{$p->keterangan}}</td> --}}
									<td>
										<a data-original-title='Detail' class='btn btn-green btn-sm tooltips' href='{{ url('data-penduduk-sementara/'. $p->id)}}'>
											<i class='clip-eye'></i>
										</a>

										<a data-original-title='Edit' class='btn btn-sm btn-blue tooltips' href='{{ url('data-penduduk-sementara/'. $p->id .'/edit')}}'>
											<i class='clip-pencil'></i>
										</a>
										
										<form action="{{url('data-penduduk-sementara', $p->id)}}" method="post" style="display: inline-block;">
											{{ csrf_field() }}	
											<input type="hidden" name="_method" value="DELETE">
											<button type="submit" data-original-title='Hapus' class="btn btn-red btn-sm tooltips" onclick='return konfirmasiHapus()'><i class="clip-remove"></i></button>
										</form>
									</td>
								</tr>
							@endforeach

						</tbody>
					</table>
				</div>
				
			</div>
		</div>		
	</div>

	<div class="modal fade modal-crud" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
		<form action="{{url('data-penduduk-sementara')}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Data Penduduk Sementara</h4>
			</div>		
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class='form-group @if($errors->has('nama')) has-error @endif'>
							<label class='control-label'>Nama</label>
							<input type='text' placeholder='Nama' class='form-control limited' id='nama' name='nama' maxlength='45' value='@if(count($errors) > 0){{old('nama')}}@endif'
							required>

							@if ($errors->has('nama'))
								<span for="nama" class="help-block">{{ $errors->first('nama') }}</span>
							@endif
						</div>	
						<div class='form-group @if($errors->has('jenis_kelamin')) has-error @endif'>
							<label class='control-label'>Jenis Kelamin</label>
							<br>
							<label class='radio-inline'>
								<input type='radio' name='jenis_kelamin' class='square-green' value='L' @if(count($errors) > 0) @if(old('jenis_kelamin') == "L") checked @endif @endif>
								Laki-laki
							</label>
							<label class='radio-inline'>
								<input type='radio' name='jenis_kelamin' class='square-green' value='P' @if(count($errors) > 0) @if(old('jenis_kelamin') == "P") checked @endif @endif>
								Perempuan
							</label>

							@if ($errors->has('jenis_kelamin'))
								<span for="jenis_kelamin" class="help-block">{{ $errors->first('jenis_kelamin') }}</span>
							@endif
						</div>
						<div class='form-group @if($errors->has('nomor_identitas')) has-error @endif'>
							<label class='control-label'>Nomor Identitas</label>
							<input type='text' placeholder='Nomor Identitas' class='form-control limited' id='nomor_identitas' name='nomor_identitas' maxlength='45' value='@if(count($errors) > 0){{old('nomor_identitas')}}@endif'>

							@if ($errors->has('nomor_identitas'))
								<span for="nomor_identitas" class="help-block">{{ $errors->first('nomor_identitas') }}</span>
							@endif
						</div>				
						<div class="row">
							<div class="col-md-8">
								<div class='form-group @if($errors->has('tmp_lahir')) has-error @endif'>
									<label class='control-label'>Tempat Lahir</label>
									<input type='text' placeholder='Tempat Lahir' class='form-control limited' id='tmp_lahir' name='tmp_lahir' maxlength='45' value='@if(count($errors) > 0){{old('tmp_lahir')}}@endif' required>

									@if ($errors->has('tmp_lahir'))
										<span for="tmp_lahir" class="help-block">{{ $errors->first('tmp_lahir') }}</span>
									@endif
								</div>
							</div>
							<div class="col-md-4">
								<div class='form-group @if($errors->has('tgl_lahir')) has-error @endif'>
									<label class='control-label'>Tanggal Lahir</label>
									<div class="input-group">
										<input name="tgl_lahir" type="text" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker" value="@if(count($errors) > 0){{old('tgl_lahir')}}@endif" placeholder="Tanggal Lahir" required autocomplete="off">
										<span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
									</div>

									@if ($errors->has('tgl_lahir'))
										<span for="tgl_lahir" class="help-block">{{ $errors->first('tgl_lahir') }}</span>
									@endif
								</div>
							</div>
						</div>
						<div class='form-group @if($errors->has('pekerjaan')) has-error @endif'>
							<label class='control-label'>Pekerjaan</label>
							<input type='text' placeholder='Pekerjaan' class='form-control limited' id='pekerjaan' name='pekerjaan' maxlength='45' value='@if(count($errors) > 0){{old('pekerjaan')}}@endif' required>

							@if ($errors->has('pekerjaan'))
								<span for="pekerjaan" class="help-block">{{ $errors->first('pekerjaan') }}</span>
							@endif
						</div>
						<div class='form-group @if($errors->has('kewarganegaraan')) has-error @endif'>
							<label class='control-label'>Kewarganegaraan</label>
							<select name="kewarganegaraan" id="kewarganegaraan" class="form-control" required>
								<option value="">--- Pilih ---</option>
								<option value="WNI" @if(count($errors) > 0) @if(old('kewarganegaraan') == "WNI") selected @endif @endif>Warga Negara Indonesia</option>
								<option value="WNA" @if(count($errors) > 0) @if(old('kewarganegaraan') == "WNA") selected @endif @endif>Warga Negara Asing</option>
							</select>

							@if ($errors->has('kewarganegaraan'))
								<span for="nik" class="help-block">{{ $errors->first('kewarganegaraan') }}</span>
							@endif
						</div>
						<div class='form-group @if($errors->has('datang_dari')) has-error @endif'>
							<label class='control-label'>Datang Dari</label>
							<input type='text' placeholder='Datang Dari' class='form-control limited' id='datang_dari' name='datang_dari' maxlength='45' value='@if(count($errors) > 0){{old('pekerjaan')}}@endif' required>

							@if ($errors->has('datang_dari'))
								<span for="datang_dari" class="help-block">{{ $errors->first('datang_dari') }}</span>
							@endif
						</div>
						<div class='form-group @if($errors->has('tujuan')) has-error @endif'>
							<label class='control-label'>Maksud dan Tujuan Kedatangan</label>
							<input type='text' placeholder='Maksud dan Tujuan Kedatangan' class='form-control limited' id='tujuan' name='tujuan' maxlength='100' value='@if(count($errors) > 0){{old('tujuan')}}@endif' required>

							@if ($errors->has('tujuan'))
								<span for="tujuan" class="help-block">{{ $errors->first('tujuan') }}</span>
							@endif
						</div>
						<div class='form-group @if($errors->has('nama_didatangi')) has-error @endif'>
							<label class='control-label'>Nama yg Didatangi</label>
							<input type='text' placeholder='Nama yg Didatangi' class='form-control limited' id='nama_didatangi' name='nama_didatangi' maxlength='45' value='@if(count($errors) > 0){{old('nama_didatangi')}}@endif' required>

							@if ($errors->has('nama_didatangi'))
								<span for="nama_didatangi" class="help-block">{{ $errors->first('nama_didatangi') }}</span>
							@endif
						</div>
						<div class='form-group'>
							<label class='control-label'>Alamat yg Didatangi</label>
							<textarea class='form-control limited' id='alamat_didatangi' cols='10' rows='4' name='alamat_didatangi' style='height:75px; resize:none;' maxlength='160'>@if(count($errors) > 0){{old('alamat_didatangi')}}@endif</textarea>
						</div>	
						<div class='form-group @if($errors->has('datang_tgl')) has-error @endif'>
							<label class='control-label'>Datang Tanggal</label>
							<div class="input-group">
								<input name="datang_tgl" type="text" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker" value="@if(count($errors) > 0){{old('datang_tgl')}}@endif" placeholder="Datang Tanggal" required autocomplete="off">
								<span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
							</div>

							@if ($errors->has('datang_tgl'))
								<span for="datang_tgl" class="help-block">{{ $errors->first('datang_tgl') }}</span>
							@endif
						</div>
						<div class='form-group @if($errors->has('pergi_tgl')) has-error @endif'>
							<label class='control-label'>Pergi Tanggal</label>
							<div class="input-group">
								<input name="pergi_tgl" type="text" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker" value="@if(count($errors) > 0){{old('pergi_tgl')}}@endif" placeholder="Pergi Tanggal" required autocomplete="off">
								<span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
							</div>

							@if ($errors->has('pergi_tgl'))
								<span for="pergi_tgl" class="help-block">{{ $errors->first('pergi_tgl') }}</span>
							@endif
						</div>
						<div class='form-group'>
							<label class='control-label'>Keterangan</label>
							<textarea class='form-control limited' id='keterangan' cols='10' rows='4' name='keterangan' style='height:75px; resize:none;' maxlength='160'>@if(count($errors) > 0){{old('keterangan')}}@endif</textarea>
						</div>				
					</div>
				</div>
			</div>
			<div class="modal-footer">				
				<input name="simpan" value="Simpan" type="submit" class="btn btn-green">
			</div>
		</form>
	</div>

@endsection
