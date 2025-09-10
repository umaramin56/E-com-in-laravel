<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Comm Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

</head>

<body>
    {{ View::make('header')}}

    @yield('content')
    {{ View::make('footer')}}
    <style>
    .custom-login {
        height: 500px;
        padding-top: 100px;
    }

    .custom-product {
        height: 500px;
    }

    /* Carousel Image Style */
    .carousel-item img {
        height: 450px;
        /* Fixed height */
        object-fit: cover;
        /* Crop image beautifully */
        object-position: center;
        /* Center focus */
        border-radius: 12px;
        /* Rounded corners */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        /* Shadow for beauty */
    }

    /* Caption Style */
    .carousel-caption {
        bottom: 30%;
        /* Move text little up */
    }

    .carousel-caption h3 {
        font-size: 2rem;
        font-weight: bold;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
    }

    .carousel-caption p {
        font-size: 1.1rem;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6);
    }

    /* Controls style */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: invert(100%);
    }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

</body>

</html>