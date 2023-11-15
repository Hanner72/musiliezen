<?php

// Tabelle St. Pölten abfragen
$sql = "SELECT bew.ww_lager_artikel_id, ar.id, ar.artikelname, sum(menge_ausgang) aus, sum(menge_eingang) ein, sum(menge_eingang-menge_ausgang) lagerstand, ar.lagermindestmenge FROM ww_lager_bewegungen bew, ww_lager_artikel ar 
        WHERE bew.ww_lager_artikel_id = ar.id
        AND lager = 'StPölten'
            GROUP BY bew.ww_lager_artikel_id, ar.id, ar.artikelname, ar.lagermindestmenge";
$result = mysqli_query($conn, $sql);

// Überprüfen, ob die Abfrage erfolgreich war
if (!$result) {
    die("Abfragefehler: " . mysqli_error($conn));
}

// Schleife durchlaufen und Werte überprüfen
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row["id"];
    $artikelname = $row["artikelname"];
    $lagermindestmenge = $row["lagermindestmenge"];
    $lagerstand = $row["lagerstand"];

    // Überprüfen, ob der Wert unter 17 fällt
    if ($lagerstand < $lagermindestmenge) {
        // E-Mail-Benachrichtigung senden
        $to = ERINNERUNGSMAIL_STPOELTEN;
        $subject = "Lagerartikel unter Mindestwert (Artikel: $artikelname)";
        $message = "Der Mindestlagerwert von Artikel '$artikelname' im Lager ST. POELTEN wurde unterschritten. 
        Lagerstand '$lagerstand', Mindestlagerstand '$lagermindestmenge'
        Bitte Bestellung einleiten";
        $headers = "From: lager@dir-ah.at";

        mail($to, $subject, $message, $headers);
    }
}

// Tabelle Thalgau abfragen
$sql = "SELECT bew.ww_lager_artikel_id, ar.id, ar.artikelname, SUM(menge_ausgang) AS aus, SUM(menge_eingang) AS ein, SUM(menge_eingang - menge_ausgang) AS lagerstand, ar.lagermindestmenge_th 
            FROM ww_lager_bewegungen bew
                JOIN ww_lager_artikel ar ON bew.ww_lager_artikel_id = ar.id
                WHERE lager = 'Thalgau'
                    GROUP BY bew.ww_lager_artikel_id, ar.id, ar.artikelname, ar.lagermindestmenge_th";
$result = mysqli_query($conn, $sql);

// Überprüfen, ob die Abfrage erfolgreich war
if (!$result) {
    die("Abfragefehler: " . mysqli_error($conn));
}

// Schleife durchlaufen und Werte überprüfen
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row["id"];
    $artikelname = $row["artikelname"];
    $lagermindestmenge_th = $row["lagermindestmenge_th"];
    $lagerstand = $row["lagerstand"];

    // Überprüfen, ob der Wert unter 17 fällt
    if ($lagerstand < $lagermindestmenge) {
        // E-Mail-Benachrichtigung senden
        $to = ERINNERUNGSMAIL_THALGAU;
        $subject = "Lagerartikel unter Mindestwert (Artikel: $artikelname)";
        $message = "Der Mindestlagerwert von Artikel '$artikelname' im Lager THALGAU wurde unterschritten. 
        Lagerstand '$lagerstand', Mindestlagerstand '$lagermindestmenge_th'
        Bitte Bestellung einleiten";
        $headers = "From: lager@dir-ah.at";

        mail($to, $subject, $message, $headers);
    }
}
?>