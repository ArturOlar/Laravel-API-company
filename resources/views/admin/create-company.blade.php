@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-6 offset-3">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-success text-center">
                    {{ Session::get('success') }}
                </div>
            @endif

            <form action="{{ route('company.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Название компании</label>
                    <input name="company_name" value="{{ old('company_name') }}" type="text" class="form-control"
                           placeholder="Название компании">
                </div>

                <div class="form-group mt-3">
                    <label>Адрес компании</label>
                    <input name="company_address" value="{{ old('company_address') }}" type="text" class="form-control"
                           placeholder="Адрес компании">
                </div>

                <div class="form-group mt-3">
                    <label>CEO компании</label>
                    <input name="CEO" type="text" value="{{ old('CEO') }}" class="form-control"
                           placeholder="CEO компании">
                </div>

                <div class="form-group mt-3">
                    <label>Мобильный телефон</label>
                    <input name="phone_company" value="{{ old('phone_company') }}" type="text" class="form-control"
                           placeholder="Мобильный телефон">
                </div>

                <div class="form-group mt-3">
                    <label>Email компании</label>
                    <input name="email_company" value="{{ old('email_company') }}" type="email" class="form-control"
                           placeholder="Email компании">
                </div>

                <div class="form-group mt-3">
                    <label>Количество сотрудников</label>
                    <input name="quantity_employees" value="{{ old('quantity_employees') }}" type="number"
                           class="form-control" placeholder="Количество сотрудников">
                </div>

                <div class="form-group mt-3">
                    <label>Сфера деятельности</label>
                    <select name="id_activity_company" class="form-control">
                        @foreach($allActivity as $activity)
                            <option value="{{ $activity->id }}">{{ $activity->activity }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label>Район</label>
                    <select id="district" name="id_district" class="form-control">
                        <option>-</option>
                        @foreach($allDisctrict as $district)
                            <option value="{{ $district->id }}">{{ $district->district }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="villages" class="form-group mt-3">
                </div>

                <div class="mt-5 text-center">
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            </form>
        </div>
    </div>
@endsection
