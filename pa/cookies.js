function acceptCookies() {
    var date = new Date();
    date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000)); // définir la durée de validité du cookie à 1 an
    var expires = "expires=" + date.toUTCString();
    document.cookie = "acceptedCookies=true;" + expires + ";path=/"; // stocker le cookie avec la valeur "true"
    var cookieBanner = document.getElementById("cookie-banner");
    cookieBanner.style.display = "none"; // masquer la bannière une fois que le cookie est accepté
  }
  