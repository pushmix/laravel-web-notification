{{-- Pushmix Opt In Prompt --}}
<script type="text/javascript">
    var _pm = {
        "subscriber_id": "{{config('pushmix.subscription_id')}}",
        "sw" : "{{url('pm_service_worker.js')}}",
        "api": "https://www.pushmix.co.uk/api/"
    };
    (function(){
        var block = document.createElement('script');
        block.type = 'text/javascript';
        block.async = false;
        block.defer = true;
        block.src = 'https://www.pushmix.co.uk/js/pm.js';
        var el = document.getElementsByTagName('script')[0];
        el.parentNode.insertBefore(block, el);
    })();  
</script> 
{{-- End Pushmix Opt In Prompt --}}