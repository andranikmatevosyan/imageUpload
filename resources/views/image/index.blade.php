@extends('layouts.app')

@section('content')

    <div class="wrap-contact100">
        <form action="{{ route('image.store') }}" class="contact100-form ajax-form">
            <span class="contact100-form-title">
                Загрузка изоброжения
            </span>

            @csrf

            <label class="label-input100" for="image-url">Введите ссылку на изоброжение *</label>
            <div class="wrap-input100" data-validate = "">
                <input type="text" name="image_url" id="image-url" class="input100" placeholder="Пример : https://google.com/image-path">
                <span class="focus-input100"></span>
            </div>

            <label class="label-input100" for="life-time">Введите срок изоброжения в минутах</label>
            <div class="wrap-input100" data-validate = "">
                <input type="number" name="life_time" id="life-time" class="input100" placeholder="Пример : 1200">
                <span class="focus-input100"></span>
            </div>

            <div class="container-contact100-form-btn">
                <button type="submit" class="contact100-form-btn">
                    <i class="fa fa-refresh fa-spin m-r-10 f-s-20 hide"></i> Отправить
                </button>
            </div>
        </form>

        <div class="contact100-more flex-col-c-m" style="background-image: url('{{ asset('assets/front/images/bg-01.jpg') }}');">
            <div class="dis-flex size1 p-b-47">
                <div class="txt1 p-r-25">
                    <span class="fa fa-globe"></span>
                </div>

                <div class="flex-col size2">
                    <span class="txt1 p-b-20">
                        Ссылка на загруженное изоброжение
                    </span>

                    <span class="txt3 ajax-display">

                    </span>
                </div>
            </div>
        </div>
    </div>

@endsection
