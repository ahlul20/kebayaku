@php
    $wa = '6281916008978';

    $koleksi = [
        ['nama' => 'Kebaya Wisuda Elegan',     'kategori' => 'Wisuda',      'gambar' => 'kebaya_wisuda.png',      'ukuran' => 'S, M, L',     'warna' => 'Dusty Pink', 'harga' => 150000],
        ['nama' => 'Kebaya Akad Putih Gading', 'kategori' => 'Pernikahan',  'gambar' => 'kebaya_pernikahan.png',  'ukuran' => 'M, L, XL',    'warna' => 'Putih',      'harga' => 350000],
        ['nama' => 'Kebaya Kutubaru Klasik',   'kategori' => 'Tradisional', 'gambar' => 'kebaya_tradisional.png', 'ukuran' => 'S, M, L, XL', 'warna' => 'Merah Bata', 'harga' => 175000],
        ['nama' => 'Kebaya Brokat Modern',     'kategori' => 'Modern',      'gambar' => 'kebaya_modern.png',      'ukuran' => 'S, M, L',     'warna' => 'Sage Green', 'harga' => 200000],
    ];

    $kategori = [
        ['nama' => 'Wisuda',      'icon' => 'fa-graduation-cap',    'desc' => 'Anggun di hari kelulusan'],
        ['nama' => 'Pernikahan',  'icon' => 'fa-ring',              'desc' => 'Untuk akad & resepsi'],
        ['nama' => 'Lamaran',     'icon' => 'fa-heart',             'desc' => 'Momen manis tunangan'],
        ['nama' => 'Kondangan',   'icon' => 'fa-champagne-glasses', 'desc' => 'Tampil memukau di pesta'],
        ['nama' => 'Tradisional', 'icon' => 'fa-feather-pointed',   'desc' => 'Kutubaru, Kartini & lainnya'],
        ['nama' => 'Modern',      'icon' => 'fa-gem',               'desc' => 'Brokat & potongan kekinian'],
    ];

    $langkah = [
        ['icon' => 'fa-magnifying-glass', 'judul' => 'Pilih Kebaya',  'desc' => 'Jelajahi koleksi dan temukan kebaya sesuai acara, ukuran, dan warna favoritmu.'],
        ['icon' => 'fa-calendar-check',   'judul' => 'Tentukan Tanggal', 'desc' => 'Hubungi kami via WhatsApp untuk cek ketersediaan dan tanggal sewa.'],
        ['icon' => 'fa-wallet',           'judul' => 'Bayar & Konfirmasi', 'desc' => 'Lakukan pembayaran sewa dan deposit, pesananmu langsung kami siapkan.'],
        ['icon' => 'fa-box-open',         'judul' => 'Terima & Tampil', 'desc' => 'Kebaya dikirim bersih dan rapi. Setelah acara, cukup kembalikan.'],
    ];
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Kebaya — Kebaya Elegan untuk Wisuda, Pernikahan & Lamaran</title>
    <meta name="description" content="Sewa kebaya elegan untuk wisuda, pernikahan, lamaran, dan acara spesial lainnya. Koleksi modern & tradisional, bersih, rapi, dan harga terjangkau.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>

{{-- ================= NAVBAR ================= --}}
<header class="navbar" id="navbar">
    <div class="container nav-inner">
        <a href="#beranda" class="brand" id="nav-brand">
            <span class="brand-mark">K</span>
            <span class="brand-text">Sewa Kebaya<small>BOUTIQUE</small></span>
        </a>

        <nav>
            <ul class="nav-links" id="nav-links">
                <li><a href="#beranda" class="active">Home</a></li>
                <li><a href="#koleksi">Koleksi</a></li>
                <li><a href="#kategori">Kategori</a></li>
                <li><a href="#cara-sewa">Cara Sewa</a></li>
                <li><a href="#tentang">Tentang Kami</a></li>
            </ul>
        </nav>

        <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener" class="btn btn-primary btn-sm nav-cta" id="nav-cta">
            <i class="fa-brands fa-whatsapp"></i> Hubungi Kami
        </a>
        <button class="nav-toggle" id="nav-toggle" aria-label="Buka menu"><i class="fa-solid fa-bars"></i></button>
    </div>
