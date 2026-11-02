window.AT = {
  label: 'Watchlist, sekarang tayang',
  ms: 1700,
  intro: '<div class="wl-lead"><b></b></div>',
  bg: function (body) {
    ['wl-strip wl-strip--l', 'wl-strip wl-strip--r', 'wl-grain'].forEach(function (c) {
      var e = document.createElement('div');
      e.className = c;
      e.setAttribute('aria-hidden', 'true');
      body.appendChild(e);
    });
  }
};

/* Alat tabel: cari langsung dan ekspor CSV, tanpa mengubah data di server */
document.addEventListener('DOMContentLoaded', function () {
  var t = document.querySelector('table');
  if (!t || !t.querySelector('tr td')) return;
  var rows = Array.prototype.slice.call(t.querySelectorAll('tr')).filter(function (r) { return r.querySelector('td'); });
  var bar = document.createElement('div');
  bar.className = 'dt-bar';
  bar.innerHTML = '<input type="search" placeholder="Cari di tabel" aria-label="Cari di tabel"><span class="dt-count"></span><button type="button">Ekspor CSV</button>';
  var box = t.closest('.table-card, .table-responsive') || t;
  box.parentNode.insertBefore(bar, box);
  var count = bar.querySelector('.dt-count');
  var show = function (n) { count.textContent = n + ' baris'; };
  show(rows.length);
  bar.querySelector('input').addEventListener('input', function () {
    var q = this.value.toLowerCase(), n = 0;
    rows.forEach(function (r) {
      var hit = r.textContent.toLowerCase().indexOf(q) > -1;
      r.style.display = hit ? '' : 'none';
      if (hit) n++;
    });
    show(n);
  });
  bar.querySelector('button').addEventListener('click', function () {
    var cell = function (c) { return '"' + c.textContent.trim().replace(/\s+/g, ' ').replace(/"/g, '""') + '"'; };
    var lines = Array.prototype.map.call(t.querySelectorAll('tr'), function (r) {
      if (r.style.display === 'none') return null;
      var cs = Array.prototype.slice.call(r.children);
      return cs.slice(0, cs.length - 1).map(cell).join(',');
    }).filter(Boolean);
    var a = document.createElement('a');
    a.href = URL.createObjectURL(new Blob(['\ufeff' + lines.join('\n')], { type: 'text/csv;charset=utf-8' }));
    a.download = 'data.csv';
    a.setAttribute('data-no-at', '');
    document.body.appendChild(a);
    a.click();
    a.remove();
  });
});
