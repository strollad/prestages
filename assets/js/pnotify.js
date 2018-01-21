_alert = window.alert;
window.alert = function (message) {
    text = message.split("|");
    if (text.length == 1) {
        type = 'info';
        titre = 'Information';
        texte = text[0];
    } else if (text.length == 2) {
        type = text[0];
        titre = 'Information';
        texte = text[1];
    } else {
        type = text[0];
        titre = text[1];
        texte = text[2];
    }
    new PNotify({
        type : type,
        title: titre,
        text : texte,
        history: {
            menu: true
        }
    });
};