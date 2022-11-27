<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="x-apple-disable-message-reformatting" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="format-detection" content="telephone=no" />
    
    <title></title>

    {{-- <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet"> --}}

    <style type="text/css">
        /* Resets */
        .ReadMsgBody {
            width: 100%;
            background-color: #ebebeb;
        }
        
        .ExternalClass {
            width: 100%;
            background-color: #ebebeb;
        }
        
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }
        
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }
        
        body {
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
        }
        
        body {
            margin: 0;
            padding: 0;
        }
        
        .yshortcuts a {
            border-bottom: none !important;
        }
        
        .rnb-del-min-width {
            min-width: 0 !important;
        }
        /* Add new outlook css start */
        
        .templateContainer {
            max-width: 650px !important;
            width: auto !important;
        }
        /* Add new outlook css end */
        /* Image width by default for 3 columns */
        
        img[class="rnb-col-3-img"] {
            max-width: 170px;
        }
        /* Image width by default for 2 columns */
        
        img[class="rnb-col-2-img"] {
            max-width: 264px;
        }
        /* Image width by default for 2 columns aside small size */
        
        img[class="rnb-col-2-img-side-xs"] {
            max-width: 180px;
        }
        /* Image width by default for 2 columns aside big size */
        
        img[class="rnb-col-2-img-side-xl"] {
            max-width: 350px;
        }
        /* Image width by default for 1 column */
        
        img[class="rnb-col-1-img"] {
            max-width: 550px;
        }
        /* Image width by default for header */
        
        img[class="rnb-header-img"] {
            max-width: 650px;
        }
        /* Ckeditor line-height spacing */
        
        .rnb-force-col p,
        ul,
        ol {
            margin: 0px!important;
        }
        
        .rnb-del-min-width p,
        ul,
        ol {
            margin: 0px!important;
        }
        /* tmpl-2 preview */
        
        .rnb-tmpl-width {
            width: 100%!important;
        }
        /* tmpl-11 preview */
        
        .rnb-social-width {
            padding-right: 15px!important;
        }
        /* tmpl-11 preview */
        
        .rnb-social-align {
            float: right!important;
        }
        /* Ul Li outlook extra spacing fix */
        
        li {
            mso-margin-top-alt: 0;
            mso-margin-bottom-alt: 0;
        }
        /* Outlook fix */
        
        table {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        /* Outlook fix */
        
        table,
        tr,
        td {
            border-collapse: collapse;
        }
        /* Outlook fix */
        
        p,
        a,
        li,
        blockquote {
            mso-line-height-rule: exactly;
        }
        /* Outlook fix */
        
        .msib-right-img {
            mso-padding-alt: 0 !important;
        }
        
        @media only screen and (min-width:650px) {
            /* mac fix width */
            .templateContainer {
                width: 650px !important;
            }
        }
        
        @media screen and (max-width: 360px) {
            /* yahoo app fix width "tmpl-2 tmpl-10 tmpl-13" in android devices */
            .rnb-yahoo-width {
                width: 360px !important;
            }
        }
        
        @media screen and (max-width: 380px) {
            /* fix width and font size "tmpl-4 tmpl-6" in mobile preview */
            .element-img-text {
                font-size: 24px !important;
            }
            .element-img-text2 {
                width: 230px !important;
            }
            .content-img-text-tmpl-6 {
                font-size: 24px !important;
            }
            .content-img-text2-tmpl-6 {
                width: 220px !important;
            }
        }
        
        @media screen and (max-width: 480px) {
            td[class="rnb-container-padding"] {
                padding-left: 10px !important;
                padding-right: 10px !important;
            }
            /* force container nav to (horizontal) blocks */
            td.rnb-force-nav {
                display: inherit;
            }
            /* fix text alignment "tmpl-11" in mobile preview */
            .rnb-social-text-left {
                width: 100%;
                text-align: center;
                margin-bottom: 15px;
            }
            .rnb-social-text-right {
                width: 100%;
                text-align: center;
            }
        }
        
        @media only screen and (max-width: 600px) {
            /* center the address &amp; social icons */
            .rnb-text-center {
                text-align: center !important;
            }
            /* force container columns to (horizontal) blocks */
            th.rnb-force-col {
                display: block;
                padding-right: 0 !important;
                padding-left: 0 !important;
                width: 100%;
            }
            table.rnb-container {
                width: 100% !important;
            }
            table.rnb-btn-col-content {
                width: 100% !important;
            }
            table.rnb-col-3 {
                /* unset table align="left/right" */
                float: none !important;
                width: 100% !important;
                /* change left/right padding and margins to top/bottom ones */
                margin-bottom: 10px;
                padding-bottom: 10px;
                /*border-bottom: 1px solid #eee;*/
            }
            table.rnb-last-col-3 {
                /* unset table align="left/right" */
                float: none !important;
                width: 100% !important;
            }
            table.rnb-col-2 {
                /* unset table align="left/right" */
                float: none !important;
                width: 100% !important;
                /* change left/right padding and margins to top/bottom ones */
                margin-bottom: 10px;
                padding-bottom: 10px;
                /*border-bottom: 1px solid #eee;*/
            }
            table.rnb-col-2-noborder-onright {
                /* unset table align="left/right" */
                float: none !important;
                width: 100% !important;
                /* change left/right padding and margins to top/bottom ones */
                margin-bottom: 10px;
                padding-bottom: 10px;
            }
            table.rnb-col-2-noborder-onleft {
                /* unset table align="left/right" */
                float: none !important;
                width: 100% !important;
                /* change left/right padding and margins to top/bottom ones */
                margin-top: 10px;
                padding-top: 10px;
            }
            table.rnb-last-col-2 {
                /* unset table align="left/right" */
                float: none !important;
                width: 100% !important;
            }
            table.rnb-col-1 {
                /* unset table align="left/right" */
                float: none !important;
                width: 100% !important;
            }
            img.rnb-col-3-img {
                /**max-width:none !important;**/
                width: 100% !important;
            }
            img.rnb-col-2-img {
                /**max-width:none !important;**/
                width: 100% !important;
            }
            img.rnb-col-2-img-side-xs {
                /**max-width:none !important;**/
                width: 100% !important;
            }
            img.rnb-col-2-img-side-xl {
                /**max-width:none !important;**/
                width: 100% !important;
            }
            img.rnb-col-1-img {
                /**max-width:none !important;**/
                width: 100% !important;
            }
            img.rnb-header-img {
                /**max-width:none !important;**/
                width: 100% !important;
                margin: 0 auto;
            }
            img.rnb-logo-img {
                /**max-width:none !important;**/
                width: 100% !important;
            }
            td.rnb-mbl-float-none {
                float: inherit !important;
            }
            .img-block-center {
                text-align: center !important;
            }
            .logo-img-center {
                float: inherit !important;
            }
            /* tmpl-11 preview */
            .rnb-social-align {
                margin: 0 auto !important;
                float: inherit !important;
            }
            /* tmpl-11 preview */
            .rnb-social-center {
                display: inline-block;
            }
            /* tmpl-11 preview */
            .social-text-spacing {
                margin-bottom: 0px !important;
                padding-bottom: 0px !important;
            }
            /* tmpl-11 preview */
            .social-text-spacing2 {
                padding-top: 15px !important;
            }
            /* UL bullet fixed in outlook */
            ul {
                mso-special-format: bullet;
            }
        }
        /*End Reset*/

        /*My style*/
        table {
            border-spacing: 0;
            width: 100%;
        }
        
        table td {
            border-collapse: collapse;
        }
        .section-title {
            color: #800080;
            font-family: Arial,Helvetica,sans-serif;
            text-align: center;
            width: 100%;
            background-color: #F3F2F5;
            padding: 38px 0;
            padding-top: 32px;
        }
        .title {
            color: #03D5C0;
            font-weight: bold;
            font-size: 26px;
        }
        .subtitle {
            color: #0F0F19;
            font-size: 22px;
        }
        .section-content {
            width: 100%;
            text-align: left;
            color: #0F0F19;
            padding: 18px;
            background-color: white;
            font-size: 16px;
            padding-bottom: 58px;
        }
        .greeting {
            font-weight: bold;
            padding-bottom: 16px;
            font-size: 18px;
        }
        .body {
        }
        .greenbtn {
            background-color: #03D5C0;
            padding: 18px 40px;
            color: #0B0A0F !important;
            font-weight: bold;
            border-radius: 34px;
            font-size: 18px;
            text-decoration: none;
        }
        .section-footer {
            width: 650px;
            padding: 24px 0;
            background-color: #282739;
            color: #d3d2d8a6;
            font-size: 14px;
            text-align: center;
        }
        .link-sc {
            color: #03D5C0 !important;
            text-decoration: underline;
            font-size: 12px;
        }
        .link-sc:hover {
            color: #03D5C0 !important;
        }
        .social-icon {
            padding-bottom: 16px;
        }
        .social-icon a {
            margin: 4px;
            text-decoration: none;
        }
        .btn-confirm {
            text-align: center;
            padding-top: 58px;
        }
        .security {
            padding-top: 58px;
        }
    </style>
</head>

<body>
    <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" class="main-template" bgcolor="#f9fafc" style="background-color: rgb(249, 250, 252);">
        <tbody>
            <tr>
                <td align="center" valign="top">
                    <table border="0" cellpadding="0" cellspacing="0" class="templateContainer" style="width:100%">
                        <tbody>
                            <tr>
                                <td align="center" valign="top" style="background-color: #F3F2F5;">
                                    <img vspace="0" hspace="0" border="0" alt="SafeMoon" class="rnb-logo-img" src="https://safemoon-connect.s3.amazonaws.com/assets/imgs/common/banner.gif" style="height: auto;outline: none;width: 100% !important;">
                                </td>
                            </tr>

                            <tr>
                                <td align="center" valign="top" class="section-title">
                                    <table>
                                        <tbody><tr><td class="title">Welcome to SafeMoon Connect!</td></tr></tbody>
                                        <tbody><tr><td class="subtitle">The best way to send crypto</td></tr></tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="section-content">
                                                    <table>
                                                        <tbody><tr><td class="greeting">Hi {{ $first_name }},</td></tr></tbody>
                                                        <tbody><tr><td class="body">You recently requested to reset your password for your <a href="mailto:{{ $email }}">{{ $email }}</a> account. Use the button below to reset it. This password reset is only valid for the next 24 hours.</td></tr></tbody>
                                                        <tbody><tr><td class="btn-confirm">
                                                            <a href="{{ $link }}" role="button" class="btn greenbtn">Reset your password</a>
                                                        </td></tr></tbody>
                                                        <tbody><tr><td class="security">For security, this request was received from a {{ $platform }} {{ $device ?: '' }} using {{ $browser }}. If you did not requests password reset, please ignore this email or please contact us at <a href="mailto:connect@safemoon.com" style="color:#800080 !important">connect@safemoon.com</a> if you have any questions.<br><br></td></tr></tbody>
                                                        <tbody><tr><td class="issue">If you're having trouble with the button above, copy and paste the URL below into your web browser.</td></tr></tbody>
                                                        <tbody><tr><td>{{ $link }}</td></tr></tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td align="center" valign="top" class="section-footer">
                                    <table>
                                        <tbody><tr><td><img width="32" src="https://safemoon-connect.s3.amazonaws.com/assets/imgs/common/safemoon+logo.png" style="padding-bottom: 8px;" /></td></tr></tbody>
                                        <tbody><tr><td style="padding-bottom: 16px;">SafeMoon - Innovating for Good</td></tr></tbody>
                                        <tbody>
                                            <tr>
                                                <td class="social-icon">
                                                    <a href="https://facebook.com/safemoonofficial">
                                                        <img width="30" src="https://safemoon-connect.s3.amazonaws.com/assets/imgs/social_icons/facebook.png" />
                                                    </a>
                                                    <a href="https://www.instagram.com/safemoonhq">
                                                        <img width="30" src="https://safemoon-connect.s3.amazonaws.com/assets/imgs/social_icons/instagram.png" />
                                                    </a>
                                                    <a href="https://www.linkedin.com/company/safemoon">
                                                        <img width="30" src="https://safemoon-connect.s3.amazonaws.com/assets/imgs/social_icons/linkedin.png" />
                                                    </a>
                                                    <a href="http://youtube.com/safemoonhq">
                                                        <img width="30" src="https://safemoon-connect.s3.amazonaws.com/assets/imgs/social_icons/youtube.png" />
                                                    </a>
                                                    <a href="https://discord.gg/safemoon">
                                                        <img width="30" src="https://safemoon-connect.s3.amazonaws.com/assets/imgs/social_icons/discord.png" />
                                                    </a>
                                                    <a href="https://www.reddit.com/r/SafeMoon/">
                                                        <img width="30" src="https://safemoon-connect.s3.amazonaws.com/assets/imgs/social_icons/reddit.png" />
                                                    </a>
                                                    <a href="https://twitter.com/safemoon">
                                                        <img width="30" src="https://safemoon-connect.s3.amazonaws.com/assets/imgs/social_icons/twitter.png" />
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tbody><tr><td style="padding-bottom: 24px; font-size: 12px;">Welcome to SafeMoon! The SafeMoon Team.</td></tr></tbody>
                                        <tbody><tr><td><a class="link-sc" href="safemoon.com">SafeMoon.com</a></td></tr></tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    {{-- <script type="text/javascript" src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> --}}
</body>
</html>