</header>

<main>
    {{-- ================= HERO ================= --}}
    <section class="hero" id="beranda">
        <div class="container hero-grid">
            <div class="hero-text">
                <span class="eyebrow reveal">Koleksi Kebaya 2026</span>
                <h1 class="reveal" data-delay="1">Sewa Kebaya untuk <em>Momen Spesialmu</em></h1>
                <p class="hero-lead reveal" data-delay="2">
                    Temukan berbagai koleksi kebaya elegan untuk wisuda, pernikahan,
                    lamaran, dan acara spesial lainnya — tampil memukau tanpa harus membeli.
                </p>
                <div class="hero-actions reveal" data-delay="3">
                    <a href="#koleksi" class="btn btn-primary" id="hero-koleksi">Lihat Koleksi <i class="fa-solid fa-arrow-right"></i></a>
                    <a href="#cara-sewa" class="btn btn-ghost" id="hero-cara">Cara Sewa</a>
                </div>
                <div class="hero-stats reveal" data-delay="4">
                    <div><strong>120+</strong><span>Koleksi Kebaya</span></div>
                    <div><strong>2.500+</strong><span>Pelanggan Puas</span></div>
                    <div><strong>4.9★</strong><span>Rating Ulasan</span></div>
                </div>
            </div>

            <div class="hero-visual reveal" data-delay="2">
                <div class="hero-ring"></div>
                <div class="hero-frame">
                    <img src="{{ asset('images/kebaya/kebaya_modern.png') }}" alt="Model mengenakan kebaya brokat modern" fetchpriority="high">
                </div>
                <div class="float-card one">
                    <span class="ic"><i class="fa-solid fa-tag"></i></span>
                    <div><strong>Mulai Rp150rb</strong><span>untuk sewa 3 hari</span></div>
                </div>
                <div class="float-card two">
                    <span class="ic"><i class="fa-solid fa-wand-magic-sparkles"></i></span>
                    <div><strong>Selalu Bersih</strong><span>Dry clean tiap sewa</span></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= KOLEKSI KEBAYA ================= --}}
    <section class="section koleksi" id="koleksi">
        <div class="container">
            <div class="section-head reveal">
                <span class="eyebrow">Koleksi Kebaya</span>
                <h2>Pilihan Terfavorit Bulan Ini</h2>
                <p>Kebaya pilihan yang paling sering disewa pelanggan kami untuk berbagai acara istimewa.</p>
            </div>

            <div class="koleksi-grid">
                @foreach ($koleksi as $i => $item)
                    <article class="product reveal" data-delay="{{ $i + 1 }}">
                        <div class="product-media">
                            <img src="{{ asset('images/kebaya/' . $item['gambar']) }}" alt="{{ $item['nama'] }}" loading="lazy">
                            <span class="product-tag">{{ $item['kategori'] }}</span>
                            <button class="product-wish" aria-label="Simpan {{ $item['nama'] }}"><i class="fa-regular fa-heart"></i></button>
                            <div class="product-quick">
                                <a href="https://wa.me/{{ $wa }}?text={{ urlencode('Halo, saya ingin menyewa ' . $item['nama']) }}"
                                   target="_blank" rel="noopener" class="btn btn-gold btn-sm" id="sewa-{{ $i + 1 }}">
                                    Sewa Sekarang <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-body">
                            <h3>{{ $item['nama'] }}</h3>
                            <div class="product-meta">
                                <span><i class="fa-solid fa-ruler"></i>{{ $item['ukuran'] }}</span>
                                <span><i class="fa-solid fa-palette"></i>{{ $item['warna'] }}</span>
                            </div>
                            <div class="product-price">
                                <strong>Rp{{ number_format($item['harga'], 0, ',', '.') }}</strong>
                                <span>/ 3 hari</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="koleksi-more reveal">
                <a href="https://wa.me/{{ $wa }}?text={{ urlencode('Halo, saya ingin melihat katalog lengkap kebaya') }}" target="_blank" rel="noopener" class="btn btn-ghost" id="koleksi-semua">
                    Lihat Semua Koleksi <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ================= KATEGORI ================= --}}
    <section class="section kategori" id="kategori">
        <div class="container">
            <div class="section-head reveal">
                <span class="eyebrow">Kategori</span>
                <h2>Kebaya untuk Setiap Acara</h2>
                <p>Pilih kategori sesuai kebutuhanmu, dari acara formal hingga pesta santai.</p>
            </div>

            <div class="kategori-grid">
                @foreach ($kategori as $i => $kat)
                    <a href="#koleksi" class="kat-card reveal" data-delay="{{ ($i % 3) + 1 }}" id="kategori-{{ \Illuminate\Support\Str::slug($kat['nama']) }}">
                        <span class="kat-icon"><i class="fa-solid {{ $kat['icon'] }}"></i></span>
                        <div>
                            <h3>{{ $kat['nama'] }}</h3>
                            <p>{{ $kat['desc'] }}</p>
                        </div>
                        <i class="fa-solid fa-arrow-right kat-arrow"></i>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= CARA SEWA ================= --}}
    <section class="section cara" id="cara-sewa">
        <div class="container">
            <div class="section-head reveal">
                <span class="eyebrow">Cara Sewa</span>
                <h2>4 Langkah Mudah Menyewa</h2>
                <p>Proses sewa yang simpel dan cepat, tampil cantik tanpa ribet.</p>
            </div>

            <div class="steps">
                @foreach ($langkah as $i => $step)
                    <div class="step reveal" data-delay="{{ $i + 1 }}">
                        <div class="step-num">
                            <i class="fa-solid {{ $step['icon'] }}"></i>
                            <b>{{ $i + 1 }}</b>
                        </div>
                        <h3>{{ $step['judul'] }}</h3>
                        <p>{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= TENTANG KAMI ================= --}}
    <section class="section tentang" id="tentang">
        <div class="container tentang-grid">
            <div class="tentang-visual reveal">
                <img src="{{ asset('images/kebaya/kebaya_tradisional.png') }}" alt="Koleksi kebaya tradisional" loading="lazy">
                <img src="{{ asset('images/kebaya/kebaya_pernikahan.png') }}" alt="Koleksi kebaya pernikahan" loading="lazy">
                <div class="tentang-badge">
                    <strong>5+</strong>
                    <span>Tahun Pengalaman</span>
                </div>
            </div>

            <div class="tentang-text">
                <span class="eyebrow reveal">Tentang Kami</span>
                <h2 class="reveal" data-delay="1">Butik Sewa Kebaya yang Mengutamakan Keanggunanmu</h2>
                <p class="reveal" data-delay="2">
                    Kami hadir agar setiap perempuan bisa tampil anggun di momen terpentingnya tanpa harus
                    membeli kebaya mahal. Setiap koleksi kami pilih dengan teliti, dirawat dengan baik,
                    dan selalu siap pakai.
                </p>

                <div class="features">
                    <div class="feature reveal" data-delay="2">
                        <span class="ic"><i class="fa-solid fa-shirt"></i></span>
                        <div><h4>Kualitas Premium</h4><p>Bahan pilihan dengan jahitan rapi dan detail yang cantik.</p></div>
                    </div>
                    <div class="feature reveal" data-delay="3">
                        <span class="ic"><i class="fa-solid fa-soap"></i></span>
                        <div><h4>Higienis & Wangi</h4><p>Dicuci dan disetrika profesional setelah setiap penyewaan.</p></div>
                    </div>
                    <div class="feature reveal" data-delay="4">
                        <span class="ic"><i class="fa-solid fa-hand-holding-heart"></i></span>
                        <div><h4>Harga Bersahabat</h4><p>Tampil maksimal dengan biaya sewa yang terjangkau.</p></div>
                    </div>
                </div>

                <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener" class="btn btn-primary reveal" id="tentang-cta">
                    <i class="fa-brands fa-whatsapp"></i> Konsultasi Gratis
                </a>
            </div>
        </div>
    </section>
