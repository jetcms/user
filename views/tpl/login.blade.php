@extends('jetcms.core::layouts.master')

@section('body')
    <div class="jet-user__login">

        <h1>Авторизация</h1>

        <form method="POST">

            <div class="group @if($email['error']) error @endif" >
                <lable>Почта</lable>
                <input name="email" type="text" value="{{$email['value']}}"/>
                <em>{{$email['error']}}</em>
            </div>

            <div class="group @if($password['error']) error @endif" >
                <lable>Пароль</lable>
                <input name="password" type="password" value="{{$password['value']}}"/>
                <em>{{$password['error']}}</em>
            </div>



            <div class="checkbox">
                <label>
                    <input name="remembor" type="checkbox"> Запоминить
                </label>
            </div>


            <input name="_token" type="hidden" value="{{csrf_token()}}"/>

            <div>
                <button type="submit">Войти</button>
            </div>

            <div class="link">
                <a class="password" href="">Востоновить пароль</a>
                <a class="registration" href="/registration">Регистрация</a>
            </div>

        </form>
    </div>
@stop