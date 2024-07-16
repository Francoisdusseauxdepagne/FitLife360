document.addEventListener('DOMContentLoaded', (event) => {
    const objetField = document.getElementById('resiliation_objet');
    const contentField = document.getElementById('resiliation_content');
            console.log(contentField);
    const messages = {
    'Je souhaite changer de formule': 'Bonjour,\n\nJe vous écris pour demander la résiliation de mon abonnement actuel car je souhaite changer de formule. J\'ai trouvé que l\'offre actuelle ne correspond plus à mes besoins et je souhaiterais explorer d\'autres options.\n\nMerci de bien vouloir prendre en compte ma demande.\n\nCordialement,',
    'Je n\'ai plus besoin de vos services': 'Bonjour,\n\nJe vous informe de ma décision de résilier mon abonnement car je n\'ai plus besoin de vos services. Ma situation a évolué et je n\'utilise plus le service proposé.\n\nMerci de bien vouloir prendre en compte ma demande.\n\nCordialement,',
    'Je rencontre des difficultés financières': 'Bonjour,\n\nJe vous écris pour demander la résiliation de mon abonnement en raison de difficultés financières. Ma situation actuelle ne me permet plus de continuer à payer pour ce service.\n\nMerci de bien vouloir comprendre ma situation et de prendre en compte ma demande.\n\nCordialement,',
    'Je rencontre des problèmes techniques récurrents': 'Bonjour,\n\nJe souhaite résilier mon abonnement en raison de problèmes techniques récurrents. Malheureusement, malgré plusieurs tentatives de résolution, les problèmes persistent et affectent mon utilisation du service.\n\nMerci de bien vouloir prendre en compte ma demande.\n\nCordialement,',
    'Je suis insatisfait du service client': 'Bonjour,\n\nJe vous informe de ma décision de résilier mon abonnement car je suis insatisfait du service client. J\'ai rencontré plusieurs problèmes qui n\'ont pas été résolus de manière satisfaisante.\n\nMerci de bien vouloir prendre en compte ma demande.\n\nCordialement,',
    'Je n\'ai plus besoin de ce service actuellement': 'Bonjour,\n\nJe vous informe de ma décision de résilier mon abonnement car je n\'ai plus besoin de ce service actuellement. Mes besoins ont changé et je n\'utilise plus le service proposé.\n\nMerci de bien vouloir prendre en compte ma demande.\n\nCordialement,',
    'J\'ai trouvé une meilleure alternative': 'Bonjour,\n\nJe souhaite résilier mon abonnement car j\'ai trouvé une meilleure alternative qui correspond mieux à mes besoins actuels. Je vous remercie pour les services rendus jusqu\'à présent.\n\nMerci de bien vouloir prendre en compte ma demande.\n\nCordialement,',
    'Je rencontre des problèmes de facturation': 'Bonjour,\n\nJe souhaite résilier mon abonnement en raison de problèmes de facturation récurrents. Ces problèmes n\'ont pas été résolus de manière satisfaisante et affectent mon expérience utilisateur.\n\nMerci de bien vouloir prendre en compte ma demande.\n\nCordialement,',
    'Ma situation personnelle a changé': 'Bonjour,\n\nJe vous écris pour demander la résiliation de mon abonnement car ma situation personnelle a changé. En conséquence, je n\'ai plus besoin de ce service.\n\nMerci de bien vouloir comprendre ma situation et de prendre en compte ma demande.\n\nCordialement,'
    };

    objetField.addEventListener('change', (event) => {
        const selectedObjet = event.target.value;
        contentField.value = messages[selectedObjet] || '';
    });
});