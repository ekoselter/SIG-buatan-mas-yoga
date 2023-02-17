<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIG Kulon Progo | Peta</title>
    <link rel="icon" href="{!! asset('logo/logo-sig.png') !!}"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <link href="/css/sidebar.css" rel="stylesheet">
    <link  href="/css/map.css" rel="stylesheet">
    <style>
      trix-toolbar [data-trix-button-group='file-tools']{
        display:none;
      }
    </style>
  </head>
  <body>
    
  @include('maps.header')

    <div class="container-fluid">
      <div class="row">

        @include('maps.sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10">
          <div id="map"></div>
        </main>

      </div>
    </div>
    <script>
      // menampilkan data yang dikirimkan dari controller dan diubah agar dapat diolah dalam javascript
      const initialMarkers = <?= json_encode($maps); ?>;
      const childcat = <?=json_encode($category_children); ?>;

      let map, activeInfoWindow, markers = [];

      //inisialisasi map
      function initMap() {
          map = new google.maps.Map(document.getElementById("map"), {
              center: {
                  lat: -7.863023,
                  lng: 110.150089,
              },
              zoom: 13
          });

          map.addListener("click", function(event) {
              mapClicked(event);
          });
      }

      //saat memilih map berdasar kategori dan subkategori maka akan menampilkan data lokasi yg sesuai
      function selectMap(id_child) {
        removeMarkers();
        var btns = document.getElementsByClassName("btn");
        for (var i = 0; i < btns.length; i++){
            btns[i].classList.remove("active") 
        }
        var select = document.getElementById(id_child);
        select.classList.add("active");
        initMarkers(id_child);
      }

      //menghapus semua marker yg tertampil
      function removeMarkers(){
        for(i=0; i<markers.length; i++){
          markers[i].setMap(null);
        }
      }
      
      var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
      var flagsUrl = '{{ asset('/storage') }}';

      //menampilkan marker satu persatu berdasar kategori dan sub kategori
      function initMarkers(id_child){
          for (let index = 0; index < initialMarkers.length; index++) {
              //membuat satu data objek yaitu marker data untuk dapat dimasukkan dengan data yang sudah diencode sebelumnya
              const markerData = initialMarkers[index];
              var urlimage = childcat[id_child-1].icon_mark;
              if(markerData.child_id == id_child){
                var image = {
                  url: flagsUrl + '/' + urlimage, 
                  scaledSize : new google.maps.Size(40, 40), // mengatur size image dalam pop up window
                };
                
                //membuat marker data
                console.log(urlimage);
                  const marker = new google.maps.Marker({
                      position: {
                        lat : markerData.map_latitude,
                        lng : markerData.map_longitude
                      },
                      draggable: false,
                      title: markerData.map_title,
                      icon: image,
                      map
                  });

                  markers.push(marker);

                  //membuat konten dalam pop-up window dari marker yang dipilih
                  if(markerData.parent_id == 1){
                    var contentStr = 
                      `<div class="text-center">`
                        +
                          `${markerData.map_img ? `<img src="{{ asset('storage/') }}/${markerData.map_img}" class="rounded img-responsive" alt="gambar">` : ''}`
                        +
                      `</div>
                      <table class="table table-dark mt-2 table-bordered">
                        <tbody>
                          <tr><td scope="row" colspan="3" class="table-active"><p class="fs-5 fst-italic fw-bold text-center">${markerData.map_title}</p></td></tr>`
                          +
                          `${markerData.map_address ? `<tr><td><i class="bi bi-geo-alt"></i></td><th scope="row" class="col-3">Alamat</th><td> ${markerData.map_address} </td></tr>` : ''}`
                          +
                           `${markerData.map_pimpinan ? `<tr><td><i class="bi bi-person-lines-fill"></i></td><th scope="row">Kepala Sekolah</th><td> ${markerData.map_pimpinan} </td></tr>` : ''}`
                          +
                           `${markerData.pend_akredit ? `<tr><td><i class="bi bi-pencil-square"></i></td><th scope="row">Akreditasi</th><td> ${markerData.pend_akredit} </td></tr>` : ''}`
                          +
                           `${markerData.pend_kurikulum ? `<tr><td><i class="bi bi-journal-arrow-up"></i></td><th scope="row">Kurikulum</th><td> ${markerData.pend_kurikulum} </td></tr>` : ''}`
                          +
                           `${markerData.pend_waktu ? `<tr><td><i class="bi bi-alarm"></i></td><th scope="row">Waktu Belajar</th><td> ${markerData.pend_waktu} </td></tr>` : ''}`
                          +
                           `${markerData.map_url ? `<tr><td><i class="bi bi-browser-chrome"></i></td><th scope="row">Link Website</th><td> <a href="${markerData.map_url}">Keterangan lebih lanjut ...</a></td></tr>` : ''}`
                          +
                          `${markerData.map_postcode ? `<tr><td><i class="bi bi-file-post"></i></td><th scope="row" class="col-3">Kode Pos</th><td> ${markerData.map_postcode} </td></tr>` : ''}` 
                          +
                          `${markerData.map_telp ? `<tr><td><i class="bi bi-telephone-inbound"></i></td><th scope="row" class="col-3">No. Telpon</th><td> ${markerData.map_telp} </td></tr>` : ''}`
                          +
                          `${markerData.map_email ? `<tr><td><i class="bi bi-envelope-at"></i></td><th scope="row" class="col-3">Email</th><td> ${markerData.map_email} </td></tr>` : ''}`
                          +
                        `</tbody>
                      </table>`;
                  }else if(markerData.parent_id == 2){
                    var contentStr = 
                    `<div class="infowind">
                      <div class="text-center">`
                        +
                          `${markerData.map_img ? `<img src="{{ asset('storage/') }}/${markerData.map_img}" class="rounded img-responsive" alt="gambar">` : ''}`
                        +
                      `</div>    
                      <table class="table table-dark mt-2 table-bordered">
                        <tbody>`
                          +
                          `${markerData.map_title ? `<tr><td scope="row" colspan="3" class="table-active"><p class="fs-5 fst-italic fw-bold text-center">${markerData.map_title}</p></td></tr>` : ''}`
                          +
                          `${markerData.map_address ? `<tr><td><i class="bi bi-geo-alt"></i></td><th scope="row" class="col-3">Alamat</th><td> ${markerData.map_address} </td></tr>` : ''}`
                          +
                          `${markerData.map_pimpinan ? `<tr><td><i class="bi bi-person-lines-fill"></i></td><th scope="row" class="col-3">Pimpinan</th><td> ${markerData.map_pimpinan} </td></tr>` : ''}` 
                          +
                          `${markerData.map_postcode ? `<tr><td><i class="bi bi-file-post"></i></td><th scope="row" class="col-3">Kode Pos</th><td> ${markerData.map_postcode} </td></tr>` : ''}` 
                          +
                          `${markerData.kes_igd ? `<tr><td><i class="bi bi-file-post"></i></td><th scope="row" class="col-3">Layanan IGD</th><td> ${markerData.kes_igd} </td></tr>` : ''}` 
                          +
                          `${markerData.kes_harilayanan ? `<tr><td><i class="bi bi-file-post"></i></td><th scope="row" class="col-3">Jadwal Layanan</th><td> ${markerData.kes_harilayanan} </td></tr>` : ''}` 
                          +
                          `${markerData.map_telp ? `<tr><td><i class="bi bi-telephone-inbound"></i></td><th scope="row" class="col-3">No. Telpon</th><td> ${markerData.map_telp} </td></tr>` : ''}`
                          +
                          `${markerData.map_email ? `<tr><td><i class="bi bi-envelope-at"></i></td><th scope="row" class="col-3">Email</th><td> ${markerData.map_email} </td></tr>` : ''}`
                          +
                          `${markerData.map_jambuka ? `<tr><td><i class="bi bi-clock-history"></i></td><th scope="row" class="col-3">Jam Buka</th><td> ${markerData.map_jambuka } </td></tr>` : ''}`
                          +
                          `${markerData.map_url ? `<tr><td><i class="bi bi-browser-chrome"></i></td><th scope="row" class="col-3">Website</th><td> <a href="${markerData.map_url}">Keterangan lebih lanjut ...</a></td></tr>` : ''}`
                          +
                        `</tbody>
                      </table>
                    </div>`;
                  }else{
                    var contentStr = 
                    `<div class="infowind">
                      <div class="text-center">`
                        +
                          `${markerData.map_img ? `<img src="{{ asset('storage/') }}/${markerData.map_img}" class="rounded img-responsive" alt="gambar">` : ''}`
                        +
                      `</div>    
                      <table class="table table-dark mt-2 table-bordered">
                        <tbody>`
                          +
                          `${markerData.map_title ? `<tr><td scope="row" colspan="3" class="table-active"><p class="fs-5 fst-italic fw-bold text-center">${markerData.map_title}</p></td></tr>` : ''}`
                          +
                          `${markerData.map_address ? `<tr><td><i class="bi bi-geo-alt"></i></td><th scope="row" class="col-3">Alamat</th><td> ${markerData.map_address} </td></tr>` : ''}`
                          +
                          `${markerData.map_pimpinan ? `<tr><td><i class="bi bi-person-lines-fill"></i></td><th scope="row" class="col-3">Pimpinan</th><td> ${markerData.map_pimpinan} </td></tr>` : ''}` 
                          +
                          `${markerData.map_postcode ? `<tr><td><i class="bi bi-file-post"></i></td><th scope="row" class="col-3">Kode Pos</th><td> ${markerData.map_postcode} </td></tr>` : ''}` 
                          +
                          `${markerData.map_telp ? `<tr><td><i class="bi bi-telephone-inbound"></i></td><th scope="row" class="col-3">No. Telpon</th><td> ${markerData.map_telp} </td></tr>` : ''}`
                          +
                          `${markerData.map_email ? `<tr><td><i class="bi bi-envelope-at"></i></td><th scope="row" class="col-3">Email</th><td> ${markerData.map_email} </td></tr>` : ''}`
                          +
                          `${markerData.map_jambuka ? `<tr><td><i class="bi bi-clock-history"></i></td><th scope="row" class="col-3">Jam Buka</th><td> ${markerData.map_jambuka } </td></tr>` : ''}`
                          +
                          `${markerData.perd_luas ? `<tr><td><i class="bi bi-rulers"></i></td><th scope="row" class="col-3">Luas Tanah</th><td> ${markerData.perd_luas } </td></tr>` : ''}`
                          +
                          `${markerData.perd_statustanah ? `<tr><td><i class="bi bi-check-circle"></i></td><th scope="row" class="col-3">Status Tanah</th><td> ${markerData.perd_statustanah } </td></tr>` : ''}`
                          +
                          `${markerData.perd_haripasaran ? `<tr><td><i class="bi bi-calendar-date"></i></td><th scope="row" class="col-3">Hari Pasaran</th><td> ${markerData.perd_haripasaran } </td></tr>` : ''}`
                          +
                          `${markerData.perd_komoditas ? `<tr><td><i class="bi bi-bag-heart"></i></td><th scope="row" class="col-3">Komoditas</th><td> ${markerData.perd_komoditas } </td></tr>` : ''}`
                          +
                          `${markerData.perd_jmlpedagang ? `<tr><td><i class="bi bi-people"></i></td><th scope="row" class="col-4">Jumlah Pedagang</th><td> ${markerData.perd_jmlpedagang } Orang </td></tr>` : ''}`
                          +
                          `${markerData.perd_jmlkios ? `<tr><td><i class="bi bi-shop-window"></i></td><th scope="row" class="col-3">Jumlah Kios</th><td> ${markerData.perd_jmlkios } </td></tr>` : ''}`
                          +
                          `${markerData.sosmed_fb ? `<tr><td><i class="bi bi-facebook"></i></td><th scope="row" class="col-3">Facebook</th><td> ${markerData.sosmed_fb } </td></tr>` : ''}`
                          +
                          `${markerData.sosmed_ig ? `<tr><td><i class="bi bi-instagram"></i></td><th scope="row" class="col-3">Instagram</th><td> ${markerData.sosmed_ig } </td></tr>` : ''}`
                          +
                          `${markerData.sosmed_twit ? `<tr><td><i class="bi bi-twitter"></i></td><th scope="row" class="col-3">Twitter</th><td> ${markerData.sosmed_twit } </td></tr>` : ''}`
                          +
                          `${markerData.map_desc ? `<tr><td><i class="bi bi-journal-text"></i></td><th scope="row" class="col-3">Deskripsi</th><td>${markerData.map_desc }</td></tr>` : ''}`
                          +
                          `${markerData.map_url ? `<tr><td><i class="bi bi-browser-chrome"></i></td><th scope="row" class="col-3">Website</th><td> <a href="${markerData.map_url}">Keterangan lebih lanjut ...</a></td></tr>` : ''}`
                          +
                        `</tbody>
                      </table>
                    </div>`;
                  };

                  const gambar = `<div class="text-center">
                    <img src="https://dansmedia.net/wp-content/uploads/2018/11/Foto-Utama.jpg" class="rounded img-responsive" alt="gambar">
                  </div>`;                  

                  //membuat infowindow dengan konten yang sudah dibuat sebelumnya
                  const infowindow = new google.maps.InfoWindow({
                    content: contentStr,
                  });

                  marker.addListener("click", (event) => {
                      if(activeInfoWindow) {
                          activeInfoWindow.close();
                      }
                      infowindow.open({
                          anchor: marker,
                          shouldFocus: false,
                          map
                      });
                      activeInfoWindow = infowindow;
                      markerClicked(marker, index);
                  });
    
                  marker.addListener("dragend", (event) => {
                      markerDragEnd(event, index);
                  });
              }
          }

          /* ------------------------- Handle Map Click Event ------------------------- */
          function mapClicked(event) {
              console.log(map);
              console.log(event.latLng.lat(), event.latLng.lng());
          }

          /* ------------------------ Handle Marker Click Event ----------------------- */
          function markerClicked(marker, index) {
              console.log(map);
              console.log(marker.position.lat());
              console.log(marker.position.lng());
          }

          /* ----------------------- Handle Marker DragEnd Event ---------------------- */
          function markerDragEnd(event, index) {
              console.log(map);
              console.log(event.latLng.lat());
              console.log(event.latLng.lng());
          }
      }


    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVQ2aIg5D6B1yyObMTowtn2rYcz6ld0TE&callback=initMap" async></script>
    <script src="/js/dashboard.js"></script>
    <script src="/js/sidebar.js"></script>
</body>
</html>
