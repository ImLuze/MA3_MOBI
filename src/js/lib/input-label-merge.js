const showErrorMessages = (errors, containers) => {

  removeErrorMessages(containers);

  for (let i = 0;i < Object.keys(errors).length;i ++) {
    const key = Object.keys(errors)[i];
    const container = errors[key][1];
    const msg = errors[key][0];
    const msgContainer = document.createElement(`p`);

    msgContainer.classList.add(`error-message`);
    msgContainer.innerText = msg;

    container.append(msgContainer);
    container.style.opacity = 1;
  }
};

const removeErrorMessages = containers => {

  for (let i = 0;i < containers.length;i ++) {
    containers[i].style.opacity = 0;
    containers[i].innerHTML = ``;
  }
};

const addError = (errors, key) => {

  errors[key[0]] = [key[1], key[2]];
};

const removeError = (errors, key) => {

  delete errors[key];
};

const onfocus = (input, label, labelValue, containers) => {

  removeErrorMessages(containers);

  if (label.innerText !== labelValue) {
    input.value = label.innerText;
    label.innerText = labelValue;
    label.style.color = ``;
  }
};

const onfocusout = (input, label, errors, labelValue, containers, errorClass, confirmClass) => {

  if (input.value !== ``) {
    label.innerText = input.value;
    input.value = ``;
    if (Object.keys(errors).length > 0) {
      input.classList.add(errorClass);
      showErrorMessages(errors, containers);
    } else {
      input.classList.add(confirmClass);
      removeErrorMessages(containers);
    }
  } else {
    label.innerText = labelValue;
    input.style.border = ``;
    removeErrorMessages(containers);
    Object.keys(errors).forEach(key => {
      removeError(errors, key);
    });

    input.classList.remove(errorClass);
    input.classList.remove(confirmClass);
  }

  if (label.innerText === labelValue) {
    input.style.border = ``;
  }
};

exports.Input = class {
  constructor(input, label) {
    this.input = input;
    this.label = label;
    this.errors = [];
    this.labelValue = label.innerText;

    input.addEventListener(`focus`, () => {
      onfocus(this.input, this.label, this.labelValue, [this.regexErrContainer, this.minlngErrContainer, this.maxlngErrContainer], this.confirmContainer);
    });

    input.addEventListener(`focusout`, () => {
      this.checkIfValueContains(this.check, this.checkErrMsg, this.checkErrContainer);
      this.checkRegex(this.regex, this.regexErrMsg, this.regexErrContainer);
      this.minLength(this.minlng, this.minlngErrMsg, this.minlngErrContainer);
      this.maxLength(this.maxlng, this.maxlngErrMsg, this.maxlngErrContainer);
      onfocusout(this.input, this.label, this.errors, this.labelValue, [this.regexErrContainer, this.minlngErrContainer, this.maxlngErrContainer], this.confirmContainer, this.errorClass, this.confirmClass);
    });
  }

  checkIfValueContains(check, msg, container) {
    this.check = check;
    this.checkErrMsg = msg;
    this.checkErrContainer = container;

    if (typeof this.check !== `undefined`) {
      if (this.input.value.indexOf(this.check) !== - 1) {
        removeError(this.errors, `check`);
      } else {
        addError(this.errors, [`check`, this.checkErrMsg, this.checkErrContainer]);
      }
    }
  }

  checkRegex(regex, msg, container) {
    this.regex = regex;
    this.regexErrMsg = msg;
    this.regexErrContainer = container;

    if (typeof this.regex !== `undefined`) {
      if (new RegExp(this.regex).test(this.input.value)) {
        removeError(this.errors, `regex`);
      } else {
        addError(this.errors, [`regex`, this.regexErrMsg, this.regexErrContainer]);
      }
    }
  }

  minLength(length, msg, container) {
    this.minlng = length;
    this.minlngErrMsg = msg;
    this.minlngErrContainer = container;

    if (typeof this.minlng !== `undefined` && Number.isInteger(this.minlng)) {
      if (this.minlng > this.input.value.length) {
        addError(this.errors, [`minLength`, this.minlngErrMsg, this.minlngErrContainer]);
      } else {
        removeError(this.errors, `minLength`);
      }
    }
  }

  maxLength(length, msg, container) {
    this.maxlng = length;
    this.maxlngErrMsg = msg;
    this.maxlngErrContainer = container;

    if (typeof this.maxlng !== `undefined` && Number.isInteger(this.maxlng)) {
      if (this.maxlng < this.input.value.length) {
        addError(this.errors, [`maxLength`, this.maxlngErrMsg, this.maxlngErrContainer]);
      } else {
        removeError(this.errors, `maxLength`);
      }
    }
  }

  info(btn, popup, info) {
    this.infoBtn = btn;
    this.popup = popup;
    this.info = info;

    let popupActive = false;
    this.popup.style.opacity = 0;

    this.infoBtn.addEventListener(`click`, () => {
      popupActive = !popupActive;

      if (popupActive) {
        this.popup.innerText = this.info;
        this.popup.style.opacity = 1;
      } else {
        this.popup.style.opacity = 0;
      }
    });

    this.input.addEventListener(`focus`, () => {
      popupActive = false;
      this.popup.style.opacity = 0;
    });
  }

  addConfirmation(msg, container) {
    this.confirmContainer = container;
    container.innerText = msg;
    container.style.opacity = 0;
  }
};
