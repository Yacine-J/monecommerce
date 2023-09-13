function toggleNav() {
    let nav = document.querySelector("#myTopnav");
    if (nav.className === "topnav") {
        nav.classList += " responsive";
    } else {
        nav.classList = "topnav";
    }
}

function previewImage() {
    let preview = document.querySelector("#preview");
    let fileInput = document.querySelector("#photo");

    let file = fileInput.files[0];

    let reader = new FileReader();

    reader.onloadend = function() {
        preview.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
    }
}