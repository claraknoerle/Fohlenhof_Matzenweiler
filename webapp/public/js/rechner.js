document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('rechner-form');
  const resultEl = document.getElementById('rechner-result');
  const PRICE_PER_MONTH = 300;

  if (!form) return;

  form.addEventListener('submit', function(e) {
    e.preventDefault();

    const alterInput = document.getElementById('alter');
    const zielalterInput = document.getElementById('zielalter');

    const alter = parseFloat(alterInput.value.replace(',', '.'));
    const zielalter = parseFloat(zielalterInput.value.replace(',', '.'));

    // Validierung
    const errors = [];
    if (isNaN(alter) || alter < 0) errors.push('Gib ein gültiges aktuelles Alter >= 0 an.');
    if (isNaN(zielalter) || zielalter < 0) errors.push('Gib ein gültiges Zielalter >= 0 an.');
    if (!isNaN(alter) && !isNaN(zielalter) && zielalter < alter) {
      errors.push('Das Zielalter muss >= aktuelles Alter sein.');
    }

    if (errors.length) {
      resultEl.innerHTML = '<div class="error">' + errors.map(e => '<p>'+e+'</p>').join('') + '</div>';
      return;
    }

    // Berechne Aufzuchtdauer und Kosten
    const aufzuchtdauer = zielalter - alter;
    const gesamtkosten = aufzuchtdauer * 12 * PRICE_PER_MONTH;

    const fmt = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' });

    resultEl.innerHTML = `
      <div class="result-card">
        <p><strong>Aufzucht bis Alter:</strong> ${zielalter.toFixed(1)} Jahre</p>
        <p><strong>Aufzuchtdauer:</strong> ${aufzuchtdauer.toFixed(1)} Jahre</p>
        <p><strong>Gesamtkosten:</strong> ${fmt.format(gesamtkosten)}</p>
      </div>
    `;

    resultEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
  });
});

