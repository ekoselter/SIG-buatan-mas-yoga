@extends('dashboard.layouts.main')

@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Data Lokasi</h1>
    </div>
        <form action="/dashboard/maps/{{ $map->id }}" method="POST" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-lg-6">
            {{-- method form dibawah akan langsung diarahkan ke method store di controller || enctype digunakan agar dapat upload 2 data yaiitu teks dan gambar --}}
                <div class="mb-3">
                    <label for="map_title" class="form-label">Nama Lokasi</label>
                    <input type="text" class="form-control @error('map_title') is-invalid @enderror" id="map_title" name="map_title" autofocus value="{{ old('map_title', $map->map_title) }}">
                    {{-- Pesan Error --}}
                    @error('map_title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="child_id" class="form-label">Sub-Kategori</label>
                    <select class="form-select" name="child_id">
                        @foreach ($child_cats as $child_cat)
                            @if(old('child_id', $map->child_id) == $child_cat->id)
                                <option selected value="{{ $child_cat->id }}">{{ $child_cat->catchild_name }}</option>
                            @else
                                <option value="{{ $child_cat->id }}">{{ $child_cat->catchild_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="map_address" class="form-label">Alamat Lokasi</label>
                    <input type="text" class="form-control @error('map_address') is-invalid @enderror" id="map_address" name="map_address" autofocus value="{{ old('map_address', $map->map_address) }}">
                    {{-- Pesan Error --}}
                    @error('map_address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                {{-- <div class="mb-3">
                    <label for="map_latitude" class="form-label">Latitude</label>
                    <input type="text" class="form-control @error('map_latitude') is-invalid @enderror" id="map_latitude" name="map_latitude" autofocus value="{{ old('map_latitude', $map->map_latitude) }}">

                    @error('map_latitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="map_longitude" class="form-label">Longitude</label>
                    <input type="text" class="form-control @error('map_longitude') is-invalid @enderror" id="map_longitude" name="map_longitude" autofocus value="{{ old('map_longitude', $map->map_longitude) }}">

                    @error('map_longitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>  --}}
                <div id="map-canvas" class="mb-3"></div>
                <div class="mb-3">
                    <label for="map_latitude" class="form-label">Latitude</label>
                    <input type="text" class="form-control @error('map_latitude') is-invalid @enderror"  name="map_latitude" id="map_latitude" autofocus value="{{ old('map_longitude', $map->map_latitude) }}">
                    @error('map_latitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="map_longitude" class="form-label">Longitude</label>
                    <input type="text" class="form-control @error('map_longitude') is-invalid @enderror"  name="map_longitude" id="map_longitude" autofocus value="{{ old('map_longitude', $map->map_longitude) }}">
                    @error('map_longitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <input type="hidden" name="oldImage" value="{{ $map->map_img }}">
                    @if ($map->map_img)
                        <img src="{{ asset('storage/' . $map->map_img) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block"> 
                    @else
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                    @endif
                    <input class="form-control @error('map_img') is-invalid @enderror" type="file" id="map_img" name="map_img" onchange="previewImage()">
                    {{-- Pesan Error --}}
                    @error('map_img')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="map_desc" class="form-label">Deskripsi Tempat</label>
                    <input id="map_desc" type="hidden" name="map_desc" value="{{ old('map_desc', $map->map_desc) }}">
                    <trix-editor input="map_desc"></trix-editor>
                </div>
                <div class="mb-3">
                    <label for="map_url" class="form-label">Website URL</label>
                    <input type="text" class="form-control" id="map_url" name="map_url" autofocus value="{{ old('map_url', $map->map_url) }}">
                </div>
    
                <div class="mb-3">
                    <label for="map_postcode" class="form-label">Kode Pos</label>
                    <input type="text" class="form-control" id="map_postcode" name="map_postcode" autofocus value="{{ old('map_postcode', $map->map_postcode) }}">
                </div>
                <div class="mb-3">
                    <label for="map_telp" class="form-label">Nomor Telpon</label>
                    <input type="text" class="form-control" id="map_telp" name="map_telp" autofocus value="{{ old('map_telp', $map->map_telp) }}">
                </div>
                <div class="mb-3">
                    <label for="map_email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="map_email" name="map_email" autofocus value="{{ old('map_email', $map->map_email) }}">
                </div>
                <div class="mb-3">
                    <label for="map_pimpinan" class="form-label">Nama Pimpinan</label>
                    <input type="text" class="form-control" id="map_pimpinan" name="map_pimpinan" autofocus value="{{ old('map_pimpinan', $map->map_pimpinan) }}">
                </div>
            </div>
            <div class="col-lg-6">
                {{-- tambahan untuk kolom ke2 --}}
                <div class="mb-3">
                    <label for="map_jambuka" class="form-label">Jam Buka</label>
                    <input type="text" class="form-control" id="map_jambuka" name="map_jambuka" autofocus value="{{ old('map_jambuka', $map->map_jambuka) }}">
                </div>
                <div class="mb-3">
                    <label for="pend_akredit" class="form-label">Akreditasi (Pendidikan)</label>
                    <select class="form-select" name="pend_akredit">
                        @if(old('pend_akredit',$map->pend_akredit) === 'A')  
                            <option value = ''>Pilih Nilai Akreditasi</option>
                            <option selected value = 'A'>Akreditasi A</option>
                            <option value = 'B'>Akreditasi B</option>
                        @elseif(old('pend_akredit',$map->pend_akredit) === 'B')
                            <option value = ''>Pilih Nilai Akreditasi</option>
                            <option value = 'A'>Akreditasi A</option>
                            <option selected value = 'B'>Akreditasi B</option>
                        @else
                            <option selected value = ''>Pilih Nilai Akreditasi</option>
                            <option value = 'A'>Akreditasi A</option>
                            <option value = 'B'>Akreditasi B</option>
                        @endif
                    </select>
                </div>
                <div class="mb-3">
                    <label for="pend_kurikulum" class="form-label">Kurikulum (Pendidikan)</label>
                    <select class="form-select" name="pend_kurikulum">
                        @if(old('pend_kurikulum',$map->pend_kurikulum) == 'Kurikulum 2013')  
                            <option value = ''>Pilih Kurikulum</option>
                            <option selected value = 'Kurikulum 2013'>Kurikulum 2013</option>
                            <option value = 'KTSP'>KTSP</option>
                        @elseif(old('pend_kurikulum',$map->pend_kurikulum) == 'KTSP')
                            <option value = ''>Pilih Kurikulum</option>
                            <option value = 'Kurikulum 2013'>Kurikulum 2013</option>
                            <option selected value = 'KTSP'>KTSP</option>
                        @else
                            <option selected value = ''>Pilih Kurikulum</option>
                            <option value = 'Kurikulum 2013'>Kurikulum 2013</option>
                            <option value = 'KTSP'>KTSP</option>
                        @endif
                    </select>
                </div>
                <div class="mb-3">
                    <label for="pend_waktu" class="form-label">Waktu Belajar (Pendidikan)</label>
                    <select class="form-select" name="pend_waktu">
                        @if(old('pend_waktu',$map->pend_waktu) == '5 Hari Setiap Minggu')  
                            <option value = ''>Pilih Waktu Belajar</option>
                            <option selected value = '5 Hari Setiap Minggu'>5 Hari Setiap Minggu</option>
                            <option value = '6 Hari Setiap Minggu'>6 Hari Setiap Minggu</option>
                            <option value = 'Pagi'>Pagi</option>
                        @elseif(old('pend_waktu',$map->pend_waktu) == '6 Hari Setiap Minggu')
                            <option value = ''>Pilih Waktu Belajar</option>
                            <option value = '5 Hari Setiap Minggu'>5 Hari Setiap Minggu</option>
                            <option selected value = '6 Hari Setiap Minggu'>6 Hari Setiap Minggu</option>
                            <option value = 'Pagi'>Pagi</option>
                        @elseif(old('pend_waktu',$map->pend_waktu) == 'Pagi')
                            <option value = ''>Pilih Waktu Belajar</option>
                            <option value = '5 Hari Setiap Minggu'>5 Hari Setiap Minggu</option>
                            <option value = '6 Hari Setiap Minggu'>6 Hari Setiap Minggu</option>
                            <option selected value = 'Pagi'>Pagi</option>
                        @else
                            <option selected value = ''>Pilih Waktu Belajar</option>
                            <option value = '5 Hari Setiap Minggu'>5 Hari Setiap Minggu</option>
                            <option value = '6 Hari Setiap Minggu'>6 Hari Setiap Minggu</option>
                            <option value = 'Pagi'>Pagi</option>
                        @endif
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kes_rawatinap" class="form-label">Fasilitas Rawat Inap (Kesehatan)</label>
                    <select class="form-select" name="kes_rawatinap">
                        @if(old('kes_rawatinap',$map->kes_rawatinap) == 0)  
                            <option value = ''>Pilih Opsi</option>
                            <option selected value = 0>Tidak Tersedia</option>
                            <option value = 1>Tersedia</option>
                        @elseif(old('kes_rawatinap',$map->kes_rawatinap) == 1)
                            <option value = ''>Pilih Opsi</option>
                            <option value = 0>Tidak Tersedia</option>
                            <option selected value = 1>Tersedia</option>
                        @else
                            <option selected value = ''>Pilih Opsi</option>
                            <option value = 0>Tidak Tersedia</option>
                            <option value = 1>Tersedia</option>
                        @endif
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kes_igd" class="form-label">Layanan IGD (Kesehatan)</label>
                    <input type="text" class="form-control" id="kes_igd" name="kes_igd" autofocus value="{{ old('kes_igd', $map->kes_igd) }}">
                </div>
                <div class="mb-3">
                    <label for="kes_harilayanan" class="form-label">Jadwal Layanan (Kesehatan)</label>
                    <input type="text" class="form-control" id="kes_harilayanan" name="kes_harilayanan" autofocus value="{{ old('kes_harilayanan', $map->kes_harilayanan) }}">
                </div>
                <div class="mb-3">
                    <label for="kes_pasien" class="form-label">Jumlah Pasien (Kesehatan)</label>
                    <input type="text" class="form-control" id="kes_pasien" name="kes_pasien" autofocus value="{{ old('kes_pasien', $map->kes_pasien) }}">
                </div>
                <div class="mb-3">
                    <label for="perd_luas" class="form-label">Luas Tanah (Perdagangan)</label>
                    <input type="text" class="form-control" id="perd_luas" name="perd_luas" autofocus value="{{ old('perd_luas', $map->perd_luas) }}">
                </div>
                <div class="mb-3">
                    <label for="perd_statustanah" class="form-label">Status Tanah (Perdagangan)</label>
                    <input type="text" class="form-control" id="perd_statustanah" name="perd_statustanah" autofocus value="{{ old('perd_statustanah', $map->perd_statustanah) }}">
                </div>
                <div class="mb-3">
                    <label for="perd_haripasaran" class="form-label">Hari Pasaran (Perdagangan)</label>
                    <input type="text" class="form-control" id="perd_haripasaran" name="perd_haripasaran" autofocus value="{{ old('perd_haripasaran', $map->perd_haripasaran) }}">
                </div>
                <div class="mb-3">
                    <label for="perd_komoditas" class="form-label">Komoditas Perdagangan (Perdagangan)</label>
                    <input type="text" class="form-control" id="perd_komoditas" name="perd_komoditas" autofocus value="{{ old('perd_komoditas', $map->perd_komoditas) }}">
                </div>
                <div class="mb-3">
                    <label for="perd_jmlkios" class="form-label">Jumlah Kios (Perdagangan)</label>
                    <input type="text" class="form-control" id="perd_jmlkios" name="perd_jmlkios" autofocus value="{{ old('perd_jmlkios', $map->perd_jmlkios) }}">
                </div>
                <div class="mb-3">
                    <label for="perd_jmlpedagang" class="form-label">Jumlah Pedagang (Perdagangan)</label>
                    <input type="text" class="form-control" id="perd_jmlpedagang" name="perd_jmlpedagang" autofocus value="{{ old('perd_jmlpedagang', $map->perd_jmlpedagang) }}">
                </div>
                <div class="mb-3">
                    <label for="sosmed_fb" class="form-label">Akun Facebook</label>
                    <input type="text" class="form-control" id="sosmed_fb" name="sosmed_fb" autofocus value="{{ old('sosmed_fb', $map->sosmed_fb) }}">
                </div>
                <div class="mb-3">
                    <label for="sosmed_ig" class="form-label">Akun Instagram</label>
                    <input type="text" class="form-control" id="sosmed_ig" name="sosmed_ig" autofocus value="{{ old('sosmed_ig', $map->sosmed_ig) }}">
                </div>
                <div class="mb-3">
                    <label for="sosmed_twit" class="form-label">Akun Twitter</label>
                    <input type="text" class="form-control" id="sosmed_twit" name="sosmed_twit" autofocus value="{{ old('sosmed_twit', $map->sosmed_twit) }}">
                </div>
            </div>
            <div class="d-grid gap-2 col-4 mx-auto">
                <button type="submit" class="btn btn-primary">Update Data Lokasi</button>
            </div>
            
        </form>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVQ2aIg5D6B1yyObMTowtn2rYcz6ld0TE&callback=initMap" async></script>
    <script>
        const mapData = <?= json_encode($map); ?>;
        function previewImage(){
            const image = document.querySelector('#map_img');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        var _long, _lat;
        function initMap() {
                map = new google.maps.Map(document.getElementById("map-canvas"), {
                    center: {
                        lat: mapData.map_latitude,
                        lng: mapData.map_longitude,
                    },
                    zoom: 13
                });

                map.addListener("click", function(event) {
                    mapClicked(event);
                });

                let lat_marker = mapData.map_latitude;
                let long_marker = mapData.map_longitude;

                var markerLokasi = new google.maps.LatLng(lat_marker, long_marker);

                var marker = new google.maps.Marker({
                    position: markerLokasi,
                    map: map,
                    draggable: true
                });

                google.maps.event.addListener(marker, 'dragend', function(evt) {
                    _long = evt.latLng.lng().toFixed(6);
                    _lat = evt.latLng.lat().toFixed(6);

                    $("#map_latitude").val(_lat);
                    $("#map_longitude").val(_long);
                });
            }

        //trix editor
        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })
    </script>
@endsection

