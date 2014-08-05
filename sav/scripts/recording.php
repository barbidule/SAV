<?php
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

    /* NOTE: Replace YOUR_APPLICATION_NAME with the name of your application. */
    $recordings_url = "http://adoutte.com/hdr/scripts/recordings/";

    /* Load the recordings JSON file */
    $file = "recordings.json";
    $string = file_get_contents($file);
    $json = json_decode($string, true);

    /* Select a recording at random */
    $num_recordings = count($json["recordings"]) - 1;
    $random_number = rand(0, $num_recordings);
    $recording = $json["recordings"][$random_number]["file"];
?>

<!-- Play the selected recording -->

<vxml version = "2.1" >
   <form>
      <block>
         <audio src="<?php echo $recordings_url ?><?php echo $recording ?>"/>
      </block>
	  <record name="recording" beep="true" dtmfterm="true" maxtime="100s">
      <catch event="connection.disconnect.hangup">
           <submit next="http://adoutte.com/hdr/scripts/repondeur.php" method="post" namelist="recording callerid" enctype="multipart/form-data"/>
      </catch>
	  <filled>
            <submit next="http://adoutte.com/hdr/scripts/repondeur.php" method="post" namelist="recording callerid" enctype="multipart/form-data"/>
   </filled>
   </record>
   </form>
</vxml>
