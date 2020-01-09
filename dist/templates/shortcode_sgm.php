<?php
ob_start();
// WP_Query arguments
$args = array(
    'post_type' => array( 'sgm_tech' ),
    'posts_per_page' => -1,
    'meta_query'	=> array(
        'relation'		=> 'AND',
        array(
            'key'	 	=> 'is_start_tech',
            'value'	  	=> true,
        ),
    )
);

// The Query
$query_tech = new WP_Query( $args );

// The Loop
if ( $query_tech->have_posts() ) {
    $techs = $query_tech->posts;
}

// Restore original Post Data
wp_reset_postdata();
$data = array("name" => "Technology Tree","children"=>array());
foreach($techs as $tech){
    $pushedTech = array(
        "name" => $tech->post_title,
        "children" => array()
    );
    $children = get_field('children', $tech->ID);
    //    if($tech->){

    //    }
    print_r($children);
    array_push($data['children'], $pushedTech);
}
$data = json_encode($data);
?>
<div id="chartHolder"></div>
<script>
    // set the dimensions and margins of the graph
    var width = 932
    var radius = width / 2 // radius of the dendrogram

    // read json data
    var data = <?php echo $data; ?>;

    function buildChart() {
        const root = tree(d3.hierarchy(data)
                          .sort((a, b) => d3.ascending(a.data.name, b.data.name)));

        const svg = d3.create("svg")
        .style("max-width", "100%")
        .style("height", "auto")
        .style("font", "10px sans-serif")
        .style("margin", "5px");

        const link = svg.append("g")
        .attr("fill", "none")
        .attr("stroke", "#555")
        .attr("stroke-opacity", 0.4)
        .attr("stroke-width", 1.5)
        .selectAll("path")
        .data(root.links())
        .join("path")
        .attr("d", d3.linkRadial()
              .angle(d => d.x)
              .radius(d => d.y));

        const node = svg.append("g")
        .attr("stroke-linejoin", "round")
        .attr("stroke-width", 3)
        .selectAll("g")
        .data(root.descendants().reverse())
        .join("g")
        .attr("transform", d => `
rotate(${d.x * 180 / Math.PI - 90})
translate(${d.y},0)
`);

        node.append("circle")
            .attr("fill", d => d.children ? "#555" : "#999")
            .attr("r", 2.5);

        node.append("text")
            .attr("dy", "0.31em")
            .attr("x", d => d.x < Math.PI === !d.children ? 6 : -6)
            .attr("text-anchor", d => d.x < Math.PI === !d.children ? "start" : "end")
            .attr("transform", d => d.x >= Math.PI ? "rotate(180)" : null)
            .text(d => d.data.name)
            .clone(true).lower()
            .attr("stroke", "white");

        return svg.node();
    }
    tree = d3.tree()
        .size([2 * Math.PI, radius])
        .separation((a, b) => (a.parent == b.parent ? 1 : 2) / a.depth)

    function autoBox() {
        const {x, y, width, height} = this.getBBox();
        return [x, y, width, height];
    }

    var chart = buildChart();
    d3.select("#chartHolder")
        .append(buildChart)
        .attr("viewBox", autoBox);

</script>
<?php 
$output = ob_get_contents();
ob_end_clean();
return $output;