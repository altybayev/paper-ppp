@extends('canvas::backend.layout')

@section('title')
    <title>{{ Settings::blogTitle() }} | Edit User Privacy</title>
@stop

@section('content')
    <section id="main">
        @include('canvas::backend.partials.sidebar-navigation')
        <section id="content">
            <div class="container container-alt">
                <div class="block-header">
                    <h2>User Profile</h2>
                    <ul class="actions">
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="{!! route('admin.user.edit', $data['id']) !!}"><i class="zmdi zmdi-refresh-alt pd-r-5"></i> Refresh User</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="card" id="profile-main">
                    @include('canvas::backend.user.partials.sidebar')
                    <div class="pm-body clearfix">
                        <ul class="tab-nav tn-justified">
                            <li class="{{ Route::is('admin.user.edit') ? 'active' : '' }}">
                                <a href="{!! route('admin.user.edit', $data['id']) !!}">Profile</a>
                            </li>
                            <li class="{{ Route::is('admin.user.privacy') ? 'active' : '' }}">
                                <a href="{!! route('admin.user.privacy', $data['id']) !!}">Privacy</a>
                            </li>
                        </ul>
                        <div class="pmb-block">
                            @if(Session::has('errors') || Session::has('success'))
                                <div class="pmb-block">
                                    <div class="pmbb-header">
                                        @include('canvas::shared.errors')
                                        @include('canvas::shared.success')
                                    </div>
                                </div>
                            @endif

                            <div class="pmbb-header">
                                <h2><i class="zmdi zmdi-shield-security m-r-10"></i> Change Password</h2>
                            </div>

                            <div class="pmbb-body p-l-30">
                                @include('canvas::backend.user.partials.form.password')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop

@section('unique-js')
    {!! JsValidator::formRequest('Canvas\Http\Requests\PasswordUpdateRequest', '#passwordUpdate') !!}
    @include('canvas::backend.shared.components.show-password', ['inputs' => 'input[name="new_password"], input[name="new_password_confirmation"]'])

    @if(Session::get('_passwordUpdate'))
        @include('canvas::backend.partials.notify', ['section' => '_passwordUpdate'])
        {{ \Session::forget('_passwordUpdate') }}
    @endif
@stop
