/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
document
  .querySelectorAll('.add_item_link')
  .forEach((btn) => {
    btn.addEventListener('click', addFormToCollection);
  });

document
  .querySelectorAll('ul.answers li')
  .forEach((answer) => {
    addAnswerFormDeleteLink(answer);
  });

function addFormToCollection(e) {
  const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

  const item = document.createElement('li');

  item.innerHTML = collectionHolder
    .dataset
    .prototype
    .replace(/__name__/g, collectionHolder.dataset.index);

  collectionHolder.appendChild(item);

  addAnswerFormDeleteLink(item);

  collectionHolder.dataset.index++;
}

function addAnswerFormDeleteLink(item) {
  const removeFormButton = document.createElement('button');
  removeFormButton.innerText = 'Supprimer cette réponse';

  item.append(removeFormButton);

  removeFormButton.addEventListener('click', (e) => {
    e.preventDefault();
    item.remove();
  });
}
import './stimulus_bootstrap.js';