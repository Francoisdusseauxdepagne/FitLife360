document.addEventListener('DOMContentLoaded', (event) => {
    const objetField = document.getElementById('contact_coach_objet');
    const contentField = document.getElementById('contact_coach_content');
    const messages = {
        'Je souhaite des informations': 'Bonjour,\n\nJe suis très intéressé(e) par vos séances de coaching en présentiel et j\'aimerais en savoir plus. Pourriez-vous me fournir des détails sur les types de séances que vous proposez, ainsi que vos tarifs et disponibilités ?\n\nMerci beaucoup pour votre réponse.\n\nCordialement',
'Je souhaite prendre un rendez-vous': 'Bonjour,\n\nJe souhaiterais réserver une séance de coaching en présentiel avec vous. Pourriez-vous me faire savoir vos créneaux disponibles afin que nous puissions fixer un rendez-vous ? Je suis impatient(e) de commencer et de bénéficier de votre expertise.\n\nMerci beaucoup pour votre aide.\n\nCordialement',
    }
    objetField.addEventListener('change', (event) => {
        const selectedObjet = event.target.value;
        contentField.value = messages[selectedObjet] || '';
    });
});