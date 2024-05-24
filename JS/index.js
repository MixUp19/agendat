document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        document.getElementById('logo').style.opacity = '1';
        document.getElementById('logo').style.transform = 'translateY(0)';
    }, 500);
    setTimeout(function() {
        document.querySelector('h1').style.opacity = '1';
        document.querySelector('h1').style.transform = 'translateY(0)';
    }, 1000);
    setTimeout(function() {
        document.getElementById('login-btn').style.opacity = '1';
        document.getElementById('login-btn').style.transform = 'translateY(0)';
    }, 1500);
});

