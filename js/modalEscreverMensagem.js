function toggleSubmitButton() {
    var destinatarioSelect = document.getElementById("pDestinatario");
    var submitButton = document.getElementById("submitButton");

    submitButton.classList.remove("btn-success");
    submitButton.classList.add("btn-primary");

    if (destinatarioSelect.value === "0") {
        submitButton.disabled = true;
    } else {
        submitButton.disabled = false;
    }
}