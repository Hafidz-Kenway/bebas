<?php include "header.php"; ?>

<!-- start banner Area -->
<section class="banner-area relative">
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row fullscreen align-items-center justify-content-between">
      <div class="col-lg-6 col-md-6 banner-left">
        <h6 class="text-white">SISTEM INFORMASI GEOGRAFIS LOKASI TOKO BUKU</h6>
        <h1 class="text-white">SEMARANG</h1>
        <p class="text-white">
          Sistem informasi ini merupakan aplikasi pemetaan geografis toko buku di wilayah Semarang. Aplikasi ini memuat informasi dan lokasi dari toko buku yang ada di Semarang.
        </p>
        <a href="#peta_wisata" class="primary-btn text-uppercase">Lihat Detail</a>
      </div>

    </div>
  </div>
  </div>
</section>
<!-- End banner Area -->


<main id="main">




  <!-- Start about-info Area -->
  <section class="price-area section-gap">

    <section id="peta_wisata" class="about-info-area section-gap">
      <div class="container">

        <div class="title text-center">
          <h1 class="mb-10">Peta Lokasi Toko Buku</h1>
          <br>
        </div>

        <div class="row align-items-center">

          <div id="map" style="width:100%;height:480px;"></div>
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARDXWdVXQW3ETDEZ6roxtlMH4CdkysRRI&callback=initMap "></script>

          <script type="text/javascript">
            function initialize() {

              var mapOptions = {
                zoom: 10.2,
                center: new google.maps.LatLng(-7.0245522, 110.3346642),
                disableDefaultUI: false
              };

              var mapElement = document.getElementById('map');

              var map = new google.maps.Map(mapElement, mapOptions);

              setMarkers(map, officeLocations);

            }

            var officeLocations = [
              <?php
              $data = file_get_contents('http://localhost/bebas/ambildata.php');
              $no = 1;
              if (json_decode($data, true)) {
                $obj = json_decode($data);
                foreach ($obj->results as $item) {
              ?>[<?php echo $item->id_wisata ?>, '<?php echo $item->nama_wisata ?>', '<?php echo $item->alamat ?>', <?php echo $item->longitude ?>, <?php echo $item->latitude ?>],
              <?php
                }
              }
              ?>
            ];

            function setMarkers(map, locations) {
              var globalPin = 'img/marker.png';

              for (var i = 0; i < locations.length; i++) {

                var office = locations[i];
                var myLatLng = new google.maps.LatLng(office[4], office[3]);
                var infowindow = new google.maps.InfoWindow({
                  content: contentString
                });

                var contentString =
                  '<div id="content">' +
                  '<div id="siteNotice">' +
                  '</div>' +
                  '<h5 id="firstHeading" class="firstHeading">' + office[1] + '</h5>' +
                  '<div id="bodyContent">' +
                  '<a href=detail.php?id_wisata=' + office[0] + '>Info Detail</a>' +
                  '</div>' +
                  '</div>';

                var marker = new google.maps.Marker({
                  position: myLatLng,
                  map: map,
                  title: office[1],
                  icon: 'img/markermap.png'
                });

                google.maps.event.addListener(marker, 'click', getInfoCallback(map, contentString));
              }
            }

            function getInfoCallback(map, content) {
              var infowindow = new google.maps.InfoWindow({
                content: content
              });
              return function() {
                infowindow.setContent(content);
                infowindow.open(map, this);
              };
            }

            initialize();
          </script>

        </div>


      </div>
    </section>
    <!-- End about-info Area -->


    <!-- Start price Area -->

    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-70 col-lg-8">
          <div class="title text-center">
            <h1 class="mb-10">Jangkauan Peta</h1>
            <p>Aplikasi pemetaan geografis toko buku di daerah Semarang ini memuat informasi dan lokasi dari semua tempat toko buku yang ada di Semarang. Pemetaan diambil dari data lokasi Google Maps dan data dari website masing-masing toko buku. Aplikasi ini memuat sejumlah informasi mengenai :
            </p>
          </div>
        </div>
      </div>

      <!-- End other-issue Area -->

    </div>
    </div> <!-- ======= Counts Section ======= -->
    <section id="counts">
      <div class="container">
        <div class="title text-center">
          <h1 class="mb-10">Jumlah Toko Buku</h1>
          <br>
        </div>
        <div class="row d-flex justify-content-center">


          <?php
          include_once "countsma.php";
          $obj = json_decode($data);
          $sman = "";
          foreach ($obj->results as $item) {
            $sman .= $item->sma;
          }
          ?>

          <div class="text-center">
            <h1><span data-toggle="counter-up"><?php echo $sman; ?></span></h1>
            <br>
          </div>
          <?php
          include_once "countsmk.php";
          $obj2 = json_decode($data);
          $smkn = "";
          foreach ($obj2->results as $item2) {
            $smkn .= $item2->smk;
          }
          ?>


        </div>

      </div>
    </section><!-- End Counts Section -->
    </div>
  </section>
  <!-- End testimonial Area -->


  <?php include "footer.php"; ?>