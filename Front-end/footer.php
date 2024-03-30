<?php
include("../Admin/connection/connect.php");
// include("./root/Header.php");
// include("../Admin/model/class/CRUD.php");
?>
</head>
<style>
  .btn-link {
    text-decoration: none;
    transition: .2s;
  }

  .btn-link:hover {
    transform: scale(1.03);
  }
</style>

<body>

  <section class="py-12 py-sm-24 position-relative overflow-hidden" style="background-color: cadetblue;">
    <div class="container position-relative">
      <div class="row mt-5">
        <div class="col-12 col-lg-3 mb-13 mb-lg-0">
          <a class="d-inline-block mb-8" href="#">
            <?php
            $l = new Logo();
            $logo = $l->getActiveLogo();
            ?>
            <img src="./assets/img/<?php echo $logo; ?>" alt="" height="70">
            <?php
            ?>
          </a>
          <p class="mt-4 ml-3 text-white">Welcome</p>
        </div>
        <div class="col-12 col-lg-9">
          <div class="row">
            <div class="col-4 col-md-3 mb-13 mb-md-0 ml-5">
              <h6 class="mb-3 text-white">Services</h6>
              <ul class="list-unstyled">
                <?php
                $m = new Menu();
                $menu = $m->getActiveMenu();
                foreach ($menu as $res) {
                  ?>
                  <li class="mb-4">
                    <a class="btn btn-link p-0 text-light" href="<?php echo $res['menu_url']; ?>">
                      <?php echo $res['title']; ?>
                    </a>
                  </li>
                  <?php
                }
                ?>
              </ul>
            </div>
            <div class="col-4 col-md-3 ml-5">
              <h6 class="mb-3 text-white">Contact</h6>
              <ul class="list-unstyled">
                <?php
                $f = new Footer();
                $footer = $f->getActiveOnlyOneFooter();
                foreach ($footer as $res) {
                  ?>
                  <li class="mb-4">
                    <a class="btn btn-link p-0 text-light" href="mailto: <?php echo $res['email'] ?>">
                    <i class="fa-solid fa-envelope"></i> <?php echo $res['email']; ?>
                    </a>
                  </li>
                  <li class="mb-4">
                    <a class="btn btn-link p-0 text-light" href="">
                    <i class="fa-solid fa-phone"></i> <?php echo $res['phone']; ?>
                    </a>
                  </li>
                  <li class="mb-4">
                    <a class="btn btn-link p-0 text-light" href="">
                    <i class="fa-solid fa-location-dot"></i> <?php echo $res['location']; ?>
                    </a>
                  </li>
                <?php
                }
                ?>
              </ul>
            </div>
            <!-- <div class="col-3 col-md-3 mb-13 mb-md-0 ml-5">
              <h6 class="mb-3">Follow Us</h6>
              <ul class="list-unstyled">

                <li class="mb-4"><a class="btn btn-link p-0 text-light" href="#">Careers</a></li>

              </ul>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="container-fluid" style="background-color: whitesmoke;">
    <div class="row">
      <div class="col-xl-4">

      </div>
      <div class="col-xl-4">
        <p class="text-center mt-4" style="color: black;">
          <?php
            $f = new Footer();
            $footer = $f->getActiveOnlyOneFooter();
            foreach ($footer as $res) {
              echo $res['description'];
            }
        ?>
      </p>
      </div>
      <div class="col-xl-4">
        <ul class="list-unstyled float-xl-right mr-5">
          <div class="bg-outline-info rounded-circle d-flex justify-content-center align-items-center mt-3" style="width: 2.5rem; height: 2.5rem;">          
            <?php 
              $f = new Footer();
              $footer = $f->getAllFooter();
              foreach ($footer as $res) {
                ?>
                  <li>
                    <a href="<?php echo $res['url_social'];?>" target="_blank" style="font-size: 25px; color: cadetblue;">
                          <i class="<?php echo $res['icon_social'];?> m-2"></i>
                      </a>
                  </li>
                <?php 
              }
            ?>
          </div>
        </ul>
      </div>
    </div>
  </div>

</body>

</html>