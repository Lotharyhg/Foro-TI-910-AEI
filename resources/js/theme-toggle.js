// Archivo JavaScript actualizado con mejoras de robustez y mantenimiento

function updateIcons(theme) {
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');
    const darkIconMobile = document.getElementById('theme-toggle-dark-icon-mobile');
    const lightIconMobile = document.getElementById('theme-toggle-light-icon-mobile');

    if (theme === 'dark') {
        darkIcon?.classList.remove('hidden');
        lightIcon?.classList.add('hidden');
        darkIconMobile?.classList.remove('hidden');
        lightIconMobile?.classList.add('hidden');
    } else {
        darkIcon?.classList.add('hidden');
        lightIcon?.classList.remove('hidden');
        darkIconMobile?.classList.add('hidden');
        lightIconMobile?.classList.remove('hidden');
    }
}

function applyTheme(theme) {
    const html = document.documentElement;

    if (theme === 'dark') {
        html.classList.add('dark');
    } else {
        html.classList.remove('dark');
    }

    updateIcons(theme);
}

function toggleTheme() {
    const html = document.documentElement;
    const currentTheme = html.classList.contains('dark') ? 'dark' : 'light';
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

    applyTheme(newTheme);
    localStorage.setItem('theme', newTheme);
}

function initTheme() {
    const savedTheme = localStorage.getItem('theme');

    if (savedTheme) {
        applyTheme(savedTheme);
    } else {
        applyTheme('light');
    }
}

function initThemeButtons() {
    const desktopButton = document.getElementById('theme-toggle');
    const mobileButton = document.getElementById('theme-toggle-mobile');

    if (desktopButton && !desktopButton.dataset.bound) {
        desktopButton.addEventListener('click', toggleTheme);
        desktopButton.dataset.bound = 'true';
    }

    if (mobileButton && !mobileButton.dataset.bound) {
        mobileButton.addEventListener('click', toggleTheme);
        mobileButton.dataset.bound = 'true';
    }
}

function observeButtons() {
    const observer = new MutationObserver(() => {
        initThemeButtons();
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
}

// Inicialización principal
initTheme();
initThemeButtons();
observeButtons();

// Exposición global para posibles usos externos
window.toggleTheme = toggleTheme;
window.initThemeButtons = initThemeButtons;

// Eliminar duplicado de listener con lógica repetida
// Ya se maneja con initThemeButtons y toggleTheme correctamente

