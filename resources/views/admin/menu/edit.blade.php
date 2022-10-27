@extends('layouts.admin')

@section('js')
    <script src="{{ asset('assets/admin/js/jquery.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/select2.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

    <script>
        $(".theSelect").select2();
    </script>
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Menu</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="/admin/dashboard">
                        <i class="fa-solid fa-house-chimney"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="/admin/menu">Menu</a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="">Edit Menu</a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Data Menu</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Nama Menu</label>
                        <div class="input-group ">
                            <input type="text" value="{{ $menu->nama }}" placeholder="Masukkan Nama menu"
                                name="nama" autocomplete='off' class="form-control @error('nama') is-invalid @enderror"
                                required>
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Isi Konten</label>
                        <div class="input-group ">

                            <select name="id_konten" required class="form-control theSelect"
                                @error('id_konten') is-invalid @enderror>
                                <option value="">-- Pilih Isi Konten --</option>
                                <option value="#" {{ $menu->id_konten == null ? 'selected' : '' }}>Sub Menu</option>
                                </option>
                                @foreach ($konten as $item)
                                    @if ($item->id_halaman != null)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $menu->id_konten ? 'selected' : '' }}>
                                            {{ $item->halaman->judul }} | {{ $item->type }}
                                        </option>
                                    @elseif ($item->id_artikel != null)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $menu->id_konten ? 'selected' : '' }}>
                                            {{ $item->artikel->judul }} | {{ $item->type }}
                                        </option>
                                    @elseif ($item->id_kegiatan != null)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $menu->id_konten ? 'selected' : '' }}>
                                            {{ $item->kegiatan->judul }} | {{ $item->type }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('id_konten')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-warning text-white"><i class="fa fa-save mr-1"></i>
                            Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
