/**
 * app.js - Frontend API-Integrationsskript
 * Verwaltet die Kommunikation mit dem Backend über den PHP-API-Proxy
 * Unterstützt parallele API-Anfragen für Health-Status und Datenabruf
 */

const output = document.getElementById("apiOutput");
const btn = document.getElementById("refreshBtn");
const apiProxyUrl = "/api.php";

/**
 * Lädt Status und Daten vom Backend via API-Proxy
 * Nutzt Promise.all für parallele asynchrone Anfragen
 */
async function loadStatus() {
  output.textContent = "Lade...";
  try {
    // Parallele Anfragen an Health-Endpoint und Daten-Endpoint
    const [healthResp, jsonResp] = await Promise.all([
      fetch(`${apiProxyUrl}?endpoint=health`),
      fetch(`${apiProxyUrl}?endpoint=json-items`),
    ]);

    // Fehlerbehandlung für fehlgeschlagene HTTP-Anfragen
    if (!healthResp.ok || !jsonResp.ok) {
      const errors = [];
      if (!healthResp.ok) {
        errors.push(`health ${healthResp.status} ${healthResp.statusText}`);
      }
      if (!jsonResp.ok) {
        errors.push(`json-items ${jsonResp.status} ${jsonResp.statusText}`);
      }
      throw new Error(errors.join(', '));
    }

    // JSON-Daten parsen und formatiert in UI anzeigen
    const health = await healthResp.json();
    const jsonData = await jsonResp.json();
    output.textContent = JSON.stringify({ health, jsonData }, null, 2);
  } catch (err) {
    // Benutzerfreundliche Fehlerausgabe bei API-Fehlern
    output.textContent = `Fehler beim API-Aufruf (${apiProxyUrl}): ${err.message}`;
  }
}

// Event-Listener für Aktualisierungsbutton und initiales Laden
btn.addEventListener("click", loadStatus);
loadStatus();
