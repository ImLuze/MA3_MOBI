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

// const isInViewport = (e, elem) => {
//   const rect = elem.getBoundingClientRect();
//   const html = document.documentElement;
//
//   return (
//     rect.top >= 0 &&
//     rect.left >= 0 &&
//     rect.bottom <= ((window.innerHeight) || (html.clientHeight)) &&
//     rect.right <= ((window.innerWidth) || (html.clientWidth))
//   );
// };

const isAtTop = (bottomEl, topEl, distance) => {
  const bottomElRect = bottomEl.getBoundingClientRect();
  const topElRect = topEl.getBoundingClientRect();
  // console.log(bottomElRect.top, topElRect.bottom);
  if(bottomElRect.top <= (topElRect.bottom + distance)) {
    return true;
  } else {
    return false;
  }
};

const setupFixedDayFilter = () => {
  const filter = document.querySelectorAll(`.date-filter`)[0];
  const nav = document.querySelectorAll(`.navigation`)[0];
  const container = document.querySelectorAll(`.cards`)[0];
  const firstPhotoCard = document.querySelectorAll(`.card-photo`)[0];
  // const firstSmallCard = document.querySelectorAll(`.card-small`)[0];

  window.addEventListener(`scroll`, () => {
    if(isAtTop(filter, nav, 1)) {
      filter.classList.add(`date-filter-fixed`);
      container.classList.add(`cards-fixed`);
    }

    if(!isAtTop(firstPhotoCard, filter, 29)) {
      filter.classList.remove(`date-filter-fixed`);
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

const init = () => {
  setupHoverFollower();
  setupFixedDayFilter();
  setupDateFilterLabels();
};

init();
