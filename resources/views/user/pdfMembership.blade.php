<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

        <!-- Custom CSS -->
        <style>
            .pdf{
                width: 100%;
            }
            .pdf th, td{
                border: 1px solid black;
                text-align: center;
                padding: 10px;
            }
        </style>
    </head>

    <body>
        <table class="pdf">
            <thead>
                <h1>{{$competitor->name}} {{$competitor->surname}}</h1>
                <tr>
                    <th>DNI</th>
                    <th>Subscription date</th>
                    <th>Subscription finish</th>
                    <th>Discount</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$competitor->DNI}}</td>
                    <td>{{ date('d-m-Y', strtotime($membership->subscription_date)) }}</td>
                    <td>{{ date('d-m-Y', strtotime($membership->subscription_finish)) }}</td>
                    <td>{{$membership->discount}}%</td>
                    <td>{{$membership->annual_fee}}€</td>
                </tr>
            </tbody>

        </table>
      

        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>