</main>

{{-- ================= FOOTER ================= --}}
<footer class="footer" id="kontak">
    <div class="container">
        <div class="footer-cta reveal">
            <div>
                <h3>Siap tampil memukau?</h3>
                <p>Cek ketersediaan kebaya favoritmu sekarang juga.</p>
            </div>
            <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener" class="btn btn-gold" id="footer-cta">
                <i class="fa-brands fa-whatsapp"></i> Chat via WhatsApp
            </a>
        </div>

        <div class="footer-grid">
            <div>
                <a href="#beranda" class="brand">
                    <span class="brand-mark">K</span>
                    <span class="brand-text">Sewa Kebaya<small>BOUTIQUE</small></span>
                </a>
                <p class="footer-about">Butik penyewaan kebaya modern dan tradisional untuk wisuda, pernikahan, lamaran, dan berbagai acara spesial.</p>
                <div class="socials">
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://wa.me/{{ $wa }}" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>

            <div>
                <h4>Menu</h4>
                <ul class="footer-links">
                    <li><a href="#beranda">Home</a></li>
                    <li><a href="#koleksi">Koleksi</a></li>
                    <li><a href="#kategori">Kategori</a></li>
                    <li><a href="#cara-sewa">Cara Sewa</a></li>
                    <li><a href="#tentang">Tentang Kami</a></li>
                </ul>
            </div>

            <div>
                <h4>Kategori</h4>
                <ul class="footer-links">
                    @foreach (array_slice($kategori, 0, 5) as $kat)
                        <li><a href="#kategori">{{ $kat['nama'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4>Kontak</h4>
                <ul class="footer-contact">
                    <li><i class="fa-solid fa-location-dot"></i><span>Jl. Kebaya Elok No. 45, Jakarta Selatan</span></li>
                    <li><i class="fa-solid fa-phone"></i><span>+62 819-1600-8978</span></li>
                    <li><i class="fa-solid fa-envelope"></i><span>info@sewakebaya.com</span></li>
                    <li><i class="fa-solid fa-clock"></i><span>Senin – Sabtu, 09.00 – 20.00</span></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Sewa Kebaya Boutique. Hak cipta dilindungi.</p>
            <p>Dibuat dengan <i class="fa-solid fa-heart" style="color: var(--gold);"></i> di Indonesia</p>
        </div>
    </div>
</footer>

<a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener" class="wa-float" id="wa-float" aria-label="Chat WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<script>
    // Navbar: background saat scroll
    const navbar = document.getElementById('navbar');
    const onScroll = () => navbar.classList.toggle('scrolled', window.scrollY > 30);
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // Menu mobile
    const toggle = document.getElementById('nav-toggle');
    const links = document.getElementById('nav-links');
    toggle.addEventListener('click', () => {
        const open = links.classList.toggle('open');
        toggle.innerHTML = open ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-bars"></i>';
    });
    links.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
        links.classList.remove('open');
        toggle.innerHTML = '<i class="fa-solid fa-bars"></i>';
    }));

    // Animasi muncul saat scroll
    const revealObs = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('in'); revealObs.unobserve(e.target); }
        });
    }, { threshold: 0.15 });
    document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));

    // Highlight menu sesuai section aktif
    const navAnchors = [...links.querySelectorAll('a')];
    const spyObs = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                navAnchors.forEach(a => a.classList.toggle('active', a.getAttribute('href') === '#' + e.target.id));
            }
        });
    }, { rootMargin: '-45% 0px -50% 0px' });
    document.querySelectorAll('main section[id]').forEach(s => spyObs.observe(s));

    // Tombol favorit
    document.querySelectorAll('.product-wish').forEach(btn => btn.addEventListener('click', () => {
        btn.classList.toggle('on');
        btn.querySelector('i').className = btn.classList.contains('on') ? 'fa-solid fa-heart' : 'fa-regular fa-heart';
    }));
</script>
</body>
</html>