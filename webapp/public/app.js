const output = document.getElementById("apiOutput");
const btn = document.getElementById("refreshBtn");
const apiProxyUrl = "/api.php";

async function loadStatus() {
  output.textContent = "Lade...";
  try {
    const [healthResp, jsonResp] = await Promise.all([
      fetch(`${apiProxyUrl}?endpoint=health`),
      fetch(`${apiProxyUrl}?endpoint=json-items`),
    ]);

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

    const health = await healthResp.json();
    const jsonData = await jsonResp.json();

    output.textContent = JSON.stringify({ health, jsonData }, null, 2);
  } catch (err) {
    output.textContent = `Fehler beim API-Aufruf (${apiProxyUrl}): ${err.message}`;
  }
}

btn.addEventListener("click", loadStatus);
loadStatus();
