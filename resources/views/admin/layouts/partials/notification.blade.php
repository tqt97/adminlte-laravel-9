@if (Session::has('message'))
    <div id="pageMessages"></div>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
    <style>
        #pageMessages {
            position: fixed;
            top: 15px;
            right: 15px;
            width: 28rem;
            z-index: 9999;
        }

        .alert {
            position: relative;
            padding: 0.25rem 1.25rem !important;
        }

        .alert .close {
            position: absolute;
            top: 5px;
            right: 5px;
            font-size: 1em;
        }

        .alert .fa {
            margin-right: .3em;
        }

        #pageMessages p {
            margin-bottom: 0px !important;
        }
    </style>

    <script>
        // title, summary, details, severity, dismissible, autoDismiss, appendToId
        function createAlert(title, summary, details, severity, dismissible, autoDismiss, appendToId) {
            var iconMap = {
                info: "fa fa-info-circle fa-xs",
                success: "fa fa-thumbs-up fa-xs",
                warning: "fa fa-exclamation-triangle fa-xs",
                danger: "fa ffa fa-exclamation-circle fa-xs"
            };

            var iconAdded = false;

            var alertClasses = ["alert", "animated", "flipInX"];
            alertClasses.push("alert-" + severity.toLowerCase());

            if (dismissible) {
                alertClasses.push("alert-dismissible");
            }

            var msgIcon = $("<i />", {
                "class": iconMap[severity] // you need to quote "class" since it's a reserved keyword
            });

            var msg = $("<div />", {
                "class": alertClasses.join(" ") // you need to quote "class" since it's a reserved keyword
            });

            if (title) {
                var msgTitle = $("<h5 />", {
                    html: title
                }).appendTo(msg);

                if (!iconAdded) {
                    msgTitle.prepend(msgIcon);
                    iconAdded = true;
                }
            }

            if (summary) {
                var msgSummary = $("<strong />", {
                    html: summary
                }).appendTo(msg);

                if (!iconAdded) {
                    msgSummary.prepend(msgIcon);
                    iconAdded = true;
                }
            }

            if (details) {
                var msgDetails = $("<p />", {
                    html: details
                }).appendTo(msg);

                if (!iconAdded) {
                    msgDetails.prepend(msgIcon);
                    iconAdded = true;
                }
            }


            if (dismissible) {
                var msgClose = $("<span />", {
                    "class": "close", // you need to quote "class" since it's a reserved keyword
                    "data-dismiss": "alert",
                    html: "<i class='fa fa-times-circle'></i>"
                }).appendTo(msg);
            }

            $('#' + appendToId).prepend(msg);

            if (autoDismiss) {
                setTimeout(function() {
                    msg.addClass("flipOutX");
                    setTimeout(function() {
                        msg.remove();
                    }, 1000);
                }, 3000);
            }
        }
        createAlert('Success', '', '{{ Session::get('message') }}.', 'success', true, true,
            'pageMessages');
    </script>

    {{-- <script>
        $(document).ready(function() {
            @if (Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}"
                switch (type) {

                    case 'info':
                        Toast.fire({
                            icon: 'info',
                            title: '{{ Session::get('message') }}'
                        })
                        break;

                    case 'success':
                        Toast.fire({
                            icon: 'success',
                            title: '{{ Session::get('message') }}'
                        })
                        break;

                    case 'warning':
                        Toast.fire({
                            icon: 'warning',
                            title: '{{ Session::get('message') }}'
                        })
                        break;
                    case 'error':
                        Toast.fire({
                            icon: 'error',
                            title: '{{ Session::get('message') }}'
                        })
                        break;
                    case 'question':
                        Toast.fire({
                            icon: 'question',
                            title: '{{ Session::get('message') }}'
                        })
                        break;
                }
            @endif
        });
    </script> --}}
@endif
