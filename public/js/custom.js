document.addEventListener('DOMContentLoaded', function () {
    if (window.AOS) {
        AOS.init({ duration: 550, once: true, offset: 40, easing: 'ease-out-cubic' });
    }

    // Auto-dismiss flash alerts setelah 4.5 detik
    document.querySelectorAll('.alert-auto-dismiss').forEach(function (alertEl) {
        setTimeout(function () {
            if (window.bootstrap) {
                var alert = bootstrap.Alert.getOrCreateInstance(alertEl);
                alert.close();
            } else {
                alertEl.remove();
            }
        }, 4500);
    });

    // Animate numeric stat values counting up on first paint
    document.querySelectorAll('.stat-value[data-count]').forEach(function (el) {
        var raw = el.getAttribute('data-count');
        var target = parseFloat(raw.replace(/[^0-9.-]/g, ''));
        if (isNaN(target)) return;
        var prefix = el.getAttribute('data-prefix') || '';
        var suffix = el.getAttribute('data-suffix') || '';
        var duration = 700;
        var start = null;
        function step(ts) {
            if (!start) start = ts;
            var progress = Math.min((ts - start) / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 3);
            var value = Math.round(target * eased);
            el.textContent = prefix + value.toLocaleString('id-ID') + suffix;
            if (progress < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    });

    // Subtle ripple feedback on primary buttons
    document.querySelectorAll('.btn').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            var circle = document.createElement('span');
            var rect = btn.getBoundingClientRect();
            var size = Math.max(rect.width, rect.height);
            circle.style.cssText = [
                'position:absolute', 'border-radius:50%', 'pointer-events:none',
                'width:' + size + 'px', 'height:' + size + 'px',
                'left:' + (e.clientX - rect.left - size / 2) + 'px',
                'top:' + (e.clientY - rect.top - size / 2) + 'px',
                'background:rgba(255,255,255,.45)', 'transform:scale(0)',
                'transition:transform .5s ease, opacity .5s ease', 'opacity:1'
            ].join(';');
            if (getComputedStyle(btn).position === 'static') btn.style.position = 'relative';
            btn.style.overflow = 'hidden';
            btn.appendChild(circle);
            requestAnimationFrame(function () { circle.style.transform = 'scale(2.2)'; circle.style.opacity = '0'; });
            setTimeout(function () { circle.remove(); }, 520);
        });
    });
});
