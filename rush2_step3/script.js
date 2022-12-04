const fileName = document.querySelector("#dropChamp");
const input = document.querySelector("#input");
const btnOne = document.querySelector("#btnOne");
const btnTwo = document.querySelector("#btnTwo");

btnOne.onclick = () => {
    input.click();
}

input.addEventListener("change", function () {
    // on récupère le ficher selectionné du champ.
    let file = this.files[0];
});

function showFile(file) {
    // on récupère le type du fichier
    let fileType = file.type;
    let fileExtension = ['image/jpeg', 'image/png'];

    // on vérifie la validité du type du fichier;
    if (fileExtension.includes(fileType)) {
        let fileReader = new FileReader();
        fileReader.readAsDataURL(file);

        fileReader.onload = () => {
            let fileUrl = fileReader.result;

            let imgTag = <img src="${fileUrl}" alt="image" />;
            fileName.innerHTML = imgTag;
        }
    }
}