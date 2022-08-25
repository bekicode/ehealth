<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>GetShayna by BuildWith Angga</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    </head>
    <body>
       <section class="h-100 w-100 bg-white" style="box-sizing: border-box">
    <style scoped>
        body {
            font-family: 'Poppins', sans-serif;
        }
      @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

      .header-4-2 .modal-item.modal {
        top: 2rem;
      }

      .header-4-2 .navbar,
      .header-4-2 .hero {
        padding: 3rem 2rem;
      }

      .header-4-2 .navbar-light .navbar-nav .nav-link {
        font: 300 18px/1.5rem Poppins, sans-serif;
        color: #1d1e3c;
        transition: 0.3s;
      }

      .header-4-2 .navbar-light .navbar-nav .nav-link:hover {
        font: 600 18px/1.5rem Poppins, sans-serif;
        color: #1d1e3c;
        transition: 0.3s;
      }

      .header-4-2 .navbar-light .navbar-nav .active>.nav-link,
      .header-4-2 .navbar-light .navbar-nav .nav-link.active,
      .header-4-2 .navbar-light .navbar-nav .nav-link.show,
      .header-4-2 .navbar-light .navbar-nav .show>.nav-link {
        font-weight: 600;
        transition: 0.3s;
      }

      .header-4-2 .navbar-light .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(0, 0, 0, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
      }

      .header-4-2 .btn:focus,
      .header-4-2 .btn:active {
        outline: none !important;
      }

      .header-4-2 .btn-fill {
        font: 600 18px / normal Poppins, sans-serif;
        background-color: #27c499;
        border-radius: 12px;
        padding: 12px 32px;
        transition: 0.3s;
      }

      .header-4-2 .btn-fill:hover {
        --tw-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
          0 4px 6px -2px rgba(0, 0, 0, 0.05);
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
          var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
        transition: 0.3s;
      }

      .header-4-2 .btn-no-fill {
        font: 300 18px/1.75rem Poppins, sans-serif;
        color: #1d1e3c;
        padding: 12px 32px;
        transition: 0.3s;
      }

      .header-4-2 .modal-item .modal-dialog .modal-content {
        border-radius: 8px;
        transition: 0.3s;
      }

      .header-4-2 .responsive li a {
        padding: 1rem;
        transition: 0.3s;
      }

      .header-4-2 .text-caption {
        font: 600 0.875rem/1.625 Poppins, sans-serif;
        margin-bottom: 2rem;
        color: #27c499;
      }

      .header-4-2 .left-column {
        margin-bottom: 2.75rem;
        width: 100%;
      }

      .header-4-2 .right-column {
        width: 100%;
      }

      .header-4-2 .title-text-big {
        font: 600 2.25rem/2.5rem Poppins, sans-serif;
        margin-bottom: 2rem;
        color: #272e35;
      }

      .header-4-2 .btn-try {
        font: 600 1rem/1.5rem Poppins, sans-serif;
        padding: 1rem 1.5rem;
        border-radius: 0.75rem;
        background-color: #27c499;
        transition: 0.3s;
      }

      .header-4-2 .btn-try:hover {
        --tw-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
          0 4px 6px -2px rgba(0, 0, 0, 0.05);
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
          var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
        transition: 0.3s;
      }

      .header-4-2 .btn-outline {
        font: 400 1rem/1.5rem Poppins, sans-serif;
        border: 1px solid #555b61;
        color: #555b61;
        padding: 1rem 1.5rem;
        border-radius: 0.75rem;
        background-color: transparent;
        transition: 0.3s;
      }

      .header-4-2 .btn-outline:hover {
        border: 1px solid #27c499;
        color: #27c499;
        transition: 0.3s;
      }

      .header-4-2 .btn-outline:hover div path {
        fill: #27c499;
        transition: 0.3s;
      }

      @media (min-width: 576px) {
        .header-4-2 .modal-item .modal-dialog {
          max-width: 95%;
          border-radius: 12px;
        }

        .header-4-2 .navbar {
          padding: 3rem 2rem;
        }

        .header-4-2 .hero {
          padding: 3rem 2rem 5rem;
        }

        .header-4-2 .title-text-big {
          font-size: 3rem;
          line-height: 1.2;
        }
      }

      @media (min-width: 768px) {
        .header-4-2 .navbar {
          padding: 3rem 4rem;
        }

        .header-4-2 .hero {
          padding: 3rem 4rem 5rem;
        }

        .header-4-2 .left-column {
          margin-bottom: 3rem;
        }
      }

      @media (min-width: 992px) {
        .header-4-2 .navbar-expand-lg .navbar-nav .nav-link {
          padding-right: 1.25rem;
          padding-left: 1.25rem;
        }

        .header-4-2 .navbar {
          padding: 3rem 6rem;
        }

        .header-4-2 .hero {
          padding: 3rem 6rem 5rem;
        }

        .header-4-2 .left-column {
          width: 50%;
          margin-bottom: 0;
        }

        .header-4-2 .right-column {
          width: 50%;
        }

        .header-4-2 .title-text-big {
          font-size: 3.75rem;
          line-height: 1.2;
        }
      }
    </style>
    <div class="header-4-2 container-xxl mx-auto p-0 position-relative" style="font-family: 'Poppins', sans-serif">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a href="#">
          <img style="margin-right: 0.75rem"
            src="http://api.elements.buildwithangga.com/storage/files/2/assets/Header/Header2/Header-2-5.png" alt="" />
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="modal" data-bs-target="#targetModal-item">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="modal-item modal fade" id="targetModal-item" tabindex="-1" role="dialog"
          aria-labelledby="targetModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content bg-white border-0">
              <div class="modal-header border-0" style="padding: 2rem; padding-bottom: 0">
                <a class="modal-title" id="targetModalLabel">
                  <img style="margin-top: 0.5rem"
                    src="http://api.elements.buildwithangga.com/storage/files/2/assets/Header/Header2/Header-2-5.png"
                    alt="" />
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" style="padding: 2rem; padding-top: 0; padding-bottom: 0">
                <ul class="navbar-nav responsive me-auto mt-2 mt-lg-0">
                  <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Feature</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                  </li>
                </ul>
              </div>
              <div class="modal-footer border-0 gap-3" style="padding: 2rem; padding-top: 0.75rem">
                <button class="btn btn-default btn-no-fill">Log In</button>
                <button class="btn btn-fill text-white">Try Now</button>
              </div>
            </div>
          </div>
        </div>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo">
          <ul class="navbar-nav me-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Feature</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
          <div class="gap-3">
            <button class="btn btn-default btn-no-fill">Log In</button>
            <button class="btn btn-fill text-white">Try Now</button>
          </div>
        </div>
      </nav>

      <div>
        <div class="mx-auto d-flex flex-lg-row flex-column hero">
          <!-- Left Column -->
          <div
            class="left-column d-flex flex-lg-grow-1 flex-column align-items-lg-start text-lg-start align-items-center text-center">
            <p class="text-caption">SELAMAT DATANG DI</p>
            <h1 class="title-text-big">
              Posyandu Desa Grujugan
            </h1>
            <div class="d-flex flex-sm-row flex-column align-items-center mx-lg-0 mx-auto justify-content-center gap-3">
              <a class="btn d-inline-flex mb-md-0 btn-try text-white">
                Login
              </a>
              <button class="btn btn-outline">
                <div class="d-flex align-items-center">
                  <svg class="me-2" width="13" height="12" viewBox="0 0 13 13" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M10.9293 7.99988L6.66668 5.15788V10.8419L10.9293 7.99988ZM12.9173 8.27722L5.85134 12.9879C5.80115 13.0213 5.74283 13.0404 5.6826 13.0433C5.62238 13.0462 5.5625 13.0327 5.50934 13.0042C5.45619 12.9758 5.41175 12.9334 5.38075 12.8817C5.34976 12.83 5.33337 12.7708 5.33334 12.7105V3.28922C5.33337 3.22892 5.34976 3.16976 5.38075 3.11804C5.41175 3.06633 5.45619 3.02398 5.50934 2.99552C5.5625 2.96706 5.62238 2.95355 5.6826 2.95644C5.74283 2.95932 5.80115 2.97848 5.85134 3.01188L12.9173 7.72255C12.963 7.75299 13.0004 7.79423 13.0263 7.84261C13.0522 7.89099 13.0658 7.94501 13.0658 7.99988C13.0658 8.05475 13.0522 8.10878 13.0263 8.15716C13.0004 8.20553 12.963 8.24678 12.9173 8.27722Z"
                      fill="#555B61" />
                  </svg>
                  Jelajahi Website
                </div>
              </button>
            </div>
          </div>
          <!-- Right Column -->
          <div class="right-column text-center d-flex justify-content-lg-end justify-content-center pe-0">
            <svg style="height: 50vh;" xmlns="http://www.w3.org/2000/svg" width="398.40949" height="619.70996" viewBox="0 0 398.40949 619.70996" xmlns:xlink="http://www.w3.org/1999/xlink"><polygon points="263.59649 250.24267 256.28537 173.47594 167.33345 183.22409 167.33345 249.02415 263.59649 250.24267" fill="#ffb6b6"/><polygon points="297.10141 562.78998 297.10141 619.70996 295.18142 618.83996 63.15146 618.83996 69.85141 577.45001 70.98142 570.46997 71.87143 565 114.13144 564.58996 114.17141 564.57996 131.04142 564.41998 135.33146 564.38 138.68142 564.33996 189.3414 563.84997 258.40146 563.16998 297.10141 562.78998" fill="#2f2e41"/><polygon points="166.11493 230.74635 262.37799 239.27598 340.9725 276.44083 303.19839 465.31137 297.1058 581.07074 68.02409 577.41516 94.83152 442.15951 82.64633 258.16305 166.11493 230.74635" fill="#e6e6e6"/><path d="M114.9371,430.58359s1.21852-9.74817,6.0926-7.31113,20.71484,24.37039,15.84077,28.02594-14.62224-2.43704-15.84076-4.87408-6.0926-15.84076-6.0926-15.84076v.00003Z" fill="#27c499"/><path d="M283.63144,613.69l-3.85004,5.14996h-99.06c-9.03998-8.96997-23.77997-21.19-39.71997-33.67999-2.16003-1.70996-4.34998-3.40997-6.54999-5.10999-.69-.53998-1.38-1.07001-2.07001-1.59998l-.01001-.01001c-3.60999-2.79004-7.23999-5.57001-10.84003-8.29999-2.46997-1.88-4.92999-3.74005-7.35999-5.56006-.01001-.00995-.01996-.01996-.03998-.02997-.78003-.59003-1.57001-1.17999-2.35004-1.76001-14.31995-10.73999-27.35999-20.21002-35.65997-26.21997h-.01001c-2.42999-1.75-4.45996-3.20001-5.97998-4.30005-2.14001-1.53998-3.33002-2.37994-3.33002-2.37994l2.45001-1.91003c.02002,.01001,.02002,0,.02002,0l10-7.72998,.09998-.08002,6.47998-5.01001,39.67004-30.69-1.65002-1.46997,32.89001,11.57996,36.25,20.93005,31.88,18.39996,10,5.78003c4.82001,2.77997,9.22998,6.15997,13.13995,10.03998,2.82001,2.79999,5.39001,5.85999,7.64001,9.14001,.89001,1.27002,1.72003,2.58002,2.51001,3.91998l.22003,.38,10.25995,17.45001,14.21002,32.38,.76001,.69Z" fill="#27c499"/><path d="M232.31712,618.84485h62.86339l-11.55154-5.15442-7.31113-3.26562c-15.45081-6.89679-32.91223-2.961-44.00073,8.41998l.00002,.00006Z" fill="#ffb6b6"/><circle cx="185.00198" cy="141.18516" r="81.64083" fill="#ffb6b6"/><path d="M125.19077,407.63867c.45215,9.09863,30.26415,34.13379,33.62548,36.92871l35.97559-27.51172c3.40918-2.60645,4.87988-6.94727,3.74658-11.05762-4.31445-15.65234-19.1499-26.66113-27.60938-31.83008-4.04053-2.46875-9.25391-1.87402-12.67969,1.44434,0,0-33.05859,32.02637-33.05859,32.02637Z" fill="#27c499"/><path d="M135.4472,411.96683c-4.05663-4.04117-10.22867-5.21942-15.39484-2.75003-4.45673,2.13028-8.18198,5.49338-5.11527,10.40012,3.90534,6.24854,14.81992,19.00568,22.15336,27.36005,5.41051,6.16376,15.20444,6.40802,20.48175,.12982,1.89799-2.25797,2.75476-4.94727,1.23161-7.99356-3.33807-6.67615-15.82066-19.63916-23.3566-27.14639h-.00002Z" fill="#3f3d56"/><path d="M253.82919,462.30115l-42.55945-16.5976c-6.8316-7.35724-15.32593-12.97137-24.77216-16.37286-23.52631-8.83783-47.14734-3.86792-52.77026,11.09888-5.62292,14.96686,8.8844,34.2608,32.4035,43.09235,9.35248,3.65997,19.44568,5.02625,29.43475,3.98468l40.26416,18.09656,18.01862-43.33807-.01917,.03607Z" fill="#ffb6b6"/><path d="M388.87143,393l-75,5,10.65106,82.54285-70.67413-18.27777-18.01862,43.33807c5.49701,2.64209,16.38599,7.74731,30.06799,13.51392l25.888,10.26276c26.73639,9.88672,57.08911,18.73041,79.04047,18.18164,48.74078-1.21857,18.04523-154.56146,18.04523-154.56146Z" fill="#e6e6e6"/><path d="M328.17804,274.61307s25.5889,0,41.42966,25.5889,21.93335,99.91861,21.93335,99.91861l-86.51489,7.31113,23.15189-132.81863Z" fill="#e6e6e6"/><path d="M100.31487,258.77231s-37.77411-7.31113-53.61486,28.02594c-15.84076,35.33707-25.58891,86.51489-25.58891,86.51489l85.29637,3.65555-6.0926-118.19641v.00003Z" fill="#e6e6e6"/><path d="M195.05899,1.10923s70.57916-3.35613,90.00522,54.30897c19.42606,57.66509,64.34192,122.84976,64.34192,122.84976,0,0,16.51447,8.35371,4.52493,33.70189-11.98956,25.34816,21.71234,20.82324,21.71234,20.82324,0,0,7.02737,60.62796-42.69315,41.15427-49.72049-19.47369-64.54715,24.80099-64.54715,24.80099,0,0-66.07376,2.38031-55.7171-42.03607s-8.96312-105.43396-89.83176-130.36934,13.03256-93.55066,13.03256-93.55066c0,0,12.44998-39.87557,59.1722-31.68305h-.00002Z" fill="#2f2e41"/><path d="M200.29142,618.83996H125.21145l-15.05005-14.26996-.03998,.02997,.25-.25,24.08002-24.29999,1.52997-1.54999,7-7.04999,.17999-.19,2.89001,3.02997,4.22998,4.44,.22003,.22998,23.12,24.24005c9.65002,2.79999,18.47998,7.87994,25.76001,14.78998,.31,.27997,.60999,.57001,.90997,.84998h.00002Z" fill="#ffb6b6"/><path d="M192.82673,489.73987c-8.06116-4.03613-19.73621,2.95978-26.0809,15.6308-2.6039,5.02676-3.96608,10.60406-3.9726,16.2652l-.31029,.63947-16.11314,27.8761-6.922-12.74249-23.68694,17.81201s-1.97404,10.84283,24.68681,27.45911c5.33688,3.32617,10.27922,3.44403,14.77316,1.51398l14.32628-14.12903c8.5368-13.47229,13.63242-31.26636,14.32399-33.76794l1.43704-3.38776c4.53094-3.39697,8.18233-7.8299,10.64835-12.92767,6.34412-12.66565,4.95143-26.20563-3.10979-30.24176h.00002Z" fill="#ffb6b6"/><path d="M140.52601,496.38364c2.43704,0-38.99263,45.08524-38.99263,45.08524l35.90796,27.93481,12.83282-52.30518-9.74815-20.71484v-.00003Z" fill="#27c499"/><path d="M150.84684,578.73114l-12.78226-11.83179-4.44756-4.10638-17.81475-16.48663-9.57762-9.96747-13.62304-14.15918-6.75057-7.01868-4.55725-4.72787-4.1308-4.30133,1.66937-17.32739,3.44843-35.70261,4.42323-45.85291,3.44836-35.7392,.41433-4.28915-14.69527-21.22055-55,27-14.65062,109.22443-2.48583,11.77087v.00003c-2.05896,9.7388,1.35264,19.82571,8.90039,26.31528l50.51464,43.43274,6.48253,5.56866,9.62626,8.28595,31.6328,27.19739,39.95524-26.06415-.00002-.00006Z" fill="#e6e6e6"/><circle cx="66.19632" cy="465.92066" r="62.14451" fill="#ffb6b6"/><path d="M92.86054,476.05835l1.05061-19.01178-8.52964-14.62225s-2.43704-49.95932-21.93335-47.52228C43.95184,397.33911,1.30366,432.67618,.08514,446.07989c-1.21852,13.40372,10.7863,70.9201,26.80743,70.67413,11.55853-.17749,8.97886,27.24597,65.97886,6.24597,6.46799-2.38293-18.4566-17.21265-14.80104-25.74228s14.79014-21.19937,14.79014-21.19937h.00002Z" fill="#2f2e41"/></svg>
            {{-- <img id="img-fluid" class="h-auto mw-100"
              src="{{asset('on')}}"
              alt="" /> --}}
          </div>
        </div>
      </div>
    </div>
  </section>
  
    <div class="content-3-2 container-xxl mx-auto  position-relative" style="font-family: 'Poppins', sans-serif">
      <div class="d-flex flex-lg-row flex-column align-items-center">
            <section id="about">
                <div class="container">
                    <div class="row justify-content-center">
                        <h3 class="text-center my-5 title-text ofh" style="font: 600 1.875rem/2.25rem Poppins, sans-serif;">Tentang Desa</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 ofh" data-aos="fade-right" data-aos-duration="1000">
                            <p align="justify">
                                Desa Grujugan adalah desa yang paling kecil di kecatamatan petanahan. Kecamatan tersebut termasuk kawasan pesisir selatan Kabupaten Kebumen. Namun untuk Desa Grujugan itu sendiri berada di wilayah utara Petanahan. Jadi tidak memiliki tanah yang berpasir, melainkan memiliki tanah seperti pada umumnya. Uniknya, Desa Grujugan dikelilingi oleh sawah. Kalau diibaratkan sebuah negara, Desa ini tidak berbatasan darat dengan wilayah lain. Desa Grujugan dipimpin oleh seorang kepala desa dan dibantu oleh pejabat-pejabat lainnya. Balai Desanya berada di pusat Desa Grujugan, yaitu berada di pertigaan jalan. Desa Grujugan terdiri dari tiga dusun, yaitu Enthak, Kemranggon dan Karangkemiri. Jumlah penduduk desa Grujugan 1.772 Jiwa. Wilayah desa Grujugan. Jumlah RT desa Grujugan yaitu: 9 RT, kemudian untuk jumlah Rw nya itu ada : 2.
                            </p>
                        </div>
                        <div class="col-md-6 ofh" data-aos="fade-left" data-aos-duration="1000">
                            <img src="images/dinamis/IMG_5344_2.webp" class="w-100 rounded-3">
                        </div>
                    </div>
                </div>
                <div class="spacer"></div>
            </section>
        </div>
    </div>
    <div class="content-3-2 container-xxl mx-auto  position-relative" style="font-family: 'Poppins', sans-serif">
      <div class="d-flex flex-lg-row flex-column align-items-center">
            <section id="vm">
                <div class="container">
                    <div class="row justify-content-center">
                        <h3 class="text-center my-5 ofh titled" data-aos="fade-down" data-aos-duration="1000">Visi & Misi</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 ofh" data-aos="fade-right" data-aos-duration="1000">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Visi</h5>
                                    <p class="card-text" align="justify">
                                        Terbangunnya tata kelola Pemerintahan Desa yang baik, bersih, dan transparan guna mewujudkan kehidupan Masyarakat Desa Grujugan yang adil, makmur, sejahtera, dan berakhlak mulia.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ofh" data-aos="fade-left" data-aos-duration="1000">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Misi</h5>
                                    <p class="card-text" align="justify">
                                        <ol>
                                            <li align="justify">
                                                Melakukan reformasi system kinerja aparatur pemerintah desa guna meningkatkan kualitas pelayanan kepada Masyarakat
                                            </li>
                                            <li align="justify">
                                                Menyelenggarakan pemerintahan yang bersih, bebas dari KKN serta bentuk-bentuk penyelewengan lainnya
                                            </li>
                                            <li align="justify">
                                                Menyelenggarakan urusan pemerintahan desa secara terbuka dan dapat dipertanggungjawabkan sesuai ketentuan yang berlaku
                                            </li>
                                            <li align="justify">
                                                Meningkatkan perekonomian masyarakat melalui pendampingan berupa penyuluhan/sosialisasi serta pemanfaatan potensi desa
                                            </li>
                                            <li align="justify">
                                                Meningkatkan mutu kesejahteraan masyarakat untuk mencapai taraf kehidupan yang lebih baik dan layak sehingga menjadi yang maju, dan mandiri
                                            </li>
                                            <li align="justify">
                                                Meningkatkan Kerukunan antar umat beragama
                                            </li>
                                            <li align="justify">
                                                Membagun Perekonomian, Pertanian , Kesehatan , Sosial, Seni dan budaya, Infrastrutur Serta Keamanan Masyarakat
                                            </li>
                                        </ol>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="spacer"></div>
            </section>
      </div>
    </div>
  <section class="h1-00 w-100 bg-white" style="box-sizing: border-box">
    <style scoped>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

      .content-3-2 .btn:focus,
      .content-3-2 .btn:active {
        outline: none !important;
      }

      .content-3-2 {
        padding: 5rem 2rem;
      }

      .content-3-2 .img-hero {
        width: 100%;
        margin-bottom: 3rem;
      }

      .content-3-2 .right-column {
        width: 100%;
      }

      .content-3-2 .title-text {
        font: 600 1.875rem/2.25rem Poppins, sans-serif;
        margin-bottom: 2.5rem;
        letter-spacing: -0.025em;
        color: #121212;
      }

      .content-3-2 .title-caption {
        font: 500 1.5rem/2rem Poppins, sans-serif;
        margin-bottom: 1.25rem;
        color: #121212;
      }

      .content-3-2 .circle {
        font: 500 1.25rem/1.75rem Poppins, sans-serif;
        height: 3rem;
        width: 3rem;
        margin-bottom: 1.25rem;
        border-radius: 9999px;
        background-color: #27c499;
      }

      .content-3-2 .text-caption {
        font: 400 1rem/1.75rem Poppins, sans-serif;
        letter-spacing: 0.025em;
        color: #565656;
      }

      .content-3-2 .btn-learn {
        font: 600 1rem/1.5rem Poppins, sans-serif;
        padding: 1rem 2.5rem;
        background-color: #27c499;
        transition: 0.3s;
        letter-spacing: 0.025em;
        border-radius: 0.75rem;
      }

      .content-3-2 .btn:hover {
        background-color: #45dbb2;
        transition: 0.3s;
      }

      @media (min-width: 768px) {
        .content-3-2 .title-text {
          font: 600 2.25rem/2.5rem Poppins, sans-serif;
        }
      }

      @media (min-width: 992px) {
        .content-3-2 .img-hero {
          width: 50%;
          margin-bottom: 0;
        }

        .content-3-2 .right-column {
          width: 50%;
        }

        .content-3-2 .circle {
          margin-right: 1.25rem;
          margin-bottom: 0;
        }
      }
    </style>
    <div class="content-3-2 container-xxl mx-auto  position-relative" style="font-family: 'Poppins', sans-serif">
      <div class="d-flex flex-lg-row flex-column align-items-center">
        <!-- Left Column -->
        <div class="img-hero text-center justify-content-center d-flex">
          <img id="hero" class="img-fluid"
            src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content3/Content-3-1.png"
            alt="" />
        </div>

        <!-- Right Column -->
        <div class="right-column d-flex flex-column align-items-lg-start align-items-center text-lg-start text-center">
          <h2 class="title-text">3 Keys Benefit</h2>
          <ul style="padding: 0; margin: 0">
            <li class="list-unstyled" style="margin-bottom: 2rem">
              <h4
                class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                <span class="circle text-white d-flex align-items-center justify-content-center">
                  1
                </span>
                Trusted Mentor
              </h4>
              <p class="text-caption">
                We have provided highly experienced mentors<br class="d-sm-inline d-none" />
                for several years.
              </p>
            </li>
            <li class="list-unstyled" style="margin-bottom: 2rem">
              <h4
                class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                <span class="circle text-white d-flex align-items-center justify-content-center">
                  2
                </span>
                Access Forever
              </h4>
              <p class="text-caption">
                Are you busy at work so it's hard to consult? don't<br class="d-sm-inline d-none" />
                worry because you can access anytime.
              </p>
            </li>
            <li class="list-unstyled" style="margin-bottom: 4rem">
              <h4
                class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                <span class="circle text-white d-flex align-items-center justify-content-center">
                  3
                </span>
                Halfpenny
              </h4>
              <p class="text-caption">
                We provide economical packages for those of you<br class="d-sm-inline d-none" />
                who are still in school or workers.
              </p>
            </li>
          </ul>
          <button class="btn btn-learn text-white">Learn More</button>
        </div>
      </div>
    </div>
  </section><section class="h-100 w-100 bg-white" style="box-sizing: border-box">
    <style scoped>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

      .content-2-2 .btn:focus,
      .content-2-2 .btn:active {
        outline: none !important;
      }

      .content-2-2 .title-text {
        padding-top: 5rem;
        margin-bottom: 3rem;
      }

      .content-2-2 .text-title {
        font: 600 2.25rem/2.5rem Poppins, sans-serif;
        color: #121212;
        margin-bottom: 0.625rem;
      }

      .content-2-2 .text-caption {
        color: #121212;
        font-weight: 300;
      }

      .content-2-2 .column {
        padding: 2rem 2.25rem;
      }

      .content-2-2 .icon {
        margin-bottom: 1.5rem;
      }

      .content-2-2 .icon-title {
        font: 500 1.5rem/2rem Poppins, sans-serif;
        margin-bottom: 0.625rem;
        color: #121212;
      }

      .content-2-2 .icon-caption {
        font: 400 1rem/1.625 Poppins, sans-serif;
        letter-spacing: 0.025em;
        color: #565656;
      }

      .content-2-2 .card-block {
        padding: 1rem 1rem 5rem;
      }

      .content-2-2 .card {
        padding: 1.75rem;
        background-color: #eef6f4;
        border-radius: 0.75rem;
        border: 1px solid #27c499;
      }

      .content-2-2 .card-title {
        font: 600 1.5rem/2rem Poppins, sans-serif;
        margin-bottom: 0.625rem;
        color: #000000;
      }

      .content-2-2 .card-caption {
        font: 300 1rem/1.5rem Poppins, sans-serif;
        color: #565656;
        letter-spacing: 0.025em;
        margin-bottom: 0;
      }

      .content-2-2 .btn-card {
        font: 700 1rem/1.5rem Poppins, sans-serif;
        background-color: #27c499;
        padding-top: 1rem;
        padding-bottom: 1rem;
        width: 100%;
        border-radius: 0.75rem;
        margin-bottom: 1.25rem;
      }

      .content-2-2 .btn-card:hover {
        --tw-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
          0 4px 6px -2px rgba(0, 0, 0, 0.05);
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
          var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
      }

      .content-2-2 .btn-outline {
        font: 400 1rem/1.5rem Poppins, sans-serif;
        color: #979797;
        border: 1px solid #979797;
        padding-top: 1rem;
        padding-bottom: 1rem;
        width: 100%;
        border-radius: 0.75rem;
      }

      .content-2-2 .btn-outline:hover {
        border: 1px solid #27c499;
        color: #27c499;
      }

      .content-2-2 .card-text {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
      }

      .content-2-2 .grid-padding {
        padding: 0rem 1rem 3rem;
      }

      @media (min-width: 576px) {
        .content-2-2 .grid-padding {
          padding: 0rem 2rem 3rem;
        }

        .content-2-2 .card-block {
          padding: 3rem 2rem 5rem;
        }
      }

      @media (min-width: 768px) {
        .content-2-2 .grid-padding {
          padding: 0rem 4rem 3rem;
        }

        .content-2-2 .card-block {
          padding: 3rem 4rem 5rem;
        }
      }

      @media (min-width: 992px) {
        .content-2-2 .grid-padding {
          padding: 1rem 6rem 3rem;
        }

        .content-2-2 .card-block {
          padding: 3rem 6rem 5rem;
        }

        .content-2-2 .column {
          padding: 0rem 2.25rem;
        }
      }

      @media (min-width: 1200px) {
        .content-2-2 .grid-padding {
          padding: 1rem 10rem 3rem;
        }

        .content-2-2 .card-block {
          padding: 3rem 6rem 5rem;
        }

        .content-2-2 .card-btn-space {
          margin-top: 15px;
          margin-bottom: 15px;
        }

        .content-2-2 .btn-card,
        .content-2-2 .btn-outline {
          width: 95%;
          float: right;
        }
      }

      @media (max-width: 980px) {
        .content-2-2 .card-btn-space {
          width: 100%;
        }
      }
    </style>
    <div class="content-2-2 container-xxl mx-auto p-0  position-relative" style="font-family: 'Poppins', sans-serif">
      <div class="text-center title-text">
        <h1 class="text-title">3 Keys Benefit</h1>
        <p class="text-caption" style="margin-left: 3rem; margin-right: 3rem">
          You can easily manage your business with a powerful tools
        </p>
      </div>

      <div class="grid-padding text-center">
        <div class="row">
          <div class="col-lg-4 column">
            <div class="icon">
              <img src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content2/Content-2-5.png"
                alt="" />
            </div>
            <h3 class="icon-title">Easy to Operate</h3>
            <p class="icon-caption">
              This can easily help you to<br />
              grow up your business fast
            </p>
          </div>
          <div class="col-lg-4 column">
            <div class="icon">
              <img src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content2/Content-2-6.png"
                alt="" />
            </div>
            <h3 class="icon-title">Real-Time Analytic</h3>
            <p class="icon-caption">
              With real-time analytics, you<br />
              can check data in real time
            </p>
          </div>
          <div class="col-lg-4 column">
            <div class="icon">
              <img src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content2/Content-2-7.png"
                alt="" />
            </div>
            <h3 class="icon-title">Very Full Secured</h3>
            <p class="icon-caption">
              With real-time analytics, we<br />
              will guarantee your data
            </p>
          </div>
        </div>
      </div>

      <div class="card-block">
        <div class="card">
          <div class="d-flex flex-lg-row flex-column align-items-center">
            <div class="me-lg-3">
              <img
                src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content2/Content-2-1%20(1).png"
                alt="" />
            </div>
            <div class="flex-grow-1 text-lg-start text-center card-text">
              <h3 class="card-title">
                Fast Business Management in 30 minutes
              </h3>
              <p class="card-caption">
                Our tools for business analysis helps an organization
                understand<br class="d-none d-lg-block" />
                market or business development.
              </p>
            </div>
            <div class="card-btn-space">
              <button class="btn btn-card text-white">Buy Now</button>
              <button class="btn btn-outline">Demo Version</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><section class="h-100 w-100 bg-white" style="box-sizing: border-box">
		<style>
			@import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

			.footer-2-2 .list-space {
				margin-bottom: 1.25rem;
			}

			.footer-2-2 .footer-text-title {
				font-size: 1.5rem;
				font-weight: 600;
				color: #000000;
				margin-bottom: 1.5rem;
			}

			.footer-2-2 .list-menu {
				color: #c7c7c7;
				text-decoration: none !important;
			}

			.footer-2-2 .list-menu:hover {
				color: #555252;
			}

			.footer-2-2 hr.hr {
				margin: 0;
				border: 0;
				border-top: 1px solid rgba(0, 0, 0, 0.1);
			}

			.footer-2-2 .border-color {
				color: #c7c7c7;
			}

			.footer-2-2 .footer-link {
				color: #c7c7c7;
			}

			.footer-2-2 .footer-link:hover {
				color: #555252;
			}

			.footer-2-2 .social-media-c:hover circle,
			.footer-2-2 .social-media-p:hover path {
				fill: #555252;
			}

			.footer-2-2 .footer-info-space {
				padding-top: 3rem;
			}

			.footer-2-2 .list-footer {
				padding: 5rem 1rem 3rem 1rem;
			}

			.footer-2-2 .info-footer {
				padding: 0 1rem 3rem;
			}

			@media (min-width: 576px) {
				.footer-2-2 .list-footer {
					padding: 5rem 2rem 3rem 2rem;
				}

				.footer-2-2 .info-footer {
					padding: 0 2rem 3rem;
				}
			}

			@media (min-width: 768px) {
				.footer-2-2 .list-footer {
					padding: 5rem 4rem 6rem 4rem;
				}

				.footer-2-2 .info-footer {
					padding: 0 4rem 3rem;
				}
			}

			@media (min-width: 992px) {
				.footer-2-2 .list-footer {
					padding: 5rem 6rem 6rem 6rem;
				}

				.footer-2-2 .info-footer {
					padding: 0 6rem 3rem;
				}
			}
		</style>

		<div class="footer-2-2 container-xxl mx-auto position-relative p-0" style="font-family: 'Poppins', sans-serif">
			<div class="list-footer">
				<div class="row gap-md-0 gap-3">
					<div class="col-lg-3 col-md-6">
						<div class="">
							<div class="list-space">
								<img src="http://api.elements.buildwithangga.com/storage/files/2/assets/Header/Header2/Header-2-5.png"
									alt="" />
							</div>
							<nav class="list-unstyled">
								<li class="list-space">
									<a href="" class="list-menu">Home</a>
								</li>
								<li class="list-space">
									<a href="" class="list-menu">About</a>
								</li>
								<li class="list-space">
									<a href="" class="list-menu">Features</a>
								</li>
								<li class="list-space">
									<a href="" class="list-menu">Pricing</a>
								</li>
								<li class="list-space">
									<a href="" class="list-menu">Testimonial</a>
								</li>
								<li class="list-space">
									<a href="" class="list-menu">Help</a>
								</li>
							</nav>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<h2 class="footer-text-title">Product</h2>
						<nav class="list-unstyled">
							<li class="list-space">
								<a href="" class="list-menu">Real Time Analytic</a>
							</li>
							<li class="list-space">
								<a href="" class="list-menu">Easy to Operate</a>
							</li>
							<li class="list-space">
								<a href="" class="list-menu">Full Secured</a>
							</li>
							<li class="list-space">
								<a href="" class="list-menu">Analytic Tool</a>
							</li>
							<li class="list-space">
								<a href="" class="list-menu">Story</a>
							</li>
						</nav>
					</div>
					<div class="col-lg-3 col-md-6">
						<h2 class="footer-text-title">Company</h2>
						<nav class="list-unstyled">
							<li class="list-space">
								<a href="" class="list-menu">Contact Us</a>
							</li>
							<li class="list-space">
								<a href="" class="list-menu">Blog</a>
							</li>
							<li class="list-space">
								<a href="" class="list-menu">Culture</a>
							</li>
							<li class="list-space">
								<a href="" class="list-menu">Security</a>
							</li>
						</nav>
					</div>
					<div class="col-lg-3 col-md-6">
						<h2 class="footer-text-title">Support</h2>
						<nav class="list-unstyled">
							<li class="list-space">
								<a href="" class="list-menu">Getting Started</a>
							</li>
							<li class="list-space">
								<a href="" class="list-menu">Help Center</a>
							</li>
							<li class="list-space">
								<a href="" class="list-menu">Server Status</a>
							</li>
						</nav>
					</div>
				</div>
			</div>

			<div class="border-color info-footer">
				<div class="">
					<hr class="hr" />
				</div>
				<div class="mx-auto d-flex flex-column flex-lg-row align-items-center footer-info-space gap-4">
					<div class="d-flex title-font font-medium align-items-center gap-4">
						<a href="">
							<svg class="social-media-c" width="30" height="30" viewBox="0 0 30 30" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<circle cx="15" cy="15" r="15" fill="#C7C7C7" />
								<g clip-path="url(#clip0)">
									<path
										d="M17.6648 9.65667H19.1254V7.11267C18.8734 7.078 18.0068 7 16.9974 7C14.8914 7 13.4488 8.32467 13.4488 10.7593V13H11.1248V15.844H13.4488V23H16.2981V15.8447H18.5281L18.8821 13.0007H16.2974V11.0413C16.2981 10.2193 16.5194 9.65667 17.6648 9.65667V9.65667Z"
										fill="white" />
								</g>
								<defs>
									<clipPath id="clip0">
										<rect width="16" height="16" fill="white" transform="translate(7 7)" />
									</clipPath>
								</defs>
							</svg>
						</a>
						<a href="">
							<svg class="social-media-c" width="30" height="30" viewBox="0 0 30 30" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<circle cx="15" cy="15" r="15" fill="#C7C7C7" />
								<g clip-path="url(#clip0)">
									<path
										d="M23 10.039C22.405 10.3 21.771 10.473 21.11 10.557C21.79 10.151 22.309 9.513 22.553 8.744C21.919 9.122 21.219 9.389 20.473 9.538C19.871 8.897 19.013 8.5 18.077 8.5C16.261 8.5 14.799 9.974 14.799 11.781C14.799 12.041 14.821 12.291 14.875 12.529C12.148 12.396 9.735 11.089 8.114 9.098C7.831 9.589 7.665 10.151 7.665 10.756C7.665 11.892 8.25 12.899 9.122 13.482C8.595 13.472 8.078 13.319 7.64 13.078C7.64 13.088 7.64 13.101 7.64 13.114C7.64 14.708 8.777 16.032 10.268 16.337C10.001 16.41 9.71 16.445 9.408 16.445C9.198 16.445 8.986 16.433 8.787 16.389C9.212 17.688 10.418 18.643 11.852 18.674C10.736 19.547 9.319 20.073 7.785 20.073C7.516 20.073 7.258 20.061 7 20.028C8.453 20.965 10.175 21.5 12.032 21.5C18.068 21.5 21.368 16.5 21.368 12.166C21.368 12.021 21.363 11.881 21.356 11.742C22.007 11.28 22.554 10.703 23 10.039Z"
										fill="white" />
								</g>
								<defs>
									<clipPath id="clip0">
										<rect width="16" height="16" fill="white" transform="translate(7 7)" />
									</clipPath>
								</defs>
							</svg>
						</a>
						<a href="">
							<svg class="social-media-p" width="30" height="30" viewBox="0 0 30 30" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<path
									d="M17.8711 15C17.8711 16.5857 16.5857 17.8711 15 17.8711C13.4143 17.8711 12.1289 16.5857 12.1289 15C12.1289 13.4143 13.4143 12.1289 15 12.1289C16.5857 12.1289 17.8711 13.4143 17.8711 15Z"
									fill="#C7C7C7" />
								<path
									d="M21.7144 9.92039C21.5764 9.5464 21.3562 9.20789 21.0701 8.93002C20.7923 8.64392 20.454 8.42374 20.0797 8.28572C19.7762 8.16785 19.3203 8.02754 18.4805 7.98932C17.5721 7.94789 17.2997 7.93896 14.9999 7.93896C12.6999 7.93896 12.4275 7.94766 11.5193 7.98909C10.6796 8.02754 10.2234 8.16785 9.92014 8.28572C9.54591 8.42374 9.2074 8.64392 8.92976 8.93002C8.64366 9.20789 8.42348 9.54617 8.28523 9.92039C8.16736 10.2239 8.02705 10.6801 7.98883 11.5198C7.9474 12.428 7.93848 12.7004 7.93848 15.0004C7.93848 17.3002 7.9474 17.5726 7.98883 18.481C8.02705 19.3208 8.16736 19.7767 8.28523 20.0802C8.42348 20.4545 8.64343 20.7927 8.92953 21.0706C9.2074 21.3567 9.54568 21.5769 9.91991 21.7149C10.2234 21.833 10.6796 21.9733 11.5193 22.0115C12.4275 22.053 12.6997 22.0617 14.9997 22.0617C17.3 22.0617 17.5723 22.053 18.4803 22.0115C19.3201 21.9733 19.7762 21.833 20.0797 21.7149C20.8309 21.4251 21.4247 20.8314 21.7144 20.0802C21.8323 19.7767 21.9726 19.3208 22.011 18.481C22.0525 17.5726 22.0612 17.3002 22.0612 15.0004C22.0612 12.7004 22.0525 12.428 22.011 11.5198C21.9728 10.6801 21.8325 10.2239 21.7144 9.92039V9.92039ZM14.9999 19.4231C12.5571 19.4231 10.5768 17.4431 10.5768 15.0002C10.5768 12.5573 12.5571 10.5773 14.9999 10.5773C17.4426 10.5773 19.4229 12.5573 19.4229 15.0002C19.4229 17.4431 17.4426 19.4231 14.9999 19.4231ZM19.5977 11.4361C19.0269 11.4361 18.5641 10.9733 18.5641 10.4024C18.5641 9.83159 19.0269 9.36879 19.5977 9.36879C20.1685 9.36879 20.6313 9.83159 20.6313 10.4024C20.6311 10.9733 20.1685 11.4361 19.5977 11.4361Z"
									fill="#C7C7C7" />
								<path
									d="M15 0C6.717 0 0 6.717 0 15C0 23.283 6.717 30 15 30C23.283 30 30 23.283 30 15C30 6.717 23.283 0 15 0ZM23.5613 18.5511C23.5197 19.468 23.3739 20.094 23.161 20.6419C22.7135 21.7989 21.7989 22.7135 20.6419 23.161C20.0942 23.3739 19.468 23.5194 18.5513 23.5613C17.6328 23.6032 17.3394 23.6133 15.0002 23.6133C12.6608 23.6133 12.3676 23.6032 11.4489 23.5613C10.5322 23.5194 9.90601 23.3739 9.35829 23.161C8.78334 22.9447 8.26286 22.6057 7.83257 22.1674C7.39449 21.7374 7.05551 21.2167 6.83922 20.6419C6.62636 20.0942 6.48056 19.468 6.4389 18.5513C6.39656 17.6326 6.38672 17.3392 6.38672 15C6.38672 12.6608 6.39656 12.3674 6.43867 11.4489C6.48033 10.532 6.6259 9.90601 6.83876 9.35806C7.05505 8.78334 7.39426 8.26263 7.83257 7.83257C8.26263 7.39426 8.78334 7.05528 9.35806 6.83899C9.90601 6.62613 10.532 6.48056 11.4489 6.43867C12.3674 6.39679 12.6608 6.38672 15 6.38672C17.3392 6.38672 17.6326 6.39679 18.5511 6.4389C19.468 6.48056 20.094 6.62613 20.6419 6.83876C21.2167 7.05505 21.7374 7.39426 22.1677 7.83257C22.6057 8.26286 22.9449 8.78334 23.161 9.35806C23.3741 9.90601 23.5197 10.532 23.5616 11.4489C23.6034 12.3674 23.6133 12.6608 23.6133 15C23.6133 17.3392 23.6034 17.6326 23.5613 18.5511V18.5511Z"
									fill="#C7C7C7" />
							</svg>
						</a>
						<a href="">
							<svg class="social-media-c" width="30" height="30" viewBox="0 0 30 30" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<circle cx="15" cy="15" r="15" fill="#C7C7C7" />
								<g clip-path="url(#clip0)">
									<path
										d="M17.9027 22.4467C17.916 22.4427 17.9287 22.4373 17.942 22.4327C26.0853 19.1973 23.8327 7 15 7C10.5673 7 7 10.6133 7 15C7 20.5513 12.6227 24.5127 17.9027 22.4467ZM10.5207 20.3727C11.0887 19.418 12.9267 16.7247 16.064 15.7953C16.72 17.468 17.18 19.4193 17.2253 21.632C14.848 22.4313 12.3407 21.8933 10.5207 20.3727V20.3727ZM18.2087 21.2147C18.1213 19.0887 17.6873 17.2033 17.0687 15.57C18.4567 15.3533 20.0633 15.498 21.8853 16.228C21.498 18.402 20.108 20.2293 18.2087 21.2147V21.2147ZM21.99 15.194C19.9833 14.44 18.2147 14.346 16.684 14.638C16.4473 14.1047 16.1987 13.592 15.9353 13.12C18.284 12.182 19.672 11.0387 20.2933 10.4333C21.39 11.7027 22.0413 13.346 21.99 15.194V15.194ZM19.5833 9.72133C19.018 10.2593 17.6867 11.346 15.41 12.2347C14.294 10.4693 13.1007 9.224 12.3447 8.52667C14.7633 7.53067 17.5527 7.956 19.5833 9.72133V9.72133ZM11.3887 9.01533C11.9593 9.51733 13.212 10.7227 14.4207 12.5867C12.7607 13.1213 10.6793 13.514 8.148 13.5693C8.55067 11.64 9.75333 10.0053 11.3887 9.01533V9.01533ZM8.02133 14.5733C10.8547 14.5273 13.148 14.08 14.9607 13.4747C15.2113 13.914 15.4493 14.3927 15.678 14.89C12.5213 15.8953 10.5487 18.4907 9.79333 19.6627C8.57467 18.3027 7.90267 16.528 8.02133 14.5733V14.5733Z"
										fill="white" />
								</g>
								<defs>
									<clipPath id="clip0">
										<rect width="16" height="16" fill="white" transform="translate(7 7)" />
									</clipPath>
								</defs>
							</svg>
						</a>
					</div>
					<nav class="mx-auto d-flex flex-wrap align-items-center justify-content-center gap-4">
						<a href="" class="footer-link" style="text-decoration: none">Terms of Service</a>
						<span>|</span>
						<a href="" class="footer-link" style="text-decoration: none">Privacy Policy</a>
						<span>|</span>
						<a href="" class="footer-link" style="text-decoration: none">Licenses</a>
					</nav>
					<nav class="d-flex flex-lg-row flex-column align-items-center justify-content-center">
						<p style="margin: 0">Copyright © 2021 Analystic Max</p>
					</nav>
				</div>
			</div>
		</div>
	</section> 
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </body>
  </html>