let lastClickTime = 0;

const selectElement = document.getElementById('estados');

selectElement.addEventListener('click', function () {
    const currentTime = new Date().getTime();
    if (currentTime - lastClickTime < 300) {
        this.size = this.size === 1 ? this.length : 1;
    }
    lastClickTime = currentTime;
});

selectElement.addEventListener('change', function () {
    this.size = 1;
});