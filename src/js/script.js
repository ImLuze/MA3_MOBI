import {Input} from './lib/input-label-merge';

NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
  for(let i = this.length - 1; i >= 0; i--) {
    if(this[i] && this[i].parentElement) {
      this[i].parentElement.removeChild(this[i]);
    }
  }
};

const handleLinkHover = e => {
  const currentLink = e.currentTarget.getBoundingClientRect();
  const selector = document.querySelectorAll(`.navigation-selector`);
  selector[0].style.width = `${currentLink.width}px`;
  selector[0].style.left = `${currentLink.x}px`;
};

const checkActiveLink = () => {
  const activeLink = document.querySelectorAll(`.active-link`)[0].getBoundingClientRect();
  const selector = document.querySelectorAll(`.navigation-selector`);
  selector[0].style.width = `${activeLink.width}px`;
  selector[0].style.left = `${activeLink.x}px`;
};

const setupHoverFollower = () => {
  const links = document.querySelectorAll(`.navigation-link`);
  const navigation = document.querySelectorAll(`.navigation`);
  checkActiveLink();

  for (let i = 0;i < links.length;i ++) {
    links[i].addEventListener(`mouseover`, handleLinkHover);
  }
  navigation[0].addEventListener(`mouseleave`, checkActiveLink);
};

const isAtTop = (bottomEl, topEl, distance) => {
  const bottomElRect = bottomEl.getBoundingClientRect();
  const topElRect = topEl.getBoundingClientRect();

  if(bottomElRect.top <= (topElRect.bottom + distance)) {
    return true;
  } else {
    return false;
  }
};

const setupFixedFilter = () => {
  const dateFilter = document.querySelectorAll(`.date-filter`)[0];
  const tagFilter = document.querySelectorAll(`.tag-filter`)[0];
  const selectedTags = document.querySelectorAll(`.selected-tags`)[0];
  const nav = document.querySelectorAll(`.navigation`)[0];
  const container = document.querySelectorAll(`.cards`)[0];
  const firstPhotoCard = document.querySelectorAll(`.card-photo`)[0];
  const firstSmallCard = document.querySelectorAll(`.card-small`)[0];

  window.addEventListener(`scroll`, () => {
    if(isAtTop(dateFilter, nav, 1)) {
      dateFilter.classList.add(`date-filter-fixed`);
      tagFilter.classList.add(`tag-filter-fixed`);
      selectedTags.classList.add(`selected-tags-fixed`);
      container.classList.add(`cards-fixed`);
    }

    if(!isAtTop(firstPhotoCard, dateFilter, 50) && !isAtTop(firstSmallCard, dateFilter, 50)) {
      dateFilter.classList.remove(`date-filter-fixed`);
      tagFilter.classList.remove(`tag-filter-fixed`);
      selectedTags.classList.remove(`selected-tags-fixed`);
      container.classList.remove(`cards-fixed`);
    }
  });

};

const setupDateFilterLabels = () => {
  const labels = document.querySelectorAll(`.date-filter-day-label`);

  window.addEventListener(`resize`, () => {
    for(let i = 0; i < labels.length; i++) {
      if(window.innerWidth < 1000) {
        labels[i].style.marginLeft = `calc(((( 100vw - 2rem) / 7 ) - .1rem ) * ${i})`;
      } else {
        labels[i].style.marginLeft = `calc(((97rem / 7 ) - .1rem ) * ${i})`;
      }
    }
  });

  for(let i = 0; i < labels.length; i++) {
    if(window.innerWidth < 1000) {
      labels[i].style.marginLeft = `calc(((( 100vw - 2rem) / 7 ) - .1rem ) * ${i})`;
    } else {
      labels[i].style.marginLeft = `calc(((97rem / 7 ) - .1rem ) * ${i})`;
    }
  }
};

const checkIfVisible = (container, elem) => {
  const elemRect = elem.getBoundingClientRect();
  const containerRect = container.getBoundingClientRect();

  if(elemRect.x >= containerRect.x && (elemRect.x + elemRect.width) <= (containerRect.x + containerRect.width)) {
    return true;
  } else {
    return false;
  }
};

const addEventListenerToTag = tag => {
  let container;

  tag.addEventListener(`click`, () => {
    const newTag = document.createElement(`p`);
    newTag.classList.add(`tag`);

    if(tag.classList.contains(`selected-tag`)) {
      newTag.classList.add(`tag-filter-tag`);
      container = document.querySelectorAll(`.tag-filter`)[0];
    } else if(tag.classList.contains(`tag-filter-tag`)) {
      newTag.classList.add(`selected-tag`);
      container = document.querySelectorAll(`.selected-tags`)[0];
    }

    newTag.innerText = tag.innerText;
    addEventListenerToTag(newTag);
    container.appendChild(newTag);
    tag.remove();
  });
};

