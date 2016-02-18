@extends('jetcms.core::layouts.master')

@section('body')
    <div class="jet-user__registration">

        <h1>Регистрация</h1>

        <form method="POST">

            <div class="group @if($input['email']['error']) error @endif" >
                <lable>Почта</lable>
                <input name="email" type="text" value="{{$input['email']['value']}}"/>
                <em>{{$input['email']['error']}}</em>
            </div>

            <div class="group @if($input['password']['error']) error @endif" >
                <lable>Пароль</lable>
                <input name="password" type="password" value="{{$input['password']['value']}}"/>
                <em>{{$input['password']['error']}}</em>
            </div>

            <input name="_token" type="hidden" value="{{csrf_token()}}"/>

            <div>
                <button type="submit">Зарегестрироватся</button>
            </div>

            <div class="link">
                <a class="login" href="/login">Авторизоватся</a>
            </div>

        </form>
    </div>
@stop