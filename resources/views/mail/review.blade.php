<!DOCTYPE html>
<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Email Title</title>
    <!--[if mso]>
    <xml>
      <o:OfficeDocumentSettings>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
  <![endif]-->
    <style type="text/css">

    </style>
    <!-- Link to Google Fonts (with fallback specified inline) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.upset.dev/css2?family=Pixelify+Sans:wght@400..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: "Roboto", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-variation-settings: "wdth" 100;
        }
    </style>
</head>

<body style="background-color: rgb(185, 185, 185)">
    <center>
        <table style="width: 80%; background-color: white">
            <tr>
                <td>
                    <center>
                        <img src="" alt="">
                    </center>
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <p style="width: 90%; text-align: left; margin: 0px;font-size:2rem;">
                            Hi <b> {{ $client->name }}</b>
                        </p>
                    </center>
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <p style="width: 90%; text-align: left;">
                            Please see detailed below a review of your account as of <b> {{ date('m/d/Y h:i:s a',
                                time()) }}</b>. If anything seems out of place, feel free to contact me at 768-7915 or
                            kareem.williams@brwncreative.com.
                        </p>
                    </center>
                </td>
            </tr>
            <tr>
                <td>
                    <hr>
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <p style="width: 90%; text-align: left; margin:0px">
                            <b> Client name:</b> {{ $client->name }}
                        </p>
                    </center>
                    <center>
                        <p style="width: 90%; text-align: left; margin:0px">
                            <b> Description:</b> {{ $client->description }}
                        </p>
                    </center>
                    <center>
                        <p style="width: 90%; text-align: left; margin:0px">
                            <b>Balance:</b> ${{ number_format($client->balance,2) }}
                        </p>
                    </center>
                </td>
            </tr>
            <tr>
                <td>
                    <hr>
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <p style="width: 90%; text-align: left; margin:0px">
                            Your outstanding balance is as follows:
                        </p>
                    </center>
                    <center>
                        <p style="width: 90%; text-align: left; margin-block:10px; font-size: 2rem;">
                            ${{ number_format($client->balance,2) }}
                        </p>
                    </center>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>