<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking</title>
</head>

<body>
    <div>
        <h1> Client Name : {{ $name }}</h1>
        <h3> Client Phone : {{ $phone }}</h3>
    </div>
    <div style="width: 100%;">
        <h3>the message :</h3>
        {{ $content }}

        <div>

            <h3> for services :</h3>

            @foreach ($booking as $booked)
                <p> {{ $booked }}</p>
            @endforeach
        </div>

    </div>
</body>

</html>
