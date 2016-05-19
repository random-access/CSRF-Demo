<script>
    // remove get parameters on page load
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }

    // fade out alert messages after 3 seconds
    window.setTimeout(function() {
        $(".alert-message").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();
        });
    }, 3000);
</script>
