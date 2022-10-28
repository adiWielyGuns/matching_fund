<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('54492e6a46bf5094ea6e', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('cashiers');

</script>
