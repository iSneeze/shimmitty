'use strict';

const box = document.querySelector('.mini_upload');
const fileInput = box.querySelector('input[type="file"]');
const dropHintTemplate = box.querySelector('#dropHintTemplate');

const dropHint = dropHintTemplate.content.cloneNode(true).firstElementChild;
const dropText = dropHint.querySelector('.drop-text');
const browseLink = dropHint.querySelector('.browse-link');

fileInput.classList.add('visually-hidden');
fileInput.after(dropHint);

function hasFiles(e) {
    return e.dataTransfer.types.includes('Files');
}

function dragValid() {
    box.classList.add('drag-valid');
    box.classList.remove('drag-invalid');
}

function dragInvalid() {
    box.classList.add('drag-invalid');
    box.classList.remove('drag-valid');
}

function dragEnd() {
    box.classList.remove('drag-valid', 'drag-invalid', 'drag-hover');
}

function dragHover() {
    box.classList.add('drag-hover');
}

function dragHoverEnd() {
    box.classList.remove('drag-hover');
}

document.addEventListener('dragover', e => {
    e.preventDefault();

    if (hasFiles(e)) {
        dragValid();
    } else {
        dragInvalid();
    }
});

document.addEventListener('dragend', dragEnd);

document.addEventListener('drop', e => {
    e.preventDefault();
    dragEnd();
});

box.addEventListener('dragover', e => {
    e.preventDefault();

    dragHover();
    if (hasFiles(e)) {
        e.dataTransfer.dropEffect = 'copy';
    } else {
        e.dataTransfer.dropEffect = 'none';
    }

});

function updateText(e) {
    const newText = fileInput.files.length > 1 ? `${fileInput.files.length} files selected` : `${fileInput.files[0].name}`;
    dropText.textContent = `${newText} - `;
    dropText.title = newText;
    browseLink.textContent = 'change';
}
box.addEventListener('drop', e => {
    e.preventDefault();

    fileInput.files = e.dataTransfer.files;
    updateText();
    dragEnd();
});

box.addEventListener('dragleave', dragHoverEnd);

fileInput.addEventListener('change', updateText);
