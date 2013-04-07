Tietokantasovellus - Harjoituskirjanpito aihemaarittely
=======================================================

Jarjestelman tarkoitus

Harjoituskirjanpitojarjestelman avulla kayttaja pystyy pitamaan 
kirjaa omista treeneistaan, joissa han kay. Kayttajan 
on mahdollista luoda itselleen omia lajiprofiileita ja lisata niiden 
perusteella itselleen harjoituskertoja.

Tietokannassa lajit on listattu omassa lajitaulussaan. Kayttaja 
pystyy luomaan itselleen myos oman kayttajaprofiilin, jolla han 
kirjautuu jarjestelmaan.

Harjoituskerta liittyy johonkin tiettyyn alkamisaikaan ja 
harjoituspaivaan. Harjoituskertaan pystyy ilmoittamaan kuvauksen 
harjoituksesta, harjoituksen keston ja vaikeusasteen.

Harjoituskerroista jokainen kayttaja voi antaa itselleen arvion, jonka avulla 
kayttaja voi arvioida, millainen harjoitus oli. Arviossa voi antaa 
numeroarvosanan harjoituksesta ja tyytyvaisyydesta harjoitukseen. 
Lisaksi harjoituskertaa voi arvioida sanallisesti.



Toteutus ja toimintaymparisto

Tietokanta toteutetaan PostreSQL-tietokantana users.cs.helsinki.fi -
palvelimelle. Tietokanta toimii samalla palvelimella 
web-sovelluksena, joka toteutetaan php- ja html-kielilla.