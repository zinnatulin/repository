window.onload = function(){
    var progressLine = document.getElementById('progress-line');
    var varbody = document.body;
    var viewportHeight = window.innerHeight;
    var documentHeight = Math.max(varbody.scrollHeight, varbody.offsetHeight, varbody.clientHeight);
    var scrollTopValue = function () {
        return (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body)
            .scrollTop;
    }

    window.addEventListener("scroll", function () {
        var scroll = scrollTopValue();
        var progress = (scroll / (documentHeight - viewportHeight)) * 100;
        progressLine.style.width = progress + '%';
    });
    
    window.addEventListener('resize', function () {
        documentHeight = Math.max(varbody.scrollHeight, varbody.offsetHeight, varbody.clientHeight);
    })
}