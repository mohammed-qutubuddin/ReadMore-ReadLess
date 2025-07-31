function rmsc_toggle_content(wrapperId) {
    var wrapper = document.getElementById(wrapperId);
    if (!wrapper) return;

    var content = wrapper.querySelector('.rmsc-readmore-content');
    var btn = wrapper.querySelector('.rmsc-readmore-btn');
    var moreText = btn.getAttribute('data-more') || 'Read More';
    var lessText = btn.getAttribute('data-less') || 'Read Less';

    if (!wrapper.classList.contains('rmsc-active')) {
        wrapper.classList.add('rmsc-active');
        content.style.height = content.scrollHeight + "px";
        btn.textContent = lessText;

        function transitionEnd(e) {
            if (e.propertyName === 'height' && wrapper.classList.contains('rmsc-active')) {
                content.style.height = "auto";
                content.removeEventListener('transitionend', transitionEnd);
            }
        }
        content.addEventListener('transitionend', transitionEnd);
    } else {
        content.style.height = content.scrollHeight + "px";
        void content.offsetHeight;
        content.style.height = "0";
        wrapper.classList.remove('rmsc-active');
        btn.textContent = moreText;
    }
}
