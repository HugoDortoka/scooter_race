<!doctype html>
<html lang="en">
    <head>
        <title>Participants</title>
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
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Dorsal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($competitors as $competitor)
                <tr>
                    <td>{{$competitor->DNI}}</td>
                    <td>{{$competitor->name}}</td>
                    <td>{{$competitor->surname}}</td>
                    <td>         
                       @foreach($participants as $participant)
                            @if($participant->competitor_id == $competitor->id)
                                {{$participant->dorsal_number}}
                            @endif
                        @endforeach
                    </td>
                </tr>
                @endforeach
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
