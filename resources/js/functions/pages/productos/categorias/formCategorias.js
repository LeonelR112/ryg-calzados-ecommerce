let btn_selector_img = document.getElementById('btn_selector_img');
let input_search_img = document.getElementById('input_search_img');
let content_selector_img = document.getElementById('content_selector_img');

btn_selector_img.addEventListener('click', e => {$("#modalSelectorDeImagenes").modal('show')})
document.addEventListener('DOMContentLoaded', e => {
    $('#input_descri_l').trumbowyg();
})