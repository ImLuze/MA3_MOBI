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

const init = () => {
  const links = document.querySelectorAll(`.navigation-link`);
  const navigation = document.querySelectorAll(`.navigation`);
  checkActiveLink();

  for (let i = 0;i < links.length;i ++) {
    links[i].addEventListener(`mouseover`, handleLinkHover);
  }
  navigation[0].addEventListener(`mouseleave`, checkActiveLink);
};

init();
