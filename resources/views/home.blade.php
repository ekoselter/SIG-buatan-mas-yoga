@extends('layouts.main')
@section('container')
  <div id="myCarousel" class="carousel slide mt-5" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="cover/gis-image.jpg" class="d-block w-100" alt="...">
        <div class="container">
          <div class="carousel-caption text-start">
            <h1>Geographic Information System</h1>
            <p>Sistem informasi pemetaan berbasis komputer yang digunakan untuk mengolah, menganalisis dan menghasilkan data bereferensi geografis di Kabupaten Kulon Progo</p>
            <p><a class="btn btn-lg btn-primary" href="/peta">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="cover/pesona-alam.jpg" class="d-block w-100" alt="...">
        <div class="container">
          <div class="carousel-caption">
            <h1>Pesona Alam Kulon Progo</h1>
            <p>Berbagai panorama alam yang dapat dinikmati masyarakat umum di wilayah Kabupaten Kulon Progo</p>
            <p><a class="btn btn-lg btn-primary" href="https://dinpar.kulonprogokab.go.id">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="cover/diskominfo.jpg" class="d-block w-100" alt="...">
        <div class="container">
          <div class="carousel-caption text-end">
            <h1>Diskominfo Kulon Progo</h1>
            <p>Organisasi perangkat daerah hasil penataan kelembagaan yang dilaksanakan pada tahun 2016 yang sebelumnya berasal dari Dinas Perhubungan Komunikasi dan Informatika.</p>
            <p><a class="btn btn-lg btn-primary" href="https://kominfo.kulonprogokab.go.id">Learn more</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


  <div class="container marketing">
    <div class="row">
      <div class="col-lg-4">
        <img src="logo/dinpar.jpg" class="d-block w-100 mx-auto rounded-circle mb-4" style="max-width: 200px" alt="...">
        <h2 class="fw-normal">Dinas Pariwisata</h2>
        <p>Dinas Pariwisata Kabupaten Kulon Progo dibentuk berdasarkan Peraturan Daerah Kabupaten Kulon Progo Nomor 14 Tahun 2016 tentang ...</p>
        <p><a class="btn btn-secondary" href="https://dinpar.kulonprogokab.go.id">View details &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <img src="logo/dinper.png" class="d-block w-100 mx-auto rounded-circle mb-4" style="max-width: 200px" alt="...">
        <h2 class="fw-normal">Dinas Perpustakaan</h2>
        <p>Perpustakaan menjadi salah satu Sub Bagian di Bagian Organisasi, meskipun embrio perpustakaannya sudah berdiri di luar Bagian Organisasi ...</p>
        <p><a class="btn btn-secondary" href="https://perpustakaan.kulonprogokab.go.id">View details &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <img src="logo/dinkeb.jpg" class="d-block w-100 mx-auto rounded-circle mb-4" style="max-width: 200px" alt="...">
        <h2 class="fw-normal">Dinas Kebudayaan</h2>
        <p>Dinas Kebudayaan (<i>Kundha Kabudayan</i>) Kabupaten Kulon Progo merupakan organisasi perangkat daerah hasil penataan kelembagaan pada tahun 2019 ...</p>
        <p><a class="btn btn-secondary" href="https://disbud.kulonprogokab.go.id">View details &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->


    <hr class="featurette-divider">


    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading fw-normal lh-1">Lokasi Desa Wisata</h2>
        <p class="lead">Sistem Informasi Geografis Kabupaten Kulon Progo menyediakan informasi lokasi dari berbagai desa wisata yang ada di Kabupaten Kulon Progo. Terdapat lebih dari 20 desa wisata dengan budaya yang beragam. Dari setiap desa wisata, disediakan informasi mengenai sejarah, reservasi, dan titik lokasi dari desa wisata.</p>
      </div>
      <div class="col-md-5">
        <img src="cover/desa-wisata.jpg" class="d-block w-100 mx-auto rounded" style="max-width: 500px" alt="...">
      </div>
    </div>


    <hr class="featurette-divider">


    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading fw-normal lh-1">Lokasi Instansi Pendidikan</h2>
        <p class="lead">Sistem Informasi Geografis Kabupaten Kulon Progo menyediakan informasi lokasi dari berbagai instansi tingkat pendidikan seperti Sekolah Dasar, Sekolah Menengah Pertama, Sekolah Menengah Atas, Sekolah Menengah Kejuruan, dan Perguruan Tinggi yang ada di Kabupaten Kulon Progo .Dari setiap tingkat pendidikan, disediakan informasi mengenai kurikulum, jam belajar, kepala sekolah, dan akreditasi. </p>
      </div>
      <div class="col-md-5 order-md-1">
        <img src="cover/pendidikan.jpg" class="d-block w-100 mx-auto rounded" style="max-width: 500px" alt="...">
      </div>
    </div>


    <hr class="featurette-divider">


    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading fw-normal lh-1">Lokasi Instansi Pemerintahan</h2>
        <p class="lead">Sistem Informasi Geografis Kabupaten Kulon Progo menyediakan informasi lokasi dari berbagai instansi pemerintahan di Kulon Progo seperti Desa, Kecamatan, Dinas, Sekretariat, dan DPRD.</p>
      </div>
      <div class="col-md-5">
        <img src="cover/pemerintahan.jpg" class="d-block w-100 mx-auto rounded" style="max-width: 500px" alt="...">
      </div>
    </div>


  </div><!-- /.container -->


  <!-- FOOTER -->
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                <img src="logo/logo-sig.png" alt="map" width="30" height="30">
            </a>
            <span class="mb-3 mb-md-0 text-muted">&copy; 2023 Dinas Kominfo Kulon Progo</span>
        </div>
    
        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-muted" href="https://www.instagram.com/dinaskominfokp"><i class="bi bi-instagram"></i></a></li>
            <li class="ms-3"><a class="text-muted" href="https://www.facebook.com/Kominfo.KP"><i class="bi bi-facebook"></i></a></li>
            <li class="ms-3"><a class="text-muted" href="https://twitter.com/dinaskominfokp"><i class="bi bi-twitter"></i></a></li>
        </ul>
    </footer>
@endsection