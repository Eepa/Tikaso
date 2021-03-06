Tietokantasovellus - Harjoituskirjanpito aihemaarittely
=======================================================

Jarjestelman tarkoitus

Harjoituskirjanpitojarjestelman avulla kayttaja pystyy pitamaan 
kirjaa omista treeneistaan, joissa han kay. Kayttajan 
on mahdollista luoda itselleen omia lajiprofiileita ja lisata niiden 
perusteella itselleen harjoituskertoja. Jarjestelman tavoite on siis 
yllapitaa rekisteria kayttajan harjoituksista ja treenaamisesta.

Kayttajalla on kaytossa oma kayttajaprofiili, jolla han 
kirjautuu jarjestelmaan. Kayttajan lajiprofiileissa kayttaja voi 
kuvailla lajeja, joita han harrastaa.

Harjoituskerta liittyy johonkin tiettyyn alkamisaikaan ja 
harjoituspaivaan. Harjoituskerran avulla pystyy ilmoittamaan kuvauksen 
harjoituksesta, harjoituksen keston ja vaikeusasteen.

Harjoituskerroista jokainen kayttaja voi antaa itselleen arvion, jonka avulla 
voi arvioida, millainen harjoitus oli. Arviossa voi antaa 
numeroarvosanan harjoituksesta ja tyytyvaisyydesta harjoitukseen. 
Lisaksi harjoituskertaa voi arvioida sanallisesti.



Toteutus ja toimintaymparisto

Tietokanta toteutetaan PostreSQL-tietokantana users.cs.helsinki.fi -
palvelimelle. Tietokanta toimii samalla palvelimella 
web-sovelluksena, joka toteutetaan php- ja html-kielilla. Lisaksi 
joitain ominaisuuksia toteutetaan JavaScript-kielella, jota selaimen 
taytyisi tukea. Sovellus ei edellyta minkaan tietyn tietokannan kayttoa. 
Tietokantaa vaihdettaessa pitaisi mahdollisesti muuttaa vain sovelluksen 
kyselyjen syntaksia, jos uudessa tietokannassa on eri syntaksi.
