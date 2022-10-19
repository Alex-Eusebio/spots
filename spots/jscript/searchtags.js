function searchTags() {
    document.getElementsByName("estabCard").forEach(a => {
        a.style.display = "block";
    });
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

function checkSearch($id) {
    document.getElementById($id+"Src").checked = true;
    searchTags();
}