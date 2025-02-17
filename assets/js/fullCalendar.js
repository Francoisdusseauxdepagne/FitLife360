import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import frLocale from '@fullcalendar/core/locales/fr'; // Importation de la langue française

document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.querySelector('#calendar');

    let calendar = new Calendar(calendarEl, {
        plugins: [ dayGridPlugin, interactionPlugin ],
        initialView: 'dayGridMonth',
        locale: frLocale, // Configuration de la langue française
        dateClick: function(info) {
            openReservationForm(info.dateStr);
        },
        events: '/reservations',
        eventColor: '#E73725',
        eventBorderColor: '#E73725',
        eventBackgroundColor: '#E73725',
        selectable: true,
        selectOverlap: function(event) {
            return event.rendering === 'background';
        },
    });

    calendar.render();

    // Fonction pour ouvrir le formulaire de réservation
    function openReservationForm(date) {
        fetch('/reservation/form?date=' + date)
            .then(response => response.text())
            .then(html => {
                document.querySelector('#reservationFormContainer').innerHTML = html;
                document.querySelector('#reservationModal').style.display = 'block';
            })
            .catch(error => console.warn('Error fetching the form:', error));
    }

    // Fermer la modal
    document.querySelector('.close').onclick = function() {
        document.querySelector('#reservationModal').style.display = 'none';
    };

    // Fermer la modal en cliquant en dehors de celle-ci
    window.onclick = function(event) {
        if (event.target === document.querySelector('#reservationModal')) {
            document.querySelector('#reservationModal').style.display = 'none';
        }
    };
});