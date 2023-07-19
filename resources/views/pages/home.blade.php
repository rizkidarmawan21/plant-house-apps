@extends('layouts.app')

@section('title')
Store Homepage
@endsection
@section('content')
<div class="page-content page-home">
      <section class="hero">
        <div class="container col-xxl-8 px-4 py-5">
          <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
              <img
                src="images/gmbr sayur.png"
                class="d-block mx-lg-auto img-fluid"
                alt="Bootstrap Themes"
                width="700"
                height="500"
                loading="lazy"
              />
            </div>
            <div class="col-lg-6">
              <h5 class="lh-1 mb-3">Selamat Datang di Argha Hidroponik</h5>
              <h1 class="display-5 fw-bold lh-1 mb-3">
                Pilih Sayuran Favorit Anda
              </h1>
              <p class="lead">
                Rasakan hidup sehat dengan makan sayuran. itu akan meningkatkan
                ruang hidup Anda!
              </p>
              <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <button type="button" class="btn btn-hero btn-md px-4 me-md-2">
                  Klik ke Troli
                </button>
                <button type="button" class="btn btn-hero btn-md px-4 me-md-2">
                  Tentang Kami
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- <section class="store-carousel">
        <div class="row">
          <div class="col-lg-12" data-aos="zoom-in">
            <div id="storeCarousel" class="carousel slide" data-bs-ride="true">
              <div class="carousel-indicators">
                <button
                  type="button"
                  data-bs-target="#storeCarousel"
                  data-bs-slide-to="0"
                  class="active"
                  aria-current="true"
                  aria-label="Slide 1"
                ></button>
                <button
                  type="button"
                  data-bs-target="#storeCarousel"
                  data-bs-slide-to="1"
                  aria-label="Slide 2"
                ></button>
                <button
                  type="button"
                  data-bs-target="#storeCarousel"
                  data-bs-slide-to="2"
                  aria-label="Slide 3"
                ></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img
                    src="/images/chicago.jpg"
                    class="d-block w-100"
                    alt="..."
                  />
                </div>
                <div class="carousel-item">
                  <img src="/images/la.jpg" class="d-block w-100" alt="..." />
                </div>
                <div class="carousel-item">
                  <img src="/images/ny.jpg" class="d-block w-100" alt="..." />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> -->

      <!-- Trend Kategories -->

      <!-- <section class="store-trend-categories">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5>Trend Categories</h5>
            </div>
          </div>
          <div class="row justify-content-center">
            <div
              class="col-6 col-md-3 col-lg-2"
              data-aos="fade-up"
              data-aos-delay="100"
            >
              <a href="#" class="component-categories">
                <div class="categories-image">
                  <img src="/images/perlengkapan.svg" alt="" class="w-75" />
                </div>
                <p class="categories-text">Perlengkapan</p>
              </a>
            </div>
            <div
              class="col-6 col-md-3 col-lg-2"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <a href="#" class="component-categories">
                <div class="categories-image">
                  <img src="/images/sayuran.svg" alt="" class="w-100" />
                </div>
                <p class="categories-text">Sayuran</p>
              </a>
            </div>
            <div
              class="col-6 col-md-3 col-lg-2"
              data-aos="fade-up"
              data-aos-delay="300"
            >
              <a href="#" class="component-categories">
                <div class="categories-image">
                  <img src="/images/vitamin.svg" alt="" class="w-100" />
                </div>
                <p class="categories-text">Vitamin</p>
              </a>
            </div>
          </div>
        </div>
      </section> -->

      <!-- consultant -->

      <section class="store-consultant">
        <div class="container">
          <div class="container mt-5 set-height">
            <div class="row justify-content-center align-items-stretch">
              <div class="col-6 col-md-3 col-lg-3 p-md-0 mb-5">
                <div class="card card-consultant">
                  <div class="card-body d-flex flex-column">
                    <h5 class="card-title card-title-consultant">
                      ARGHA HIDROPONIK CONSULTATION
                    </h5>
                    <p class="card-text card-text-consultant">
                      Consult anything you want to ask us. We're glad you asked,
                    </p>
                    <a href="#" class="">Read More ></a>
                  </div>
                </div>
              </div>

              <div class="col-6 col-md-4 col-lg-3 p-md-0 mb-5">
                <div class="card card-consultant">
                  <img
                    src="/images/img-consultant.jpg"
                    class="card-img-top"
                    alt="..."
                  />
                  <div
                    class="card-img-overlay d-flex flex-column justify-content-end"
                  >
                    <h5 class="card-title text-white card-title-consultant">
                      ARGHA HIDROPONIK CONSULTATION >
                    </h5>
                  </div>
                </div>
              </div>

              <div class="col-6 col-md-3 col-lg-3 p-md-0 mb-5">
                <div class="card card-consultant">
                  <div class="card-body d-flex flex-column">
                    <h5 class="card-title card-title-consultant">
                      ARGHA HIDROPONIK CONSULTATION
                    </h5>
                    <p class="card-text card-text-consultant">
                      Consult anything you want to ask us. We're glad you asked,
                    </p>
                    <a href="#" class="">Read More ></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- argha hidroponik profile -->

      <section class="argha-profile">
        <div class="container pt-lg-5">
          <div class="row justify-content-center">
            <div class="col-sm-12 col-md-5 col-lg-4 p-4">
              <img
                src="images/foto-profile.jpg"
                alt="profile picture argha hidroponik"
                class="img-fluid img-profile"
              />
            </div>
            <div class="col col-md-6 col-lg-7 p-4">
              <h5 class="">
                NOT ONLY VEGETABLES! We Also Provide Planting Media For Tose of
                You Who Want to Learn Hydroponics
              </h5>
              <p>
                For those of you who want to learn hydroponic cultivation, Argha
                Hydroponics provides a complete beginner hydroponic package. The
                media and tools can also be purchased individually.
              </p>
              <p>
                For those of you who want to learn hydroponic cultivation, Argha
                Hydroponics provides a complete beginner hydroponic package.
              </p>
              <div class="row">
                <div class="col col-6">
                  <ul class="list-unstyled">
                    <li>
                      <i
                        class="fa-solid fa-circle-check"
                        style="color: #185350"
                      ></i>
                      aaskjdkasjsd
                    </li>
                    <li>
                      <i
                        class="fa-solid fa-circle-check"
                        style="color: #185350"
                      ></i>
                      aaskjdkasjsd
                    </li>
                    <li>
                      <i
                        class="fa-solid fa-circle-check"
                        style="color: #185350"
                      ></i>
                      aaskjdkasjsd
                    </li>
                  </ul>
                </div>
                <div class="col col-6">
                  <ul class="list-unstyled">
                    <li>
                      <i
                        class="fa-solid fa-circle-check"
                        style="color: #185350"
                      ></i>
                      aaskjdkasjsd
                    </li>
                    <li>
                      <i
                        class="fa-solid fa-circle-check"
                        style="color: #185350"
                      ></i>
                      aaskjdkasjsd
                    </li>
                    <li>
                      <i
                        class="fa-solid fa-circle-check"
                        style="color: #185350"
                      ></i>
                      aaskjdkasjsd
                    </li>
                  </ul>
                </div>
              </div>
              <div class="row experience">
                <div class="col">
                  <h3>5Y</h3>
                  <p>Experience</p>
                </div>
                <div class="col">
                  <h3>25+</h3>
                  <p>Best Product</p>
                </div>
                <div class="col">
                  <h3>400+</h3>
                  <p>Client</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- new product -->

      <section class="store-new-product">
        <div class="container">
          <div class="row">
            <div
              class="col-12 title-new-product"
              data-aos="fade-up"
              data-aos-delay="100"
            >
              <h5>Best Seller</h5>
              <h2>ARGHA HIDROPONIK</h2>
            </div>
          </div>
          <div class="row justify-content-evenly">
            <div
              class="col-5 col-md-3 col-lg-3"
              data-aos="fade-up"
              data-aos-delay="100"
            >
              <a href="/details.html" class="component-product d-block">
                <div class="product-tumbnail">
                  <div
                    class="product-image"
                    style="background-image: url('/images/sawi-hijau.jpg')"
                  ></div>
                </div>
                <div class="product-text">Sayur Hijau</div>
                <div class="product-price">$10</div>
              </a>
            </div>
            <div
              class="col-5 col-md-3 col-lg-3"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <a href="/details.html" class="component-product d-block">
                <div class="product-tumbnail">
                  <div
                    class="product-image"
                    style="background-image: url('/images/pic.jpg')"
                  ></div>
                </div>
                <div class="product-text">Sayur Hijau</div>
                <div class="product-price">$10</div>
              </a>
            </div>
            <div
              class="col-5 col-md-3 col-lg-3"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <a href="/details.html" class="component-product d-block">
                <div class="product-tumbnail">
                  <div
                    class="product-image"
                    style="background-image: url('/images/sawi-hijau.jpg')"
                  ></div>
                </div>
                <div class="product-text">Sayur Hijau</div>
                <div class="product-price">$10</div>
              </a>
            </div>
          </div>
        </div>
      </section>

      <!-- about -->

      <section class="about">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <iframe
                src="https://www.youtube.com/embed/tgbNymZ7vqY?autoplay=1&mute=1"
              >
              </iframe>
            </div>
            <div class="col">
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat
                vitae laborum similique error alias in iusto aut suscipit
                dolorum dicta enim non, incidunt et quia, tenetur maxime cum
                ipsum minima!
              </p>
            </div>
            <div class="col">
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor
                atque laborum deserunt odio commodi, nihil necessitatibus ea
                itaque dolorum pariatur fugiat, culpa quidem architecto minima
                non amet voluptatibus unde minus?
              </p>
              <div class="d-flex justify-content-end">
                <a href="#" class="btn more-button"
                  >MORE ABOUT US <span> > </span></a
                >
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- monitoring -->
      <section class="monitoring">
        <div class="container">
          <h5 class="Pemantauan">Pemantauan Tanaman</h5>
          <div class="row">
            <div class="col-md-4">
              <h5 class="border-bottom">Kapasitas Nutrisi</h5>
              <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col-6">
                  <div class="border p-2">
                    <h6>Nutrisi A</h6>
                    <h3>17 <span>Liter</span></h3>
                  </div>
                </div>
                <div class="col-6">
                  <div class="border p-2 mb-4">
                    <h6>Nutrisi B</h6>
                    <h3>17 <span>Liter</span></h3>
                  </div>
                </div>
              </div>
              <h5 class="border-bottom">Kapasitas Air</h5>
              <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col-6">
                  <div class="border p-2">
                    <h6>Water</h6>
                    <h3>17 <span>Liter</span></h3>
                  </div>
                </div>
                <div class="col-6">
                  <div class="border p-2 mb-4">
                    <h6>Mix</h6>
                    <h3>17 <span>Liter</span></h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 align-self-center">
              <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col-6">
                  <div class="border p-2">
                    <h6>PH Air</h6>
                    <h3>17 <span>Liter</span></h3>
                  </div>
                </div>
                <div class="col-6">
                  <div class="border p-2">
                    <h6>TDS</h6>
                    <h3>17 <span>Liter</span></h3>
                  </div>
                </div>
              </div>
              <div class="mt-5">
                <div class="d-flex mb-3 border-bottom">
                  <div class="me-auto pe-2">Suhu</div>
                  <div class="pe-2">25</div>
                  <div class="pe-2">°C</div>
                </div>
                <div class="d-flex mb-3 border-bottom">
                  <div class="me-auto pe-2">Light</div>
                  <div class="pe-2">25</div>
                  <div class="pe-2">Lux</div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="d-flex justify-content-center">
                <div class="card-text d-flex flex-column align-items-center">
                  <span class="text-muted">Jam</span>
                  <span id="hour" class="border">21</span>
                </div>
                <span class="mx-2 mt-3 d-flex align-items-center colon">:</span>
                <div class="card-text d-flex flex-column align-items-center">
                  <span class="text-muted">Menit</span>
                  <span id="minute" class="border">38</span>
                </div>
                <span class="mx-2 mt-3 d-flex align-items-center colon">:</span>
                <div class="card-text d-flex flex-column align-items-center">
                  <span class="text-muted">Detik</span>
                  <span id="second" class="border">52</span>
                </div>
              </div>
              <div class="d-flex justify-content-center">
                <div class="condition mt-4">
                  Condition Plants Monitoring
                  <p class="text-center">PLANT NUTRITION IS AFFECTED</p>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-5 pemasaran">
            <h5 class="text-center mt-4">Pemasaran</h5>
            <div class="col-6 col-md-3 mt-3">
              <p>Tokopedia :</p>
              <p>Argha Hidroponik</p>
            </div>
            <div class="col-6 col-md-3 mt-3">
              <p>Shopee :</p>
              <p>Argha Hidroponik</p>
            </div>
            <div class="col-6 col-md-3 mt-3">
              <p>Bukalapak :</p>
              <p>Argha Hidroponik</p>
            </div>
            <div class="col-6 col-md-3 mt-3">
              <p>lazada :</p>
              <p>Argha Hidroponik</p>
            </div>
          </div>
        </div>
      </section>

      <!-- controlling pages -->

      <section class="controlling">
        <div class="container">
          <div class="d-flex">
            <div class="p-2 w-100">
              <h5>
                PASTIKAN TANAMAN HIDROPONIKMU DAPAT TUMBUH SEHAT <br />
                DENGAN MEMASTIKAN NUTRISINYA TERCUKUPI !
              </h5>
            </div>
            <div class="p-2 flex-shrink-1">
              <button class="btn btn-success">Home</button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-7 col-sm-12">
              <div class="row">
                <div class="d-flex justify-content-start">
                  <div class="card-text d-flex flex-column align-items-center">
                    <span class="text-muted">Jam</span>
                    <span id="hour" class="border">21</span>
                  </div>
                  <span class="mx-2 mt-3 d-flex align-items-center colon"
                    >:</span
                  >
                  <div class="card-text d-flex flex-column align-items-center">
                    <span class="text-muted">Menit</span>
                    <span id="minute" class="border">38</span>
                  </div>
                  <span class="mx-2 mt-3 d-flex align-items-center colon"
                    >:</span
                  >
                  <div class="card-text d-flex flex-column align-items-center">
                    <span class="text-muted">Detik</span>
                    <span id="second" class="border">52</span>
                  </div>
                </div>
                <div>
                  <h5 class="underlined-controlling">Pemantauan tanaman</h5>
                </div>
              </div>

              <div class="">
                <h5 class="mb-4 underlined-controlling w-75">Kapasitas</h5>
              </div>
              <div class="row capacity">
                <div class="col-md-11 col-lg-8">
                  <div class="row row-cols-3">
                    <div class="col-sm-4 mb-4">
                      <div class="border p-2">
                        <h6>Nutrisi B</h6>
                        <h3>17 <span>Liter</span></h3>
                      </div>
                    </div>
                    <div class="col-sm-4 mb-4">
                      <div class="border p-2">
                        <h6>Nutrisi B</h6>
                        <h3>17 <span>Liter</span></h3>
                      </div>
                    </div>
                    <div class="col-sm-4 mb-4">
                      <div class="border p-2">
                        <h6>Nutrisi B</h6>
                        <h3>17 <span>Liter</span></h3>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-5 col-lg-4">
                  <div class="border p-2 mb-4">
                    <h6>VItamin A</h6>
                    <h3>17 <span>Liter</span></h3>
                  </div>
                </div>
              </div>
              <div class="">
                <h5 class="mb-4 underlined-controlling w-50">
                  Kapasitas Tangki
                </h5>
              </div>

              <div class="row row-cols-2 capacity">
                <div class="col-6 col-md-4">
                  <div class="border p-2">
                    <h6>Nutrisi B</h6>
                    <h3>17 <span>Liter</span></h3>
                  </div>
                </div>
                <div class="col-6 col-md-4">
                  <div class="border p-2">
                    <h6>Nutrisi B</h6>
                    <h3>17 <span>Liter</span></h3>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-5 col-sm-12 plant-control">
              <h5 class="underlined-controlling">kontrol tanaman</h5>

              <div class="border-control rounded-4 p-4">
                <div class="d-flex control-panel rounded-3">
                  <div class="col-9 p-2 gap-3 disp-plant-control rounded-end-3">
                    <div class="d-flex align-items-center gap-2">
                      <p class="mb-0 text-white fw-semibold">TDS</p>
                      <!-- <span class="set-value-tds">Set Value : 560 PPM</span> -->
                      <p class="set-value-tds mb-0">
                        Set Value : <span>560</span> PPM
                      </p>
                    </div>
                    <p class="set-value-disp mb-0 fw-semibold">
                      560 <span>PPM</span>
                    </p>
                  </div>
                  <div
                    class="col-3 d-flex justify-content-center align-items-center rounded-end-3 p-2"
                  >
                    <div>
                      <div class="up">
                        <span>Up</span>
                        <i class="fas fa-caret-up fa-2x"></i>
                      </div>
                      <div class="down">
                        <i class="fas fa-caret-down fa-2x"></i>
                        <span>Down</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="ket-set-value">
                <h5 class="underlined-controlling mt-3">Set Value</h5>
                <h5 class="">Value TDS dapat disetting sesuai keinginan !</h5>
                <ul class="p-0 ms-3">
                  <li>Tekan tombol Up untuk menaikkan Set Nilai TDS</li>
                  <li>Tekan tombol Down untuk menurunkan Set Nilai TDS</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="container">
              <div class="plant-info rounded-4">
                <h5 class=" ">Kondisi Pemantauan Tanaman</h5>
                <h5 class="bg-white p-4 rounded-4">
                  NUTRISI TANAMAN TERCUKUPI
                </h5>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
@endsection
