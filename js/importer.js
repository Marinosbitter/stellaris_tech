var files = [
    '/common/technology/00_apocalypse_tech.txt',
    '/common/technology/00_distant_stars_tech.txt',
    '/common/technology/00_eng_tech.txt',
    '/common/technology/00_eng_tech_repeatable.txt',
    '/common/technology/00_eng_weapon_tech.txt',
    '/common/technology/00_fallen_empire_tech.txt',
    '/common/technology/00_horizonsignal_tech.txt',
    '/common/technology/00_leviathans_tech.txt',
    '/common/technology/00_megacorp_tech.txt',
    '/common/technology/00_megastructures.txt',
    '/common/technology/00_phys_tech.txt',
    '/common/technology/00_phys_tech_repeatable.txt',
    '/common/technology/00_phys_weapon_tech.txt',
    '/common/technology/00_repeatable.txt',
    '/common/technology/00_soc_tech.txt',
    '/common/technology/00_soc_tech_repeatable.txt',
    '/common/technology/00_soc_weapon_tech.txt',
    '/common/technology/00_strategic_resources_tech.txt',
    '/common/technology/00_synthetic_dawn_tech.txt'
];
var nameFixes = [
    {"original":"Distant Stars Story Pack","replacement":"Distant_Stars_Story_Pack"}
];
var skipTechs = [
    "tech_repeatable_improved_sector_cap",
    "tech_repeatable_improved_leader_cap",
    "tech_repeatable_improved_ship_health"
];  // Skipped techs as some techs are commented out
// newline regex \r?\n|\r
var jsonData = {
    tech: {
        "techs":[],
        "weights":"",
        "costs":""
    }
};
function loadFile(filePath) {
    var result = null;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", filePath, false);
    xmlhttp.send();
    if (xmlhttp.status==200 || xmlhttp.status == 0) {
        result = xmlhttp.responseText;
    }
    return result;
}

function getJsonStringFromData(){
    var dataFeed = "";
    for(i = 0; i < files.length; i++){
        dataFeed += loadFile('../data_source/v1'+files[i]);
    }
    //    dataFeed = dataFeed.replace(/(#+)/g, '');
    findTechPattern = /(tech_\w*?)(?= = {)/g; // Find 
    while((match = findTechPattern.exec(dataFeed)) != null){
        var techDetails = "",
            openBrackets = 0,
            closeBrackets = 0,
            looping = true,
            i = match.index + match[0].length + 3;
        while(looping){
            if(dataFeed[i]=="{"){openBrackets++;}
            if(dataFeed[i]=="}"){closeBrackets++;}
            if(openBrackets > 0 && openBrackets == closeBrackets){looping = false;}
            techDetails += dataFeed[i];
            i++;
        }   // Fetch all tech details
        if(!skipTechs.includes(match[0])){
            for(j=0; j<nameFixes.length; j++){
                techDetails = techDetails.replace(RegExp(nameFixes[j].original,'g'),nameFixes[j].replacement);  // Replace names with spaces to underscores
            }   // Fix for names in files with spaces
            techDetails = techDetails.replace(/ = /g,":");  // Replace all "=" with ":"
            techDetails = techDetails.replace(/(<|>|<=|>=) /g,": $1");  // Fix placement of "<" ">"
            techDetails = techDetails.replace(/(#.*)/g,"");  // Remove inline comments
            techDetails = techDetails.replace(/([@\w\.<>=-]+\b)(?!")/g,"\"$1\"");  // Add quotes
            techDetails = techDetails.replace(/:({)([^}:]*)(})/gm,":[$2]");  // Fix arrays
            techDetails = techDetails.replace(/(["\]}])(?!\s*[}\]]|.*[":}\]])/gm,"$1,");  // Add commas
            techDetails = techDetails.replace(/(")( ")/g,"$1,$2");  // Add commas
            techDetails = techDetails.slice(0, -1);  // Remove last comma
            try{   
                techDetails = JSON.parse(techDetails);
            } catch(e) {
                console.error(match[0] + " went wrong " + e);
                console.error(techDetails);
            }
            jsonData.tech.techs.push({
                name:match[0],
                techDetails:techDetails
            });  // Save the tech name to JSON object
        }    // Check for skipped Techs
    }
}

function getJsonDataFeed(){
    getJsonStringFromData();
    return jsonData;
}