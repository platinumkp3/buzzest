<?php
$con = mysql_connect("localhost", "username", "password");
mysql_select_db("database_name");

$result = mysql_query("select SQL_CALC_FOUND_ROWS * from scroll_images order by id asc limit 12");

$row_object = mysql_query("Select Found_Rows() as rowcount");
$row_object = mysql_fetch_object($row_object);
$actual_row_count = $row_object->rowcount;
?>

<html lang='en'>
    <head>
        <title>Infinite Scroll</title>
        <script src="jquery-1.7.2.js" type="text/javascript"></script>
        <style>
            #result div{
		border: 10px solid #EEEEEE;
    		float: left;
    		height: 300px;
    		margin: 20px;
    outline: 1px solid #CFCFCF;
    width: 300px;
		
	    }
	    #more{
		background: none repeat scroll 0 0 #EEEEEE;
    border: 1px solid #CFCFCF;
    color: #000000;
    display: none;
    font-weight: bold;
    left: 1100px;
    padding: 5px;
    position: fixed;
    top: 100px;

	    }
	    #no-more{
		background: none repeat scroll 0 0 #EEEEEE;
    border: 1px solid #CFCFCF;
    color: #000000;
    display: none;
    font-weight: bold;
    left: 1100px;
    padding: 5px;
    position: fixed;
    top: 100px;

	    }
	    #result{
		
	    }
        </style>
        <script type="text/javascript">
            var page = 1;


            $(window).scroll(function () {
                $('#more').hide();
                $('#no-more').hide();

                if($(window).scrollTop() + $(window).height() > $(document).height() - 200) {
                    $('#more').css("top","400");
                    $('#more').show();
                }
                if($(window).scrollTop() + $(window).height() == $(document).height()) {

                    $('#more').hide();
                    $('#no-more').hide();

                    page++;

                    var data = {
                        page_num: page
                    };

                    var actual_count = "<?php echo $actual_row_count; ?>";
				
                    if((page-1)* 12 > actual_count){
                        $('#no-more').css("top","400");
                        $('#no-more').show();
                    }else{
                        $.ajax({
                            type: "POST",
                            url: "data.php",
                            data:data,
                            success: function(res) {
                                $("#result").append(res);
                                console.log(res);
                            }
                        });
                    }

                }


            });

        </script>
    </head>

    <body>
        <div id='more' >Loading More Content</div>
        <div id='no-more' >No More Content</div>
        <div id='result'>
            <?php
            while ($row = mysql_fetch_array($result)) {
                echo "<div><img src='images/" . $row['name'] . ".jpg' /></div>";
            }
            ?>
        </div>


    </body>
</html>

