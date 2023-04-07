var texte150 = document.querySelectorAll('.text150');

for (var i = 0; i < texte150.length; i++) {
    var texte = texte150[i];

    if (texte.textContent.length > 200) {
        texte.textContent = texte.textContent.substring(0, 200) + ' ...';
    }
}