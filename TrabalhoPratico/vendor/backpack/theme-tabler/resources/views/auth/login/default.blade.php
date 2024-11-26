@extends(backpack_view('layouts.auth'))

@section('content')
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4 display-6 auth-logo-container">
                {!! backpack_theme_config('project_logo') !!}
            </div>
            <div class="card card-md">
                <div class="card-body pt-0">
                    @include(backpack_view('auth.login.inc.form'))
                </div>
            </div>
            @if (config('backpack.base.registration_open'))
            @endif
        </div>
    </div>
@endsection