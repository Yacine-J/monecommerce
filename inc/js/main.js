function toggleNav() {
    let nav = document.querySelector("#myTopnav");
    if (nav.className === "topnav") {
        nav.classList += " responsive";
    } else {
        nav.classList = "topnav";
    }
}