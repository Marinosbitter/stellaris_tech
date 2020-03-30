<?php
// WP_Query arguments
$args = array(
    'post_type' => array( 'sgm_tech' ),
    'posts_per_page' => -1,
    's' => 'Kinetic Artillery',
    //    'meta_query'	=> array(
    //        'relation'		=> 'AND',
    //        array(
    //            'key'	 	=> 'is_start_tech',
    //            'value'	  	=> true,
    //        ),
    //    )
);

// The Query
$query_tech = new WP_Query( $args );

// The Loop
if ( $query_tech->have_posts() ) {
    $techs = $query_tech->posts;
}

// Restore original Post Data
wp_reset_postdata();

function getPreReqs($tech){
    $preReqs = get_field('prerequisites', $tech->ID);
    $returnArray = array();

    if(!empty($preReqs)){
        foreach($preReqs as $preReq){
            $returnArray[$preReq->post_title] = getPreReqs($preReq);
        }
        return $returnArray;
    }
}
foreach($techs as $tech){
    print_r(getPreReqs($tech));
}
$jsonArray = array(
    "children" => array(
        "name" => "boss1",
        "children" => array(
            "name"=> "CEO",  
        ),
    )
);
$jsonString = json_encode($jsonArray);
?>
<!-- Load d3.js -->
<script src="https://d3js.org/d3.v4.js"></script>

<!-- Create a div where the graph will take place -->
<div id="my_dataviz"></div>
<script>
    // set the dimensions and margins of the graph
    var width = 460
    var height = 460
    var radius = width / 2 // radius of the dendrogram

    // append the svg object to the body of the page
    var svg = d3.select("#my_dataviz")
    .append("svg")
    .attr("width", width)
    .attr("height", height)
    .append("g")
    .attr("transform", "translate(" + radius + "," + radius + ")");

    // read json data
    // Create the cluster layout:
    var cluster = d3.cluster()
    .size([360, radius - 60]);  // 360 means whole circle. radius - 60 means 60 px of margin around dendrogram

    // Give the data to this cluster layout:
    var root = d3.hierarchy(<?php echo $jsonString; ?>, function(d) {
        return d.children;
    });
    cluster(root);

    // Features of the links between nodes:
    var linksGenerator = d3.linkRadial()
    .angle(function(d) { return d.x / 180 * Math.PI; })
    .radius(function(d) { return d.y; });

    // Add the links between nodes:
    svg.selectAll('path')
        .data(root.links())
        .enter()
        .append('path')
        .attr("d", linksGenerator)
        .style("fill", 'none')
        .attr("stroke", '#ccc')


    // Add a circle for each node.
    svg.selectAll("g")
        .data(root.descendants())
        .enter()
        .append("g")
        .attr("transform", function(d) {
        return "rotate(" + (d.x - 90) + ")translate(" + d.y + ")";
    })
        .append("circle")
        .attr("r", 7)
        .style("fill", "#69b3a2")
        .attr("stroke", "black")
        .style("stroke-width", 2)
    
    console.info(svg.selectAll("g"));
</script>