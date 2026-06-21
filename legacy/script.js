// Tsega Tigneh — Portfolio
// Shared behavior across pages: nav toggle, scroll reveal, hero terminal typing.

document.addEventListener('DOMContentLoaded', () => {

  /* mobile nav toggle */
  const toggle = document.querySelector('.nav-toggle');
  const links = document.querySelector('.nav-links');
  if (toggle && links) {
    toggle.addEventListener('click', () => {
      links.classList.toggle('open');
    });
    links.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', () => links.classList.remove('open'));
    });
  }

  /* scroll reveal */
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const revealEls = document.querySelectorAll('.reveal');
  if (revealEls.length) {
    if (reduceMotion || !('IntersectionObserver' in window)) {
      revealEls.forEach(el => el.classList.add('in'));
    } else {
      const io = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('in');
            io.unobserve(entry.target);
          }
        });
      }, { threshold: 0.12 });
      revealEls.forEach(el => io.observe(el));
    }
  }

  /* hero terminal typing effect */
  const term = document.querySelector('[data-terminal]');
  if (term && !reduceMotion) {
    const lines = JSON.parse(term.getAttribute('data-terminal'));
    term.innerHTML = '';
    let li = 0;

    function typeLine() {
      if (li >= lines.length) return;
      const { prompt, text, out } = lines[li];
      const row = document.createElement('div');
      row.className = 'line';
      const promptSpan = document.createElement('span');
      promptSpan.className = 'prompt';
      promptSpan.textContent = prompt + ' ';
      const textSpan = document.createElement('span');
      textSpan.className = out ? 'out' : '';
      row.appendChild(promptSpan);
      row.appendChild(textSpan);
      term.appendChild(row);

      let ci = 0;
      const speed = out ? 14 : 38;
      const interval = setInterval(() => {
        textSpan.textContent += text[ci];
        ci++;
        if (ci >= text.length) {
          clearInterval(interval);
          li++;
          setTimeout(typeLine, out ? 480 : 260);
        }
      }, speed);
    }
    typeLine();
  } else if (term) {
    const lines = JSON.parse(term.getAttribute('data-terminal'));
    term.innerHTML = lines.map(l =>
      `<div class="line"><span class="prompt">${l.prompt} </span><span class="${l.out ? 'out' : ''}">${l.text}</span></div>`
    ).join('');
  }

});
