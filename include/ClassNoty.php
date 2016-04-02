<script type="text/javascript">
        $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Welcome to Engine Maintenance Aplication!',
            // (string | mandatory) the text inside the notification
            text: 'You Have <a href="enginrun.html" target="_blank" style="color:#ffd777">BlackTie.co</a> Engine Need Maintenance.',
            // (string | optional) the image to display on the left
            image: 'img/eng.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
	</script>