<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('public/admin/img/favicon.png') }}" rel="icon">
    <title>House For Rent|About</title>
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">House For Rent</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('houses') }}">Houses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- About section -->
    <section class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <section>
                    <h1>Welcome to HouseForRent!</h1>
                    <p>At HouseForRent, we believe that finding the perfect home should be an exciting and seamless experience. We are dedicated to providing exceptional house rental services that go beyond your expectations. With our passion for quality and attention to detail, we strive to make your stay unforgettable.</p>
                  </section>
                  
                  <section>
                    <h2>Our Story</h2>
                    <p>HouseForRent was born out of a deep appreciation for comfortable living spaces and a desire to create a positive impact in the rental industry. As avid travelers ourselves, we understand the importance of feeling at home wherever you go. Our founder, Chandra Kishore Gupta, experienced the highs and lows of searching for the ideal rental property firsthand. This inspired them to establish HouseForRent, a platform that simplifies the process and connects renters with their dream homes.</p>
                  </section>
                  
                  <section>
                    <h2>What Sets Us Apart</h2>
                    <p>What truly sets us apart is our unwavering commitment to excellence. We handpick each property in our portfolio, ensuring that it meets our stringent standards for quality, comfort, and style. From cozy apartments to spacious houses, every listing on our platform has been carefully vetted to provide you with the best possible experience.</p>
                    <p>But it doesn't stop there. We understand that a home is more than just four walls; it's about the memories you create within. That's why we go the extra mile to curate properties that offer unique amenities and thoughtful touches, making your stay truly exceptional. Whether it's a breathtaking view, a cozy fireplace, or a well-equipped kitchen, we believe in providing the little details that make a big difference.</p>
                  </section>
                  
                  <section>
                    <h2>Our Values</h2>
                    <p>At HouseForRent, integrity and transparency are the cornerstones of our business. We believe in building trust with our renters through open communication and honest interactions. Our dedicated team is always available to address any questions or concerns you may have, ensuring a smooth and stress-free experience from start to finish. Your satisfaction is our top priority, and we take pride in delivering exceptional customer service that exceeds your expectations.</p>
                  </section>
                  
                  <section>
                    <h2>Join Us</h2>
                    <p>We invite you to embark on an unforgettable journey with HouseForRent. Discover a curated selection of exceptional rental properties, tailored to your unique preferences and needs. Whether you're a digital nomad seeking a temporary haven or a family searching for a long-term residence, we have the perfect home waiting for you.</p>
                    <p>Thank you for choosing HouseForRent. We look forward to helping you find your ideal home and creating lasting memories along the way.</p>
                  </section>
            </div>
            <div class="col-md-6">
                <img src="{{asset('public/img/cp3.jpg')}}" width="600px" height="400px" class="img-fluid rounded" alt="Project image">
            </div>
        </div>
    </section>
    <x-footer />
    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
