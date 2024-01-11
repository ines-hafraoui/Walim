//The selection of products for the annonce
let select = document.getElementById("selected");
select.addEventListener( 'click', addSelected());
function addSelected(){
    let select = document.getElementById("products");
    let added= document.getElementById('added');
    let error_message= document.getElementById('error');
    let selection_area = document.querySelectorAll('.products');
    if (error_message){
        error_message.remove();
        select.removeAttribute("class");
    }

    for (let option of select.selectedOptions) {
        let first_letter = option.text.charAt(0);
        let firstLetterCap = first_letter.toUpperCase();
        let remainingletters = option.text.slice(1);
        let Capword = firstLetterCap + remainingletters;
        if(option.text.includes('Séléctionnez')){
            select.setAttribute("class", "error");
            return selection_area[0].innerHTML += '<p id="error" >Vous devez séléctionner un produit</p>';
        }
        else{
            if(added.childElementCount==0){
                added.innerHTML +=`
        <label for="${option.value}" class="label_added"> ${Capword} : </label>
        <input type="hidden" name="products[]" value="${option.value}">
        <input name="qte[]" type="number" min="1">
        <input name="date[]" type="date">
        
        <div className="preview">
            <p>No files currently selected for upload</p>
        </div>`;
            }
            else{
                //Making sure the product hasn't already been added in the product list
                let label = document.querySelectorAll('.label_added');
                for(let i = 0;  i <label.length ; i++ ){
                    if(label[i].innerText.includes(Capword)){
                        select.setAttribute("class", "error");
                        return selection_area[0].innerHTML += '<p id="error" >Ce produit a déjà été ajouté</p>';
                    }
                }
                added.innerHTML +=`
                    <label for="${option.value}" class="label_added"> ${Capword} : </label>
                    <input type="hidden" name="products[]" value="${option.value}">
                    <input name="qte[]" type="number" min="1">
                    <input name="date[]" type="date">
        
                    <div className="preview">
                        <p>No files currently selected for upload</p>
                    </div>`;

            }
        }
    }
}

