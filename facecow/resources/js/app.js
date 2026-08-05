import 'bootstrap';
import Swal from 'sweetalert2';
import DataTable from 'datatables.net-bs5';

// Exponer Swal y DataTable globalmente
window.Swal = Swal;
window.DataTable = DataTable;

// --- GESTIÓN DE TEMA CLARO / OSCURO ---
document.addEventListener('DOMContentLoaded', () => {
    const themeToggleBtn = document.getElementById('theme-toggle');
    const currentTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    
    // Aplicar tema inicial
    document.documentElement.setAttribute('data-mode', currentTheme);
    updateThemeIcon(currentTheme);

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            const activeTheme = document.documentElement.getAttribute('data-mode');
            const newTheme = activeTheme === 'dark' ? 'light' : 'dark';
            
            document.documentElement.setAttribute('data-mode', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        });
    }
});

function updateThemeIcon(theme) {
    const themeIcon = document.getElementById('theme-toggle-icon');
    if (themeIcon) {
        if (theme === 'dark') {
            themeIcon.className = 'bi bi-sun-fill text-warning';
        } else {
            themeIcon.className = 'bi bi-moon-stars-fill text-primary';
        }
    }
}
