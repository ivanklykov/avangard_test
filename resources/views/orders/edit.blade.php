<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
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
            font-size: 54px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        table{
            width: 1000px;
            border-collapse:collapse;
            border-spacing:0
        }
        table, td, th {
            border: 1px solid #595959;
        }
        td, th {
            padding: 3px;
            width: 130px;
            height: 35px;
        }
        th {
            background-color: #7accee;
        }
        .form-group {
            margin: 10px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    @endif

    <div class="content">
        @if (session('status') == 'updated')
            <span style="color: green">Заказ обновлен</span>
        @endif
        @if (session('errors'))
            <span style="color: red">Ошибка! Одно из полей заполнено некорректно!</span>
        @endif
        <div class="m-b-md title">
            Заказ ID {{ $order->id }}
        </div>

        <form action="{{ route('orders.update', ['id'=>$order->id]) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="client_email">Email клиента:</label>
                <input type="email" name="client_email" id="client_email"
                       @isset($order->client_email)
                       value="{{ $order->client_email }}"
                       @endisset
                        required
                >
            </div>
            <div class="form-group">
                <label for="partner_id">Партнер</label>
                <select id="partner_id" name="partner_id">
                    @foreach($partners as $partner)
                    <option value="{{ $partner->id }}"
                    @if ($partner->id == $order->partner_id)
                        selected
                            @endif
                    > {{$partner->name}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <span>Продукты:</span>
                <table>
                    <tr>
                        <th>Товар</th>
                        <th>Колличество</th>
                    </tr>
                    @foreach($order->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="form-group">
                <label for="status">Статус</label>
                <select id="status" name="status">
                    @foreach($statuses as $id => $status)
                        <option value="{{ $id }}"
                        @if ($id == $order->status)
                                selected
                                @endif
                        > {{ $status }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <span>Сумма заказа: {{ $cost }} руб.</span>
            </div>
            <div class="form-group">
                <input type="submit" value="Сохранить">
            </div>
        </form>
        <a href="{{ route('orders.index') }}">Вернуться к списку заказов</a>

    </div>
</div>
</body>
</html>
