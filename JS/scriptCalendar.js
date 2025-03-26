// CALENDRIER

function calendrier() {
    let aujourdhui = new Date();
    let formattedDate = aujourdhui.toISOString().split('T')[0]; // Format YYYY-MM-DD
    document.getElementById("date").value = formattedDate; // Met la date du jour par défaut
}

calendrier(); // Met la date du jour par défaut