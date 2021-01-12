@extends('layouts.app')

@section('content')
    <div>
        <h4 class="text-center">Список организаций города Черновцы</h4>
        <table class="table table-bordered table-striped mt-5">
            <thead>
                <tr>
                    <th scope="col">Название</th>
                    <th scope="col">CEO</th>
                    <th scope="col">Номер телефона</th>
                    <th scope="col">Почта</th>
                    <th scope="col">Кол-во сотруд.</th>
                    <th scope="col">Район</th>
                    <th scope="col">Посёлок</th>
                    <th scope="col">Адресс</th>
                    <th scope="col">Деятельность</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allCompany as $company)
                    <tr>
                        <td>{{ $company->company_name }}</td>
                        <td>{{ $company->CEO }}</td>
                        <td>{{ $company->phone_company }}</td>
                        <td>{{ $company->email_company }}</td>
                        <td>{{ $company->quantity_employees }}</td>
                        <td>{{ $company->district->district }}</td>
                        <td>
                            @if($company->village == null)
                                -
                            @else
                                {{ $company->village->village }}
                            @endif
                        </td>
                        <td>{{ $company->company_address }}</td>
                        <td>{{ $company->activity->activity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="col-md-4 offset-5 mt-5">
            {{ $allCompany->links() }}
        </div>
    </div>
@endsection
