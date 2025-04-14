document.addEventListener('DOMContentLoaded', function() {
    // Confirmación para acciones de eliminación
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('¿Está seguro que desea eliminar este elemento?')) {
                e.preventDefault();
            }
        });
    });

    // Manejo de subida de imágenes
    const imageInputs = document.querySelectorAll('input[type="file"]');
    imageInputs.forEach(input => {
        input.addEventListener('change', function() {
            const preview = this.nextElementSibling;
            if (preview && preview.classList.contains('image-preview')) {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            }
        });
    });

    // Validación de formularios
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                } else {
                    field.classList.remove('error');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Por favor complete todos los campos requeridos');
            }
        });
    });

    // Mensajes de alerta automáticos
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        if (alert.classList.contains('auto-dismiss')) {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }, 5000);
        }
    });

    // Toggle para menú móvil
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const adminNav = document.querySelector('.admin-nav');
    
    if (mobileMenuBtn && adminNav) {
        mobileMenuBtn.addEventListener('click', function() {
            adminNav.classList.toggle('show');
        });
    }
}); 