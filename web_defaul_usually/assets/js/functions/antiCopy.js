if (nonecopy == 1) {
    document.oncontextmenu = function() { return false; };
    document.onselectstart = function() { return false; };

    $(document).keydown(function(event) {
        // Chặn Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U, F12
        if ((event.ctrlKey && event.shiftKey && (event.keyCode == 73 || event.keyCode == 74)) ||
            (event.ctrlKey && event.keyCode == 85) ||
            (event.keyCode == 123)) {
            return false;
        }
        // Chặn Ctrl + S
        if (event.keyCode == 83 && (navigator.platform.match("Mac") ? event.metaKey : event.ctrlKey)) {
            return false;
        }
    });
}