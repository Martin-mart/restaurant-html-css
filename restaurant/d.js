fetch("http://127.0.0.1:8000/process_reservation.php", {
    method: "POST",
    body: new FormData(document.getElementById("reservationForm")),
})
.then(response => response.json())
.then(data => alert(data.message));
