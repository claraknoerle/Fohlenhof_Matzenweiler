document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('rechner-form');
  const resultEl = document.getElementById('rechner-result');
  const PRICE_PER_MONTH = 300; // entspricht dem Serverwert

  if (!form) return;

  form.addEventListener('submit', function(e) {
    e.preventDefault();

    const alterInput = document.getElementById('alter');
    const dauerInput = document.getElementById('dauer');

    const alter = parseFloat(alterInput.value.replace(',', '.'));
    const dauer = parseFloat(dauerInput.value.replace(',', '.'));

    // Einfache Validierung
    const errors = [];
    if (isNaN(alter) || alter < 0) errors.push('Gib ein gültiges Alter >= 0 an.');
    if (isNaN(dauer) || dauer < 0) errors.push('Gib eine gültige Dauer >= 0 an.');

    if (errors.length) {
      resultEl.innerHTML = '<div class="error">' + errors.map(e => '<p>'+e+'</p>').join('') + '</div>';
      return;
    }

    const zukunft = (alter + dauer);
    const gesamtkosten = (dauer * 12 * PRICE_PER_MONTH);

    const fmt = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' });

    resultEl.innerHTML = `
      <div class="result-card">
        <p><strong>Zukunftsalter:</strong> ${zukunft.toFixed(1)} Jahre</p>
        <p><strong>Gesamtkosten:</strong> ${fmt.format(gesamtkosten)}</p>
      </div>
    `;

    // Optional: kleine Animation
    resultEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
  });
});
