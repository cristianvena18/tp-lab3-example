<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Time Deposit Calculator</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        .full-height {
            height: 100vh;
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .position-ref {
            position: relative;
        }
        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }
        .content {
            text-align: center;
        }
        .title {
            font-size: 84px;
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('timeDepositCalculator') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

                        <div class="col-md-6">
                            <input id="text" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}" required>

                            @if ($errors->has('surname'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="mount" class="col-md-4 col-form-label text-md-right">{{ __('Monto') }}</label>

                        <div class="col-md-6">
                            <input id="mount" type="number" class="form-control{{ $errors->has('mount') ? ' is-invalid' : '' }}" name="mount" value="{{ old('mount') }}" required>

                            @if ($errors->has('mount'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mount') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="days" class="col-md-4 col-form-label text-md-right">{{ __('Días') }}</label>

                        <div class="col-md-6">
                            <input id="days" type="number" class="form-control{{ $errors->has('days') ? ' is-invalid' : '' }}" name="days" value="{{ old('days') }}" required>

                            @if ($errors->has('days'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('days') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="days" class="col-md-4 col-form-label text-md-right">{{ __('Reinvertir') }}</label>

                        <div class="col-md-6">
                            <input id="compound" type="checkbox" class="form-control{{ $errors->has('compound') ? ' is-invalid' : '' }}" name="compound" value="false">

                            @if ($errors->has('compound'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('compound') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Calcular') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