const setupTagSelection = () => {
  const selectedTagsContainer = document.querySelectorAll(`.selected-tags`)[0];
  let selectedTags = document.querySelectorAll(`.selected-tag`);
  const tagsContainer = document.querySelectorAll(`.tag-filter-tags`);
  let tags = document.querySelectorAll(`.tag-filter-tag`);

  for(let i = 0; i < tags.length; i++) {
    tags[i].addEventListener(`click`, () => {
      const tag = document.createElement(`p`);
      tag.classList.add(`tag`);
      tag.classList.add(`selected-tag`);
      tag.innerText = tags[i].innerText;
      addEventListenerToTag(tag);
      selectedTagsContainer.appendChild(tag);
      tags[i].remove();
      selectedTags = document.querySelectorAll(`.selected-tag`);
    });
  }

  for(let i = 0; i < selectedTags.length; i++) {
    selectedTags[i].addEventListener(`click`, () => {
      const tag = document.createElement(`p`);
      tag.classList.add(`tag`);
      tag.classList.add(`tag-filter-tag`);
      tag.innerText = selectedTags[i].innerText;
      tagsContainer.appendChild(tag);
      selectedTags[i].remove();
      tags = document.querySelectorAll(`.tag-filter-tag`);
    });
  }
};

const setupTags = () => {
  const tags = document.querySelectorAll(`.tag-filter-tag`);
  const container = document.querySelectorAll(`.tag-filter`)[0];

  for(let i = 0; i < tags.length; i++) {
    if(!checkIfVisible(container, tags[i])) {
      tags[i].remove();
    }
  }
};

const changeDateFilterText = () => {
  const days = document.querySelectorAll(`.date-filter-day-label p:nth-child(3)`);

  if(window.innerWidth < 600) {
    for(let i = 0; i < days.length; i++) {
      days[i].innerText = `sept`;
    }
  }
};

const scrollOffset = () => {
  const doc = document, w = window;
  let x, y, docEl;

  if ( typeof w.pageYOffset === `number` ) {
    x = w.pageXOffset;
    y = w.pageYOffset;
  } else {
    docEl = (doc.compatMode && doc.compatMode === `CSS1Compat`) ?
      doc.documentElement : doc.body;
    x = docEl.scrollLeft;
    y = docEl.scrollTop;
  }
  return {x: x, y: y};
};

const setupFadingMap = () => {
  let opacity;
  const map = document.querySelectorAll(`.map`)[0];
  const belgium = document.querySelectorAll(`.map`)[1];
  const mapRect = map.getBoundingClientRect();

  window.addEventListener(`scroll`, () => {
    opacity = 1 - ((scrollOffset().y) / 500);
    map.style.filter = `opacity(${opacity})`;
    belgium.style.width = `${mapRect.width - (scrollOffset().y / 2)}px`;

    if(opacity < 0) {
      map.style.filter = `opacity(0)`;
    }
  });
};

const setupInputLabelMerge = () => {
  const input = document.querySelectorAll(`.location-filter`)[0];
  const label = document.querySelectorAll(`.location-filter-label`)[0];
  const errorsContainer = document.querySelectorAll(`.location-filter-errors`)[0];

  const inputLabelMerge = new Input(input, label);
  inputLabelMerge.checkRegex(/^[A-Za-z-\s]+$/, `U mag enkel a-z & A-Z characters gebruiken.`, errorsContainer);
  inputLabelMerge.minLength(3, `Je moet minstens 3 tekens gebruiken.`, errorsContainer);
  inputLabelMerge.maxLength(20, `Je mag maximum 20 tekens gebruiken.`, errorsContainer);
};

const getDistanceBetween = (elem1, elem2) => {
  const rect1 = elem1.getBoundingClientRect();
  const rect2 = elem2.getBoundingClientRect();
  return rect1.bottom - rect2.top;
};

const setupCardsUI = () => {
  const cards = document.querySelectorAll(`.card`);
  const readMore = document.querySelectorAll(`.read-more`);

  if(window.innerWidth > 800) {
    for(let i = 0; i < cards.length - 2; i++) {
      const marginBottom = -getDistanceBetween(readMore[i], cards[i + 2]) - 15;
      cards[i].style.marginBottom = `${marginBottom}px`;

      const marginTop = getDistanceBetween(cards[i], cards[i + 2]) + 15;
      cards[i + 2].style.marginTop = `${marginTop}px`;
    }
  }
};

const setupAjaxRequest = () => {
  const location = document.querySelectorAll(`.location-filter`)[0];
  const container = document.querySelectorAll(`.location-filter-hints`)[0];

  location.addEventListener(`input`, () => {
    if(location.value !== ``) {
      const xmlhttp = new XMLHttpRequest(),
        method = `GET`,
        url = `/events&loc=${location.value}`;

      xmlhttp.onreadystatechange = () => {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
          const response = xmlhttp.responseText.split(`<`)[0];
          const hints = response.split(`, `);

          container.innerHTML = ``;

          for(let i = 0; i < hints.length; i++) {
            const hint = document.createElement(`p`);
            hint.classList.add(`location-filter-hint`);
            hint.innerText = hints[i];

            console.log(location.value);
            hint.addEventListener(`click`, () => {
              location.focus();
              location.value = hint.innerText;
            });

            container.appendChild(hint);
          }
        }
      };

      xmlhttp.open(method, url, true);
      xmlhttp.send();
    }
  });
};

const init = () => {
  setupHoverFollower();
  setupFixedFilter();
  setupDateFilterLabels();
  setupTags();
  setupTagSelection();
  changeDateFilterText();
  setupFadingMap();
  setupInputLabelMerge();
  setupCardsUI();
  setupAjaxRequest();
};

init();
