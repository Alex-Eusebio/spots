function searchTags(fromText) {
    if (!fromText){
        document.getElementsByName("estabCard").forEach(a => {
            a.style.display = "";
        });
    }

    let tagSearch = document.getElementsByName("tags");
    var foundTags = [];
    tagSearch.forEach(a => {
        if(a.checked){
            let id = a.id;
            let ida=id.substring(0, (a.id.length)-3);
            console.log(ida);
            foundTags.push(ida);
        }
    });
    console.log(foundTags);
    if (foundTags.length > 0){
        let estabs = document.getElementsByName("estabCard");
        var foundEstabsTags = [];
        for(i = 0; i < estabs.length; i++){
            var haveTag = 0;
            for(j=0; j<foundTags.length; j++){
                var estabTags = [];
                document.getElementsByName(estabs[i].id).forEach(a => {
                    estabTags.push(a.id);
                });
                console.log(estabTags.includes(foundTags[j]));
                if (estabTags.includes(foundTags[j])){
                    haveTag++;
                    if(haveTag == foundTags.length)
                        break;
                }
            }
            if (haveTag == foundTags.length){
                foundEstabsTags.push(estabs[i].id);
            }
        }

        console.log(foundEstabsTags);
        document.getElementsByName("estabCard").forEach(a => {
            
            var hide = true;
            for(i=0;i<foundEstabsTags.length;i++){
                console.log(a.id + " | " + foundEstabsTags[i] + " == " + (foundEstabsTags[i] == a.id));
                if (foundEstabsTags[i] == a.id)
                    hide = false;
            }

            console.log(hide);

            if (hide)
                a.style.display = "none";
        });
    } 
  }

function checkSearch(id) {
    document.getElementById(id+"Src").checked = true;
    searchTags(false);
}

function searchText(input) {
    // Declare variables
    var filter, ul, li, a, i, txtValue;
    //input = document.getElementsByClassName('search');
    filter = input.value.toUpperCase();
    ul = document.getElementById("content");
    li = document.getElementsByName('estabCard');
  
    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
      a = li[i].getElementsByTagName("h5")[0];
      txtValue = a.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        li[i].style.display = "";
      } else {
        li[i].style.display = "none";
      }
    }
    searchTags(true);
  }