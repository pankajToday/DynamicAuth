<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title','Online CV Generator')</title>
    <meta name="author" content="Pankaj Kumar">
    <meta name="" content="{{csrf_token()}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

</head>
<body>
    <div style="margin: 20% 45%;" >
        <form action="{{route('login')}}" method="post">
            {{csrf_field()}}
            <table>
                <tr>
                    <th>
                        Login Id
                    </th>
                    <td>
                        <input type="text" name="login_id" value="abc" >
                    </td>
                </tr>
                <tr>
                    <th>
                        password
                    </th>
                    <td>
                        <input type="password" name="password" value="12345" >
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit"  value="login" >
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <script>

    </script>
</body>
</html>
