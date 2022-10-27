@extends('layouts.member')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />

    <style>
        #mapid {
            min-height: 500px;
        }

        table tr th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
@endsection
@section('js')
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>

    <script>
        var map = L.map('mapid').setView([{{ config('leaflet.map_center_latitude') }},
            {{ config('leaflet.map_center_longitude') }}
        ], {{ config('leaflet.zoom_level') }});

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        var markers = L.markerClusterGroup();

        axios.get('{{ route('api.peta.index') }}')
            .then(function(response) {
                var marker = L.geoJSON(response.data, {
                    pointToLayer: function(geoJsonPoint, latlng) {
                        return L.marker(latlng).bindPopup(function(layer) {
                            return layer.feature.properties.map_popup_content;
                        });
                    }
                });
                markers.addLayer(marker);
            })
            .catch(function(error) {
                console.log(error);
            });
        map.addLayer(markers);

        var theMarker;
    </script>
@endsection

@section('content')
    <br><br><br>
    <div class="container mt-5">
        @if ($menu->konten->halaman != '')
            @if ($menu->konten->halaman->judul)
                <header class="section-header">
                    <p class="mt-4 text-uppercase">{{ $menu->konten->halaman->judul }}</p>
                </header>
            @endif
            {{-- Atas --}}
            <div class="row">
                @if ($menu->konten->halaman->atas_kiri == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($menu->konten->halaman->atas_kiri == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($menu->konten->halaman->atas_kiri == 'Peta')
                    <div class="col">
                        <div class="card">
                            <div class="card-body" id="mapid"></div>
                        </div>
                    </div>
                @elseif ($menu->konten->halaman->atas_kiri == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @endif
                @if ($menu->konten->halaman->atas_tengah == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($menu->konten->halaman->atas_tengah == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($menu->konten->halaman->atas_tengah == 'Peta')
                    <div class="col">
                        <div class="card">
                            <div class="card-body" id="mapid"></div>
                        </div>
                    </div>
                @elseif ($menu->konten->halaman->atas_tengah == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @endif
                @if ($menu->konten->halaman->atas_kanan == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($menu->konten->halaman->atas_kanan == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($menu->konten->halaman->atas_kanan == 'Peta')
                    <div class="col">
                        <div class="card">
                            <div class="card-body" id="mapid"></div>
                        </div>
                    </div>

                    <div class="col">
                        <x-anggaran></x-anggaran>
                    </div>
                @elseif ($menu->konten->halaman->atas_kanan == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @endif
            </div>
            {{-- Akhir Atas --}}
            @if ($menu->konten->halaman->gambar != null)
                <img class="rounded" src="{{ $menu->konten->halaman ? $menu->konten->halaman->gambar() : 'no_image' }}"
                    alt="Gambar"
                    style="width: 100%; height: 500px; object-fit: cover; border-top: 5px solid blue; border-bottom: 5px solid red;">
            @endif

            @if ($menu->konten->halaman->teks)
                <div class="card border-0">
                    {!! $menu->konten->halaman->teks !!}
                </div>
            @endif
            {{-- Tengah --}}
            <div class="row">
                @if ($menu->konten->halaman->tengah_kiri == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($menu->konten->halaman->tengah_kiri == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($menu->konten->halaman->tengah_kiri == 'Peta')
                    <div class="col">
                        <div class="card">
                            <div class="card-body" id="mapid"></div>
                        </div>
                    </div>

                    <div class="col">
                        <x-anggaran></x-anggaran>
                    </div>
                @elseif ($menu->konten->halaman->tengah_kiri == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @endif
                @if ($menu->konten->halaman->tengah == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($menu->konten->halaman->tengah == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($menu->konten->halaman->tengah == 'Peta')
                    <div class="col">
                        <div class="card">
                            <div class="card-body" id="mapid"></div>
                        </div>
                    </div>

                    <div class="col">
                        <x-anggaran></x-anggaran>
                    </div>
                @elseif ($menu->konten->halaman->tengah == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @endif
                @if ($menu->konten->halaman->tengah_kanan == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($menu->konten->halaman->tengah_kanan == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($menu->konten->halaman->tengah_kanan == 'Peta')
                    <div class="col">
                        <div class="card">
                            <div class="card-body" id="mapid"></div>
                        </div>
                    </div>

                    <div class="col">
                        <x-anggaran></x-anggaran>
                    </div>
                @elseif ($menu->konten->halaman->tengah_kanan == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @endif
            </div>
            {{-- Akhir Tengah --}}
            {{-- Bawah --}}
            <div class="row">
                @if ($menu->konten->halaman->bawah_kiri == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($menu->konten->halaman->bawah_kiri == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($menu->konten->halaman->bawah_kiri == 'Peta')
                    <div class="col">
                        <div class="card">
                            <div class="card-body" id="mapid"></div>
                        </div>
                    </div>

                    <div class="col">
                        <x-anggaran></x-anggaran>
                    </div>
                @elseif ($menu->konten->halaman->bawah_kiri == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @endif
                @if ($menu->konten->halaman->bawah_tengah == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($menu->konten->halaman->bawah_tengah == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($menu->konten->halaman->bawah_tengah == 'Peta')
                    <div class="col">
                        <div class="card">
                            <div class="card-body" id="mapid"></div>
                        </div>
                    </div>

                    <div class="col">
                        <x-anggaran></x-anggaran>
                    </div>
                @elseif ($menu->konten->halaman->bawah_tengah == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @endif
                @if ($menu->konten->halaman->bawah_kanan == 'Slide')
                    <!-- Carousel Start -->
                    <div class="col">
                        <x-slide></x-slide>
                    </div>
                    <!-- Carousel End -->
                @elseif ($menu->konten->halaman->bawah_kanan == 'Galeri')
                    <!-- Galeri Start -->
                    <div class="col">
                        <x-galeri></x-galeri>
                    </div>
                    <!-- Galeri End -->
                @elseif ($menu->konten->halaman->bawah_kanan == 'Peta')
                    <div class="col">
                        <div class="card">
                            <div class="card-body" id="mapid"></div>
                        </div>
                    </div>
                
                    <div class="col">
                        <x-anggaran></x-anggaran>
                    </div>
                @elseif ($menu->konten->halaman->bawah_kanan == 'Kontak')
                    <div class="col">
                        <x-kontak></x-kontak>
                    </div>
                @endif
            </div>
            {{-- Akhir Bawah --}}
        @elseif ($menu->konten->artikel != '')
            @if ($menu->konten->artikel->gambar != null)
                <img class="rounded" src="{{ $menu->konten->artikel ? $menu->konten->artikel->gambar() : 'no_image' }}"
                    alt="Gambar"
                    style="width: 100%; height: 500px; object-fit: cover; border-top: 5px solid blue; border-bottom: 5px solid red;">
            @endif
            <h1 class="mt-4 text-uppercase">{{ $menu->konten->artikel->judul }}</h1>
            <div class="card border-0">
                {!! $menu->konten->artikel->teks !!}
            </div>
        @elseif ($menu->konten->kegiatan != '')
            @if ($menu->konten->kegiatan->gambar != null)
                <img class="rounded" src="{{ $menu->konten->kegiatan ? $menu->konten->kegiatan->gambar() : 'no_image' }}"
                    alt="Gambar"
                    style="width: 100%; height: 500px; object-fit: cover; border-top: 5px solid blue; border-bottom: 5px solid red;">
            @endif
            <h1 class="mt-4 text-uppercase">{{ $menu->konten->kegiatan->judul }}</h1>
            <div class="card border-0">
                {!! $menu->konten->kegiatan->teks !!}
            </div>
        @else
            <br><br><br>
            <center>Tidak Ada Konten</center>
            <br><br>
            <br>
        @endif
    </div>
@endsection
