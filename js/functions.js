var patterns = [
    { "regex" : /#(.*)/g, "replace" : "", "purpose" : "Remove all #comments and lines starting with @"},
    { "regex" : /(=)/g, "replace" : ":", "purpose" : "Change all '=' to ':'"},
    { "regex" : /\r?\n|\r/g, "replace" : "", "purpose" : "Remove all newlines"},
    { "regex" : /([^\d\s{\.\-]\w+\b)(?!")/g, "replace" : "\"$&\"", "purpose" : "Change all strings to have quotes"},
    { "regex" : /([><:]+.?\d+)/g, "replace" : ": \"$1\"", "purpose" : "Add quotes to operators in file"},
    { "regex" : /({)( "[^:]*" )(})/g, "replace" : "[$2]", "purpose" : "Apply arrays"},
    { "regex" : /\s/g, "replace" : "", "purpose" : "Remove whitespace"},
    { "regex" : /(["\]}])(")/g, "replace" : "$1,$2", "purpose" : "Add commas"},
    { "regex" : /(\W\d+)(")/g, "replace" : "$1,$2", "purpose" : "Add commas after digets"}
];
var files = [
    //    '/common/technology/00_apocalypse_tech.txt',
    //    '/common/technology/00_distant_stars_tech.txt',
    '/common/technology/00_eng_tech.txt',
    //    '/common/technology/00_eng_tech_repeatable.txt',
    //    '/common/technology/00_eng_weapon_tech.txt',
    //    '/common/technology/00_fallen_empire_tech.txt',
    //    '/common/technology/00_horizonsignal_tech.txt',
    //    '/common/technology/00_leviathans_tech.txt',
    //    '/common/technology/00_megacorp_tech.txt',
    //    '/common/technology/00_megastructures.txt',
    //    '/common/technology/00_phys_tech.txt',
    //    '/common/technology/00_phys_tech_repeatable.txt',
    //    '/common/technology/00_phys_weapon_tech.txt',
    //    '/common/technology/00_repeatable.txt',
    //    '/common/technology/00_soc_tech.txt',
    //    '/common/technology/00_soc_tech_repeatable.txt',
    //    '/common/technology/00_soc_weapon_tech.txt',
    //    '/common/technology/00_strategic_resources_tech.txt',
    '/common/technology/00_synthetic_dawn_tech.txt'
];
// newline regex \r?\n|\r
var jsonData = {
    tech: {
        "techs":"",
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
    var dataFeed = "{";
    for(i = 0; i < files.length; i++){
        dataFeed += loadFile('../data_source/v1'+files[i]);
    }
    console.log(dataFeed);
    for(i = 0; i < patterns.length; i++){
        console.info(patterns[i].purpose + ": " + patterns[i].regex);
        dataFeed = dataFeed.replace(patterns[i].regex, patterns[i].replace);
    }
    dataFeed += "}";
    console.log(dataFeed);

    jsonData.tech.techs = JSON.parse(dataFeed);
}