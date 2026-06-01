<!doctype html>
<html lang="en-US">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notifications Email Template</title>
  <style>
    /* Add your CSS styles here */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f2f3f8;
    }

    .container {
      max-width: 670px;
      margin: 0 auto;
      background-color: #fff;
      border-radius: 3px;
      box-shadow: 0 6px 18px 0 rgba(0, 0, 0, .06);
      padding: 40px;
    }

    h1 {
      color: #1e1e2d;
      font-weight: 500;
      font-size: 32px;
    }

    p {
      color: #455056;
      font-size: 15px;
      line-height: 24px;
      margin: 8px 0 30px;
    }

    .notification {
      border-bottom: 1px solid #ebebeb;
      margin-bottom: 26px;
      padding-bottom: 29px;
    }

    .notification:last-child {
      border-bottom: none;
    }

    .notification img {
      border-radius: 50%;
    }

    .notification-content {
      margin-left: 20px;
    }

    .notification-content h3 {
      color: #4d4d4d;
      font-size: 20px;
      font-weight: 400;
      line-height: 30px;
      margin-bottom: 3px;
    }

    .notification-content span {
      color: #737373;
      font-size: 14px;
    }

    .footer {
      text-align: center;
      color: #455056bd;
      font-size: 14px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div style="text-align:center;">
        <a href="https://holidaypackage.perfectsolutions4u.com/" title="logo" target="_blank">
            <img width="60" src="{{ App\Models\Setting::firstWhere('option_key', \App\Enums\SettingKey::LOGO->value)->option_value[0] }}" title="logo" alt="logo">
        </a>
        <a href="https://holidaypackage.perfectsolutions4u.com/" title="logo" target="_blank">
            <img width="60" src="http://holidaypackage.perfectsolutions4u.com/storage/media/logo.png" title="logo" alt="logo">
        </a>
      </div>

        <h1>Hi Sir,</h1>
    <p>{{$requestData['title']}}</p>
    <p>{!!$requestData['mail']!!}</p>
    <p class="footer">&copy; <strong>https://holidaypackage.perfectsolutions4u.com/</strong></p>
  </div>
</body>

</html>
