@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h3 class="text-center">Администратор</h3>
                <div class="mt-5">
                    <span>Войдя в роли администратора, вы сможете: создавать, редактировать, удалать компании из таблицы.</span><br>
                    <span>То есть, получите возможности для CRUD-операций</span>
                </div>
            </div>
            <div class="col-md-6">
                <h3 class="text-center">Пользователь</h3>
                <div class="mt-5">
                    <span>Войдя в роли пользователя (не администратора), с помощью API вы сможете: получить все компании, одну компанию, создавать, редактировать, удалять компании</span><br>
                </div>
            </div>
        </div>
    </div>
@endsection
