const factCheked = document.getElementById('fact-checked');
const factChekedContent = document.querySelector('.fact-checked-content');

const removeActive = () => {
  factCheked.classList.remove('active');
  factChekedContent.classList.remove('active');
}

const toggleActive = (e) => {
  factCheked.classList.toggle('active');
  e.target.nextElementSibling.classList.toggle('active');
}

document.addEventListener('click', function (e) {
  if (e.target === factCheked) {
    toggleActive(e);
  } else if (factCheked.classList.contains('active') && e.target.closest('.fact-checked-content') === null) {
    removeActive();
  }
});

factCheked.addEventListener('keydown', function(e) {
  if (e.key === 'Escape' || e.key === 'Tab') {
    removeActive();
  }
});