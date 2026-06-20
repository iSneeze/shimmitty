'use strict';

const box = document.querySelector('.mini_upload');
const fileInput = box.querySelector('input[type="file"]');
const dropHintTemplate = box.querySelector('#dropHintTemplate');

const dropHint = dropHintTemplate.content.cloneNode(true).firstElementChild;

fileInput.hidden = true;
fileInput.after(dropHint);
