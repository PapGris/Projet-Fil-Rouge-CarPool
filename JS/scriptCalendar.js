// CALENDRIER

function calendrier() {
    let aujourdhui = new Date();
    let formattedDate = aujourdhui.toISOString().split('T')[0]; 
    document.getElementById("date").value = formattedDate; 
}

calendrier(); 