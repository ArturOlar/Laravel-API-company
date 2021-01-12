<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

            <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Главная</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Авторизация</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                        </li>
                    @endif

                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('information') }}"><b>Важная информация!</b></a>
                        </li>
                </ul>
            </div>
            <ul class="nav navbar-nav">
                @auth
                @if(Auth::user()->is_admin == 0)
                    <div class="d-flex">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('api') }}"><b>API</b></a>
                        </li>
                    </div>
                @elseif(Auth::user()->is_admin == 1)
                    <div class="collapse navbar-collapse col-md-5">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('company.create') }}"><b>Создать компанию</b></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('company.index') }}"><b>Редактировать / удалить
                                    компаниями</b></a>
                        </li>
                    </div>
                @endif
                @endauth
            </ul>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

{{-- связанные списки при создании компании --}}
<script>
    $(function () {
        $('#district').change(function () {

            var id_district = $('#district').val();

            $.ajax({
                type: 'POST',
                url: '{{ route('get-village-by-district') }}',
                data: {id_district: id_district},
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

                success: function (data) {
                    var villages = JSON.parse(data);

                    // удаляем option которые уже есть в select
                    $('#villages').empty();

                    if (villages.length != 0) {
                        $('#villages').append('<label>Поселек</label>');
                        $('#villages').append('<select name="id_village" id="option_village" class="form-control">');

                        // заполняем option в select
                        $.each(villages, function (key, value) {
                            $('#option_village').append('<option value="' + value['id'] + '">' + value['village'] + '</option>');
                        });

                        $('#villages').append('</select>');
                    }
                }
            });
        });
    });
</script>

{{-- связанные списки при редактировании компании --}}
<script>
    $(document).ready(function () {
        downloadVillage();
    });

    $('#edit-district').change(function () {
        downloadVillage();
    });

    function downloadVillage() {
        var id_district = $('#edit-district').val();
        var id_village = $('#edit_id_village').val();

        $.ajax({
            type: 'POST',
            url: '{{ route('get-village-by-district') }}',
            data: {id_district: id_district},
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

            success: function (data) {
                var villages = JSON.parse(data);

                // удаляем option которые уже есть в select
                $('#edit-villages').empty();

                if (villages.length != 0) {
                    $('#edit-villages').append('<label>Поселек</label>');
                    $('#edit-villages').append('<select name="id_village" id="edit-option_village" class="form-control">');

                    // заполняем option в select
                    $.each(villages, function (key, value) {
                        if (id_village == value['id']) {
                            $('#edit-option_village').append('<option value="' + value['id'] + '" selected>' + value['village'] + '</option>');
                        } else {
                            $('#edit-option_village').append('<option value="' + value['id'] + '">' + value['village'] + '</option>');
                        }
                    });

                    $('#edit-villages').append('</select>');

                } else {
                    // заполняем village null, если выбрано город черновцы
                    $('#edit-villages').append('<label class="d-none">Поселек</label>');
                    $('#edit-villages').append('<select name="id_village" id="edit-option_village" class="form-control d-none">');
                    $('#edit-option_village').append('<option value=""></option>');
                    $('#edit-villages').append('</select>');
                }
            }
        });
    }
</script>
</body>
</html>
