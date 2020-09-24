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
            font-size: 84px;
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
            border-spacing:0;
            margin: auto;
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
        .pagination li {
            display: inline-block;
        }
    </style>
</head>
<body>
<div class=" position-ref full-height">
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
        <div style="margin: 40px;padding-top: 20px;">
            Список заказов
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Имя партнёра</th>
                <th>Сумма заказа</th>
                <th>Состав</th>
                <th>Статус</th>
            </tr>
            @foreach( $orders as $order)
            <tr>
                <td><a href="{{ route('orders.edit', ['id'=>$order['id']]) }}">{{  $order['id'] }}</a></td></td>
                <td>{{  $order['partner_name'] }}</td>
                <td>{{  $order['cost'] }} руб.</td>
                <td>
                    @foreach($order['structure'] as $product)
                    {{  $product }}
                    @endforeach
                </td>
                <td>{{  $order['status'] }}</td>
            </tr>
            @endforeach
        </table>

        <div class="links" style="display: inline-block">
            {{ $orders->links() }}
        </div>
    </div>
</div>
</body>
</html>
