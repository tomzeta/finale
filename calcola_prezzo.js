document.costo_biglietti.onclick = function () {
    var price = 35;
    var radVal = document.costo_biglietti.num_tickets.value;
    result.innerHTML = '<p>Prezzo: </p>' + (radVal * price) + "&#8364;";
};