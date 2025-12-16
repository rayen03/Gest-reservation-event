
document.addEventListener('DOMContentLoaded', function() {
    
 
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    });

    // Reservation form validation
    const reservationForm = document.getElementById('reservationForm');
    if (reservationForm) {
        reservationForm.addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();

            let errors = [];

            
            if (name.length < 3) {
                errors.push('Le nom doit contenir au moins 3 caractères');
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                errors.push('Email invalide');
            }

            
            const phoneRegex = /^[\d\s\+\-\(\)]{8,20}$/;
            if (!phoneRegex.test(phone)) {
                errors.push('Numéro de téléphone invalide (8-20 caractères)');
            }

            if (errors.length > 0) {
                e.preventDefault();
                alert('Erreurs de validation:\n\n' + errors.join('\n'));
                return false;
            }

         
            if (!confirm('Confirmer votre réservation?')) {
                e.preventDefault();
                return false;
            }
        });
    }

    // Event form validation admin
    const eventForm = document.querySelector('.event-form');
    if (eventForm) {
        eventForm.addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            const description = document.getElementById('description').value.trim();
            const date = document.getElementById('date').value;
            const location = document.getElementById('location').value.trim();
            const seats = parseInt(document.getElementById('seats').value);

            let errors = [];

            if (title.length < 3) {
                errors.push('Le titre doit contenir au moins 3 caractères');
            }

            if (description.length < 10) {
                errors.push('La description doit contenir au moins 10 caractères');
            }

            if (!date) {
                errors.push('La date est requise');
            } else {
                const eventDate = new Date(date);
                const now = new Date();
                if (eventDate < now) {
                    errors.push('La date ne peut pas être dans le passé');
                }
            }

            if (!location) {
                errors.push('Le lieu est requis');
            }

            if (isNaN(seats) || seats < 1) {
                errors.push('Le nombre de places doit être un entier positif');
            }

            if (errors.length > 0) {
                e.preventDefault();
                alert('Erreurs de validation:\n\n' + errors.join('\n'));
                return false;
            }
        });
    }


    const deleteLinks = document.querySelectorAll('a[href*="delete"]');
    deleteLinks.forEach(link => {
        if (!link.hasAttribute('onclick')) {
            link.addEventListener('click', function(e) {
                if (!confirm('Êtes-vous sûr de vouloir supprimer cet élément?')) {
                    e.preventDefault();
                    return false;
                }
            });
        }
    });


    const dateInputs = document.querySelectorAll('input[type="datetime-local"]');
    dateInputs.forEach(input => {
        if (!input.value) {
         
            const now = new Date();
            const offset = now.getTimezoneOffset() * 60000;
            const localISOTime = (new Date(now - offset)).toISOString().slice(0, 16);
            input.min = localISOTime;
        }
    });


    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Chargement...';
            }
        });
    });

    //  row highligh
    const tableRows = document.querySelectorAll('.admin-table tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('click', function(e) {
            if (!e.target.closest('a') && !e.target.closest('button')) {
                this.style.backgroundColor = '#f1f5f9';
                setTimeout(() => {
                    this.style.backgroundColor = '';
                }, 200);
            }
        });
    });

    console.log('✅ MiniEvent JavaScript loaded successfully');
});
