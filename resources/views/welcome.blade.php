<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel 5.5 ReactJS CRUD Example</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <style>
        .loading-overlay {
            position: fixed;
            background: #000;
            opacity: 0.7;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 10000;
        }
        .glyphicon-refresh-animate {
            -animation: spin 1.1s infinite linear;
            -ms-animation: spin 1.1s infinite linear;
            -webkit-animation: spinw 1.1s infinite linear;
            -moz-animation: spinm 1.1s infinite linear;
            top: 150px;
            font-size: 100px;
        }

        @keyframes spin {
            from { transform: scale(1) rotate(0deg);}
            to { transform: scale(1) rotate(360deg);}
        }

        @-webkit-keyframes spinw {
            from { -webkit-transform: rotate(0deg);}
            to { -webkit-transform: rotate(360deg);}
        }

        @-moz-keyframes spinm {
            from { -moz-transform: rotate(0deg);}
            to { -moz-transform: rotate(360deg);}
        }
    </style>
</head>
<body>
<div id="loading"></div>
<div id="crud-app"></div>
<script src="{{asset('js/app6.js')}}"></script>

<!-- for Plaid Link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>

<script type="text/javascript">
    (function($) {
        handler = Plaid.create({
            clientName: 'Wholesale360 Books',
            env: 'sandbox',
            // Replace with your public_key from the Dashboard
            key: '35280f3ce8aba5a2e3d93a50cc9394',
            product: ['transactions'],
            // Optional, use webhooks to get transaction and error updates
            webhook: 'http://books.wholesale360.com',
            onLoad: function() {
                // Optional, called when Link loads
            },
            onSuccess: function(public_token, metadata) {
                // Send the public_token to your app server.
                // The metadata object contains info about the institution the
                // user selected and the account ID, if the Account Select view
                // is enabled.
                $.post('/credentials/store', {
                    public_token: public_token,
                    metadata: metadata
                });
            },
            onExit: function(err, metadata) {
                // The user exited the Link flow.
                if (err != null) {
                    // The user encountered a Plaid API error prior to exiting.
                }
                // metadata contains information about the institution
                // that the user selected and the most recent API request IDs.
                // Storing this information can be helpful for support.
            },
            onEvent: function(eventName, metadata) {
                // Optionally capture Link flow events, streamed through
                // this callback as your users connect an Item to Plaid.
                // For example:
                // eventName = "TRANSITION_VIEW"
                // metadata  = {
                //   link_session_id: "123-abc",
                //   mfa_type:        "questions",
                //   timestamp:       "2017-09-14T14:42:19.350Z",
                //   view_name:       "MFA",
                // }
            }
        })

        jQuery('#link-button').on('click', function(e) {
            handler.open();
        });
    })(jQuery);
</script>
</body>
</html>