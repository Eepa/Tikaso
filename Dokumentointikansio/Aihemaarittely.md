Tietokantasovellus AIHEMAARITTELY
=================================

Jarjestelman tarkoitus

Harjoituskirjanpitojarjestelman avulla kayttaja pystyy pitamaan 
kirjaa omista treeneistaan, joissa han kay. Jarjestelmaan kayttajan 
on mahdollista luoda itselleen omia lajiprofiileita ja lisata niiden 
perusteella itselleen harjoituskertoja.

Tietokannassa lajit on listattu omassa lajitaulussaan. Kayttaja 
pystyy luomaan itselleen myos oman kayttajaprofiilin, jos han 
kirjautuu jarjestelmaan.

Harjoituskerta liittyy johonkin tiettyyn alkamisaikaan ja 
harjoituspaivaan. Harjoituskertaan pystyy ilmoittamaan kuvauksen 
harjoituksesta, harjoituksen keston ja vaikeusasteen.

Harjoituskerroista voi antaa arvioita, joita jokainen kayttaja voi 
antaa itselleen tai jollekin muulle kayttajalle. Arvioissa voi antaa 
numeroarvosanan harjoituksesta ja tyytyvaisyydesta harjoitukseen. 
Lisaksi harjoituskertaa voi arvioida sanallisesti.



Toteutus ja toimintaymparisto

Tietokanta toteutetaan PostreSQL-tietokantana users.cs.helsinki.fi -
palvelimelle. Tietokanta toimii samalla palvelimella 
web-sovelluksena, joka toteutetaan php- ja html-kielilla.