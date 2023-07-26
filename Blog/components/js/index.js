const slideOutPanel = $('#slide-out-panel').SlideOutPanel({
    slideFrom:'left',
    enableEscapeKey:true,
    closeBtn:'close',
    closeBtnSize:'14px',
    width: '300px',

});

$('body').on('click', '.open_nav1', () => {
    slideOutPanel.open();
});
