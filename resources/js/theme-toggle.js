// theme-toggle.js
document.addEventListener('DOMContentLoaded', () => {
    const html = document.documentElement;
    
    // Función para actualizar iconos
    const updateIcons = (theme) => {
        // Iconos para desktop
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');
        
        // Iconos para mobile
        const darkIconMobile = document.getElementById('theme-toggle-dark-icon-mobile');
        const lightIconMobile = document.getElementById('theme-toggle-light-icon-mobile');
        
        if (theme === 'dark') {
            // Mostrar icono de luna (modo oscuro activo)
            if (darkIcon && lightIcon) {
                darkIcon.classList.remove('hidden');
                lightIcon.classList.add('hidden');
            }
            if (darkIconMobile && lightIconMobile) {
                darkIconMobile.classList.remove('hidden');
                lightIconMobile.classList.add('hidden');
            }
        } else {
            // Mostrar icono de sol (modo claro activo)
            if (darkIcon && lightIcon) {
                darkIcon.classList.add('hidden');
                lightIcon.classList.remove('hidden');
            }
            if (darkIconMobile && lightIconMobile) {
                darkIconMobile.classList.add('hidden');
                lightIconMobile.classList.remove('hidden');
            }
        }
    };

    // Función para aplicar el tema
    const applyTheme = (theme) => {
        if (theme === 'dark') {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }
        updateIcons(theme);
    };

    // Detectar tema inicial
    const initTheme = () => {
        const savedTheme = localStorage.getItem('theme');
        
        if (savedTheme) {
            applyTheme(savedTheme);
        } else {
            // Si no hay preferencia guardada, usar la del sistema
            const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const initialTheme = systemPrefersDark ? 'dark' : 'light';
            applyTheme(initialTheme);
        }
    };

    // Inicializar tema
    initTheme();

    // Escuchar cambios en las preferencias del sistema
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        // Solo aplicar si no hay preferencia guardada
        if (!localStorage.getItem('theme')) {
            applyTheme(e.matches ? 'dark' : 'light');
        }
    });

    // Función para toggle del tema
    const toggleTheme = () => {
        const currentTheme = html.classList.contains('dark') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        applyTheme(newTheme);
        localStorage.setItem('theme', newTheme);
    };

    // Función para inicializar botones de tema
    const initThemeButtons = () => {
        const themeToggleButton = document.getElementById('theme-toggle');
        const themeToggleButtonMobile = document.getElementById('theme-toggle-mobile');

        // Manejar click del botón desktop
        if (themeToggleButton) {
            themeToggleButton.addEventListener('click', toggleTheme);
        }

        // Manejar click del botón mobile
        if (themeToggleButtonMobile) {
            themeToggleButtonMobile.addEventListener('click', toggleTheme);
        }
    };

    // Inicializar botones
    initThemeButtons();

    // Función global para ser usada desde cualquier vista
    window.toggleTheme = toggleTheme;
    window.initThemeButtons = initThemeButtons;
    
    // Observar cambios en el DOM para nuevos botones
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.type === 'childList') {
                mutation.addedNodes.forEach((node) => {
                    if (node.nodeType === 1) { // Element node
                        if (node.id === 'theme-toggle' || node.id === 'theme-toggle-mobile') {
                            initThemeButtons();
                        }
                    }
                });
            }
        });
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});