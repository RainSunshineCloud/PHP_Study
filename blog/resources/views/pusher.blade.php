<!DOCTYPE html>
<head>
    <title>Pusher Test</title>
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('7598596b02094585116d', {
            cluster: 'ap1',
            encrypted: true
        });

        var channel = pusher.subscribe('my-chennel');
        channel.bind('my-event', function(data) {
            alert(data.message);
        });
    </script>
</head>