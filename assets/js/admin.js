// Toggle Sidebar
$(document).ready(function() {
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
});

// File Upload Preview
function readURL(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            $(previewId).attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Form Validation
function validateForm(formId) {
    let isValid = true;
    const form = $(formId);
    
    form.find('input[required], select[required], textarea[required]').each(function() {
        if (!$(this).val()) {
            isValid = false;
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });
    
    return isValid;
}

// Image Upload Handler
function handleImageUpload(input, previewId, maxSize = 2) {
    const file = input.files[0];
    const maxSizeMB = maxSize * 1024 * 1024;
    
    if (file) {
        if (file.size > maxSizeMB) {
            alert(`El archivo es demasiado grande. El tamaño máximo permitido es ${maxSize}MB.`);
            input.value = '';
            return false;
        }
        
        if (!file.type.match('image.*')) {
            alert('Por favor, seleccione un archivo de imagen válido.');
            input.value = '';
            return false;
        }
        
        readURL(input, previewId);
        return true;
    }
    
    return false;
}

// Toggle Status
function toggleStatus(url, id) {
    if (confirm('¿Estás seguro de que deseas cambiar el estado?')) {
        $.ajax({
            url: url,
            type: 'POST',
            data: { id: id },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert('Error al cambiar el estado.');
                }
            },
            error: function() {
                alert('Error al cambiar el estado.');
            }
        });
    }
}

// Delete Item
function deleteItem(url, id) {
    if (confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
        $.ajax({
            url: url,
            type: 'POST',
            data: { id: id },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert('Error al eliminar el elemento.');
                }
            },
            error: function() {
                alert('Error al eliminar el elemento.');
            }
        });
    }
}

// Sortable Tables
function makeTableSortable(tableId) {
    $(tableId).DataTable({
        "order": [[0, "desc"]],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        }
    });
}

// Initialize Tooltips
$(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

// Initialize Popovers
$(function() {
    $('[data-toggle="popover"]').popover();
});

// Auto-hide Alerts
$(document).ready(function() {
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
});

// Form Submit Handler
$(document).ready(function() {
    $('form').on('submit', function(e) {
        if (!validateForm(this)) {
            e.preventDefault();
            return false;
        }
    });
});

// File Input Customization
$(document).ready(function() {
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').html(fileName);
    });
});

// Password Strength Meter
function checkPasswordStrength(password) {
    let strength = 0;
    
    if (password.length >= 8) strength++;
    if (password.match(/[a-z]+/)) strength++;
    if (password.match(/[A-Z]+/)) strength++;
    if (password.match(/[0-9]+/)) strength++;
    if (password.match(/[^a-zA-Z0-9]+/)) strength++;
    
    return strength;
}

// Initialize Summernote
$(document).ready(function() {
    $('.summernote').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});

// Initialize Select2
$(document).ready(function() {
    $('.select2').select2({
        theme: 'bootstrap4'
    });
});

// Handle Modal Forms
$(document).ready(function() {
    $('.modal').on('shown.bs.modal', function() {
        $(this).find('input[type="text"]').first().focus();
    });
});

// Prevent Double Form Submission
$(document).ready(function() {
    $('form').submit(function() {
        if ($(this).data('submitted') === true) {
            return false;
        } else {
            $(this).data('submitted', true);
            return true;
        }
    });
}); 