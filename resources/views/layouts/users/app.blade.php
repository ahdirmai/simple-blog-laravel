<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Social Blog | @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    {{-- <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script> --}}
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
        rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('user/css/styles.css') }}" rel="stylesheet" />
    @stack('styles')
</head>

<body>
    <!-- Navigation-->
    @include('layouts.users.include.navbar')
    <!-- Page Header-->

    @yield('content')

    <!-- Footer-->
    @include('layouts.users.include.footer')
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('user/js/scripts.js') }}"></script>

    @stack('modal-section')

    <script>
        $(document).ready(function($) {
            $('.modal-basic').on('show.bs.modal',(event) =>{
                var button = $(event.relatedTarget)
                var modal = $(this)
                var title = button.data('title')
                var url = button.data('url')
                modal.find('.modal-basic-title').text(title)
                modal.find('.modal-body-custome').load(url)
            });
        })

        $(document).ready(function($) {
            $('.modal-delete').on('show.bs.modal',(event) =>{
                // console.log(button);
                var button = $(event.relatedTarget)
                var modal = $(this)
                var title = button.data('title')
                var message = button.data('message')
                var url = button.data('url')
                console.log(url);
                modal.find('.modal-basic-title').text(title)
                modal.find('.modal-body-custome').html("<p class='text-center'>"+ message+"</p>")
                modal.find('#form-modal-delete').attr('action',url)
            });
        })
    </script>

    @stack('scripts')
</body>

</html>