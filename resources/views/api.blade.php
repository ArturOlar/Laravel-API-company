@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="my-5">
            <p>Что-бы использовать API, вам нужно получить токен</p>
            <p>Что-бы получить токен, вам нужно на этот адресс, методом POST <a href="#">http://company/public/api/login</a> передать ваш: email и password, которые вы указывали при регистрации</p>
        </div>
        <div class="my-5">
            <p>После Получения токена, вы сможете пользоваться API, передавая полученный токен в запросе</p>
            <p>Список ссылок для API:</p>
            <ul>
                <li>Просмотр всех компаний (GET) <a href="">http://company/public/api/company</a></li>
                <li>Просмотр одной компании (GET) <a href="">http://company/public/api/company/id</a></li>
                <li>Сохранить новую компанию (POST) <a href="">http://company/public/api/company</a></li>
                <li>Редактировать компанию (PUT) <a href="">http://company/public/api/company/id</a></li>
                <li>Удалить компанию (PUT) <a href="">http://company/public/api/company/id</a></li>
            </ul>
        </div>
    </div>
@endsection
