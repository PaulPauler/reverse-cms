@extends('layouts.site')

@section('header_plus')
  <div class="container person" style="background-image: url({{asset('images/person.png')}})">
    <div class="row">
      <div class="col-xs-12 col-md-6">
        <p class="h1 mt-5 theme-color font-weight-bold">РАБОТАЕМ НА ВАШ РЕЗУЛЬТАТ!</p>
        <p class="float-left mr-3"><i class="far fa-check-square theme-color h1"></i></p>
        <p class="theme-color w-75">Вы платите в случае успешного разрешения вашего вопроса</p>
        <div class="mt-5 theme-color">
          <p>Добро пожаловать на личный сайт практикующего юриста, специалиста в недвижимости и профессионального медиатора&nbsp;Злочевского Виталия.</p>
        </div>
      </div>
    </div>
    <div class="row service mt-5 pb-3">
      <div class="col-xs-12 col-md-4">
        <h5 class="card-title p-3 mb-0 text-white theme-bg">Онлайн консультация</h5>
        <div class="card-body bg-white">
          <p>Платная юридическая консультация онлайн это быстрое решение проблемы с минимальными финансовыми затратами.</p>
          <p><a href="#">Получить консультацию</a></p>
        </div>
      </div>
      <div class="col-xs-12 col-md-4">
        <h5 class="card-title p-3 mb-0 text-white theme-bg">Мои услуги</h5>
        <div class="card-body bg-white">
          <p>В своей работе я стараюсь понять истинную потребность человека и поняв ее стараюсь сделать максимум для достижения этой цели.</p>
          <p><a href="#">Подробнее об услугах</a></p>
        </div>
      </div>
      <div class="col-xs-12 col-md-4">
        <h5 class="card-title p-3 mb-0 text-white theme-bg">Отзывы</h5>
        <div class="card-body bg-white">
          <p>Благодарю Виталия Васильевича за оформление наследства на жилой дом и земельный пай....</p>
          <p><a href="#">Читать все отзывы</a></p>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
    @include('content.home')
@endsection
