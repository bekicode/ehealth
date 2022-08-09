@extends('layouts.admin')

@section('title')
    Tambah Data Lansia
@endsection


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tambah Data Lansia</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.list_lansia') }}">Lansia</a></li>
          <li class="breadcrumb-item active">Tambah Data Lansia</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lansia</h3>
        </div>
      
        <form action="{{ route('admin.tambah_lansia_act') }}" enctype="multipart/form-data" method="POST">
          <div class="card-body">
            @csrf
            <div class="form-group">
              <label for="nama">Nama Lansia</label>
              <input
                type="text"
                name="nama"
                class="form-control @error('nama') is-invalid @enderror"
                id="nama"
                placeholder="Nama Lansia ..."
                value="{{ old('nama') }}"
                required
              />
              @error('nama') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="nik">NIK</label>
              <input
                name="nik"
                class="form-control @error('nik') is-invalid @enderror"
                id="nik"
                placeholder="NIK Lansia ..."
                value="{{ old('nik') }}"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number"
                maxlength = "16"
                min="0"
                required
              />
              @error('nik') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="no_kk">No Kartu Keluarga</label>
              <input
                name="no_kk"
                class="form-control @error('no_kk') is-invalid @enderror"
                id="no_kk"
                placeholder="No Kartu Keluarga ..."
                value="{{ old('no_kk') }}"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number"
                maxlength = "16"
                min="0"
                required
              />
              @error('no_kk') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="tanggal_lahir">Tanggal lahir</label>
              <input
                type="date"
                name="tanggal_lahir"
                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                id="tanggal_lahir"
                style="width: 150px"
                value="@if (Session::get('tanggal_lahir')){{ old('tanggal_lahir') }}@else{{ "1980-01-01" }}@endif"
                required
              />
              @error('tanggal_lahir') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="exampleSelectRounded0">Jenis Kelamin</label>
              <select 
                name="jenis_kelamin" 
                id="exampleSelectRounded0" 
                class="custom-select rounded-0 @error('jenis_kelamin') is-invalid @enderror" 
                required>
                <option value="Laki-laki" @if (old('jenis_kelamin') == "Laki-laki" ) selected @endif>Laki-laki</option>
                <option value="Perempuan" @if (old('jenis_kelamin') == "Perempuan" ) selected @endif>Perempuan</option>
              </select>
              @error('jenis_kelamin') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="exampleSelectRounded0">Posyandu</label>
              <select 
                name="posyandu" 
                id="exampleSelectRounded0" 
                class="custom-select rounded-0 @error('posyandu') is-invalid @enderror" 
                required>
                @foreach ($posyandu as $p)
                  <option value="{{ $p->id_posyandu }}" @if (Session::get('posyandu') == $p->id_posyandu ) selected @endif>{{ $p->nama }}</option>  
                @endforeach
              </select>
              @error('posyandu') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
</section>
@endsection
