<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"
    style="margin: 0 auto;  -ms-touch-action: manipulation; touch-action: manipulation; text-rendering: optimizeLegibility; padding: 0;">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">

    <style>
        .text-header {
            font-size: 25px;
            margin-top: 30px;
            margin-bottom: 30px;
            font-weight: bold;
            color: #6C5EF1;
        }

        .badge-primary {
            background-color: #F2F1FF;
            color: #6C5EF1;
            padding: 7px 15px;
            font-weight: bold;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
        }

        .my-22 {
            margin-top: 22px;
            margin-bottom: 22px;
        }

        .bold {
            font-weight: bold;
        }

        .rounded {
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
        }

        .bg-light {
            background-color: #F2F1FF;
        }

        .primary-color {
            color: #6C5EF1;
        }

        a {
            color: #6C5EF1;
            text-decoration: none;
        }
    </style>
</head>

<body
    style="margin: 0; padding: 0; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; background: #F2F1FF repeat;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:30px;" align="center">
        <tbody>
            <tr>
                <td>
                    <table width="600px" border="0" cellspacing="0" cellpadding="0" align="center"
                        bgcolor="#ffffff"
                        style="font-family:helvetica, sans-serif; text-align: left; border: 0; font-size: 16px; line-height: 1.5; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; ">
                        <tbody>
                            <tr>
                                <td style="padding: 30px;">
                                    <!-- body -->
                                    @yield('body')
                                    <p>
                                        Gracias, <span class="primary-color bold">{{ config('app.name') }}</span>
                                    </p>
                                </td>
                            </tr>

                            <!-- footer -->

                            <!-- Rights and Powered by -->
                            <tr>
                                <td
                                    style="padding: 20px 20px 20px; text-align: center; background-color: #6C5EF1; color: #fff;">

                                    <div style="color:#fff; font-size: 12px;">
                                        © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>
