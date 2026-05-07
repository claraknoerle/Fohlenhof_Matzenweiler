const output = document.getElementById("apiOutput");
const btn = document.getElementById("refreshBtn");
const defaultApiBaseUrl = `${window.location.protocol}//${window.location.hostname}:8000`;
const apiBaseUrl = window.PYTHON_API_URL || defaultApiBaseUrl;

async function loadStatus() {
  output.textContent = "Lade...";
  try {
    const [healthResp, jsonResp] = await Promise.all([
      fetch(`${apiBaseUrl}/health`, { mode: "cors" }),
      fetch(`${apiBaseUrl}/json-items`, { mode: "cors" }),
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
    output.textContent = `Fehler beim API-Aufruf (${apiBaseUrl}): ${err.message}`;
  }
}

btn.addEventListener("click", loadStatus);
loadStatus();
