<!DOCTYPE html>  
<html>
<head>  
  <title>Omnes Immobilier - Listings</title>  
  <meta charset="utf-8" />  
  <link href="prime.css" rel="stylesheet" type="text/css"/>  
  <style>
    #nav div {
      display: inline-block;
    }
  </style>
</head>  
<body>  
  <h1 class="logo"> 
    <img src="primelogo.gif" alt="Omnes Immobilier Logo" height="90" width="400"/>
  </h1>  

  <div id="nav">  
    <div id="homeNav"><a href="index.html"><img src="primehomenav.gif" alt="Home" /></a></div>
    <div id="listingsNav"><a href="listings.html"><img src="primelistingsnav.gif" alt="Listings" /></a></div>
    <div id="financingNav"><a href="financing.html"><img src="primefinancingnav.gif" alt="Financing" /></a></div>
    <div id="contactNav"><a href="contact.html"><img src="primecontactnav.gif" alt="Contact" /></a></div>
    <div id="accountNav"><a href="account.html">Votre Compte</a></div>
  </div>  

  <h2>Votre Compte</h2>
  <div id="account">
    <h3>Informations du Client</h3>
    <p>Nom et Prénom: Jean Dupont</p>
    <p>Adresse: 123 Rue Exemple, Appartement 4B</p>
    <p>Email: jean.dupont@example.com</p>
    <div id="financialInfo" style="display:none;">
      <p>Informations financières: [Cachées]</p>
    </div>

    <h3>Historique des Consultations</h3>
    <ul>
      <li>Consultation du 01/06/2024 avec l'agent Marie Curie</li>
      <li>Consultation du 15/05/2024 avec l'agent Pierre Curie</li>
    </ul>

    <h3>Rendez-vous à venir</h3>
    <ul>
      <li>Rendez-vous du 15/06/2024 avec l'agent Louis Pasteur <button onclick="cancelAppointment()">Annuler ce RDV</button></li>
    </ul>
  </div>

  <h2>Services de Paiement</h2>
  <div id="payment">
    <form action="process_payment.html" method="post">
      <h3>Coordonnées</h3>
      <label for="name">Nom et Prénom:</label>
      <input type="text" id="name" name="name"><br>
      <label for="address1">Adresse Ligne 1:</label>
      <input type="text" id="address1" name="address1"><br>
      <label for="address2">Adresse Ligne 2:</label>
      <input type="text" id="address2" name="address2"><br>
      <label for="city">Ville:</label>
      <input type="text" id="city" name="city"><br>
      <label for="zipcode">Code Postal:</label>
      <input type="text" id="zipcode" name="zipcode"><br>
      <label for="country">Pays:</label>
      <input type="text" id="country" name="country"><br>
      <label for="phone">Numéro de téléphone:</label>
      <input type="text" id="phone" name="phone"><br>
      
      <h3>Informations de Paiement</h3>
      <label for="cardType">Type de carte de paiement:</label>
      <select id="cardType" name="cardType">
        <option value="visa">Visa</option>
        <option value="mastercard">MasterCard</option>
        <option value="amex">American Express</option>
        <option value="paypal">PayPal</option>
      </select><br>
      <label for="cardNumber">Numéro de la carte:</label>
      <input type="text" id="cardNumber" name="cardNumber"><br>
      <label for="cardName">Nom affiché sur la carte:</label>
      <input type="text" id="cardName" name="cardName"><br>
      <label for="cardExpiry">Date d'expiration de la carte:</label>
      <input type="text" id="cardExpiry" name="cardExpiry"><br>
      <label for="cardSecurity">Code de sécurité:</label>
      <input type="text" id="cardSecurity" name="cardSecurity"><br>
      
      <button type="submit">Payer</button>
    </form>
  </div>

  <div id="footer">
    Copyright &copy; 2024 Omnes Immobilier<br />  
    <a href="mailto:prime.properties@gmail.com">prime.properties@gmail.com</a>  
  </div>  

  <script>
    function cancelAppointment() {
      alert("Votre rendez-vous a été annulé.");
      // Code pour annuler le rendez-vous dans le système
    }
  </script>
</body>  
</html>
