<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('public/admin/img/favicon.png') }}" rel="icon">
    <title>House For Rent</title>
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
</head>

<body>
    <!-- Navbar -->
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
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('owner-houses') }}">My Houses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('owner-profile') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('owner-contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('logout') }}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <!-- Hero Section -->
    <section class="hero bg-primary-subtle text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-dark">
                    <h1 class="fw-bold mb-4">Rent Your House Here</h1>
                    <p class="lead mb-4">This is the place where you can Rent your houses at your desired price. All
                        your need to do is "Go and post some house adds now on Houses page".</p>
                    <a href="{{ url('owner-houses') }}" class="btn btn-outline-danger">See Your Houses</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Section -->
    {{-- Contents Start --}}
    <div class="container my-5">
        <section>
            <h2><u>Welcome to House For Rent</u></h2>
            <p>At House For Rent, we believe that finding the perfect home should be an exciting and seamless
                experience. We are dedicated to providing exceptional house rental services that go beyond your
                expectations. With our passion for quality and attention to detail, we strive to make your stay
                unforgettable.</p>
        </section>
        <section>
            <h2>Our Story</h2>
            <p>HouseForRent was born out of a deep appreciation for comfortable living spaces and a desire to create a
                positive impact in the rental industry. As avid travelers ourselves, we understand the importance of
                feeling at home wherever you go. Our founder, Chandra Kishore Gupta, experienced the highs and lows of
                searching for the ideal rental property firsthand. This inspired them to establish HouseForRent, a
                platform that simplifies the process and connects renters with their dream homes.</p>
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
    </div>
    {{-- Contents End --}}
    {{-- Footer --}}
    <x-footer />
    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/js/jquery.js') }}"></script>
    <script src="{{ asset('public/js/sweetalert2.js') }}"></script>
    <script>
        $(document).ready(function() {
            let fullname = "{{ Session::get('username') }}";
            let name = fullname.split(' ');
            $(".username").text(name[0]);

            var currentDate = new Date();
            var hour = currentDate.getHours();
            if (hour >= 0 && hour < 12) {
                $(".greeting").text('Good Morning,');
            } else if (hour >= 12 && hour < 17) {
                $(".greeting").text('Good Afternoon,');
            } else if (hour >= 17 && hour < 20) {
                $(".greeting").text('Good Evening,');
            } else if (hour >= 20 || hour < 0) {
                $(".greeting").text('Good Night,');
            }

        });
    </script>
</body>

</html>
