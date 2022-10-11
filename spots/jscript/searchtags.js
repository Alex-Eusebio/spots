function searchTags() {
    
    let tagSearch = document.getElementsByName("tags");
    var foundTags = [];
    tagSearch.forEach(a => {
        if(a.checked){
            console.log(a.id);
            foundTags.push(a.id);
        }
    });

    let estabs = document.getElementsByName("estab");
    var foundEstabsTags = [];
    for(i = 0; i < estabs.length; i++){
        var haveTag = false;
        for(j=0; j<foundTags.length; j++){
            var estabTags = Array.from(document.getElementsByName(estabs[i].id));
            if (estabTags.find(foundTags[j])){
                haveTag = true;
                break;
            }
        }
        if (haveTag){
            console.log("have tag");
            foundEstabsTags.push(estabs[i].id);
            break;
        }
    }

  }