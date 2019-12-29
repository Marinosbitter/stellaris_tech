function dataFeedToInput(dataFeed){
    sampleData = {
        "nodes":[
            {"node":0,"name":"node0"},
            {"node":1,"name":"node1"},
            {"node":2,"name":"node2"},
            {"node":3,"name":"node3"},
            {"node":4,"name":"node4"}
        ],
        "links":[
            {"source":0,"target":2,"value":2},
            {"source":1,"target":2,"value":2},
            {"source":1,"target":3,"value":2},
            {"source":0,"target":4,"value":2},
            {"source":2,"target":3,"value":2},
            {"source":2,"target":4,"value":2},
            {"source":3,"target":4,"value":4}
        ]};

    jsonTechData = {
        "nodes":[],
        "links":[]
    }
    
    for(i = 0; i < dataFeed.tech.techs.length; i++){
        jsonTechData.nodes.push({"node":i,"name":dataFeed.tech.techs[i].name}); // Push tech to nodes
    }   // Push all techs to nodes

    for(i = 0; i < dataFeed.tech.techs.length; i++){
        var preReq = [];
        preReq = dataFeed.tech.techs[i].techDetails.prerequisites;
        if(preReq){
            for(ii = 0; ii < preReq.length; ii++){

                var source = findIndexNr(dataFeed, dataFeed.tech.techs[i].name);
                jsonTechData.links.push({"source":source,"target":i,"value":2});  // Add to the links
            }   // For each link
        }    // Check for link
    }   // Walk trough all techs

    console.info(jsonTechData);
    return jsonTechData;
}

function findIndexNr(dataFeed, techName){
    for(j=0;j<dataFeed.tech.techs.length;j++){
        if(dataFeed.tech.techs[j].name == techName){
            return j;
        }
    }
}
function getTechnrByName(techName) {
    return data.filter(
        function(data){ return dataFeed.tech.techs.name == techName }
    );
}