import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';


// Styles globaux (si nécessaire)
import './styles/app.scss';

// Démarrage de Stimulus (si utilisé)
import './bootstrap';

// Configuration de FullCalendar
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
        plugins: [ dayGridPlugin, interactionPlugin ],
        initialView: 'dayGridMonth',
        dateClick: function(info) {
            openReservationForm(info.dateStr);
        },
        events: '/reservations',
        eventColor: '#ff0000',
        selectable: true,
        selectOverlap: function(event) {
            return event.rendering === 'background';
        }
    });

    calendar.render();

    // Fonction pour ouvrir le formulaire de réservation
    function openReservationForm(date) {
        fetch('/reservation/form?date=' + date)
            .then(response => response.text())
            .then(html => {
                document.getElementById('reservationFormContainer').innerHTML = html;
                document.getElementById('reservationModal').style.display = 'block';
            })
            .catch(error => console.warn('Error fetching the form:', error));
    }

    // Fermer la modal
    document.querySelector('.close').onclick = function() {
        document.getElementById('reservationModal').style.display = 'none';
    };

    // Fermer la modal en cliquant en dehors de celle-ci
    window.onclick = function(event) {
        if (event.target === document.getElementById('reservationModal')) {
            document.getElementById('reservationModal').style.display = 'none';
        }
    };
});