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

            <form action="{{ route('company.update', ['company' => $company->id]) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label>Название компании</label>
                    <input name="company_name" value="{{ $company->company_name }}" type="text" class="form-control"
                           placeholder="Название компании">
                </div>

                <div class="form-group mt-3">
                    <label>Адрес компании</label>
                    <input name="company_address" value="{{ $company->company_address }}" type="text" class="form-control"
                           placeholder="Адрес компании">
                </div>

                <div class="form-group mt-3">
                    <label>CEO компании</label>
                    <input name="CEO" type="text" value="{{ $company->CEO }}" class="form-control"
                           placeholder="CEO компании">
                </div>

                <div class="form-group mt-3">
                    <label>Мобильный телефон</label>
                    <input name="phone_company" value="{{ $company->phone_company }}" type="text" class="form-control"
                           placeholder="Мобильный телефон">
                </div>

                <div class="form-group mt-3">
                    <label>Email компании</label>
                    <input name="email_company" value="{{ $company->email_company }}" type="email" class="form-control"
                           placeholder="Email компании">
                </div>

                <div class="form-group mt-3">
                    <label>Количество сотрудников</label>
                    <input name="quantity_employees" value="{{ $company->quantity_employees }}" type="number"
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
                    <select name="id_district" id="edit-district" class="form-control">
                        <option>-</option>
                        @foreach($allDisctrict as $district)
                            <option value="{{ $district->id }}" @if($district->id == $company->id_district) selected @endif>{{ $district->district }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="edit-villages" class="form-group mt-3">
                    <input type="hidden" id="edit_id_village" value="{{ $company->id_village }}">
                </div>

                <div class="mt-5 text-center">
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            </form>
        </div>
    </div>
@endsection
