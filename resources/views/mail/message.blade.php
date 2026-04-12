<!DOCTYPE html>
<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message from Brwncreative</title>
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
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <style>
        body {
            font-family: "Roboto", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-variation-settings: "wdth" 100;
        }
        @media only screen and (max-width: 600px){
            #container{
                width: 95% !important
            }
        }
    </style>
</head>

<body style="background-color: rgb(185, 185, 185)">
    <center>
        <table id="container" style="width: 80%; background-color: white">
            {{-- Introduction --}}
            <tr>
                <td style="height: 10px"></td>
            </tr>
            <tr>
                <td>
                    <div style="width: 120px;">
                        <center>
                            <img style="width: 90px;"
                                src="https://drive.google.com/thumbnail?id=1tq5Vjp4KCWUZdu1uCxCwdiMEyf8Gf-Hd&sz=h200"
                                alt="brwn_logo_email">
                        </center>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="height:0.5px; background-color:rgb(139, 139, 139); width:100%"></td>
            </tr>
            <tr>
                <td style="height: 10px"></td>
            </tr>
            {{-- Main --}}
            <tr>
                <td>
                    <center>
                        <div style="width: 95%; text-align: left;">
                            {!! $payload['body'] !!}
                        </div>
                    </center>
                </td>
            </tr>
            {{-- Signature --}}
            <tr>
                <td>
                    <hr>
                </td>
            </tr>
            <tr>
                <td style="height: 10px"></td>
            </tr>
            <tr>
                <td>
                    <center>
                        <div style="width: 95%; text-align: left;">
                            <p style="margin: 0px; font-size: large;">Best Regards,</p><br>
                            <strong>Kareem Williams (Brwncreative)</strong><br>
                            <p style="margin: 0px">Building identities with digital, web and animation</p><br>
                            <strong>Portfolio and Ways to Contact Me:</strong><br>
                            <a href="www.brwncreative.com">www.brwncreative.com</a>
                            <p style="margin: 0px; font-size: 1.2rem;">@brwncreativestudio</p>
                            <p style="margin: 0px; font-size: 1.2rem;">+1(868)7687915</p>
                        </div>
                    </center>
                </td>
            </tr>
            <tr>
                <td style="height: 30px"></td>
            </tr>
            <tr>
                <td>
                    <center>
                        <img style="max-width: 100%"
                            src="https://drive.google.com/thumbnail?id=1eAV8tUuZ386yURMQr7IvXqlbEhQZO4Wr&sz=h200"
                            alt="brwn_banner_email">
                    </center>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>