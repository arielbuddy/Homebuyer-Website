// FACT CHECK BUBBLE

function hideBubble() {
  document.getElementById('fact-checked-bubble').classList.remove('active');
  // Duration should match CSS transition
  setTimeout(() => {
    document.getElementById('fact-checked-bubble').style.display = 'none';
  }, 150);
}

function showBubble() {
  document.getElementById('fact-checked-bubble').classList.add('active');
  // Duration should match CSS transition
  setTimeout(() => {
    document.getElementById('fact-checked-bubble').style.display = 'block';
  }, 150);
}

document.addEventListener('click', function (e) {
  if (e.target.closest('#fact-checked-bubble') === null) {
    hideBubble();
  }
});

document.getElementById('fact-checked').addEventListener('click', function(e) {
  e.preventDefault();
  e.stopPropagation();
  if (document.getElementById('fact-checked-bubble').classList.contains('active')) {
    hideBubble();
  } else {
    showBubble();
  }
});

// READ MORE CONTENT

document.querySelectorAll('.read-more-link a').forEach(function (link) {
  link.addEventListener('click', (e) => {
    e.preventDefault();
    const id = e.target.getAttribute('data-id');
    const contents = document.getElementById(id);
    if (contents.style['-webkit-line-clamp'] === 'initial') {
      contents.style['-webkit-line-clamp'] = 2;
      link.innerHTML = 'Read More…';
    } else {
      contents.style['-webkit-line-clamp'] = 'initial';
      link.innerHTML = 'Read Less';
    }
  });
});

