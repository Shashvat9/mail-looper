<?php
    ob_start();
    session_start();
    include("./DBmethod.php");

	$api=new APIkeyOperaations();
    if(array_key_exists($__SESSIONID,$_COOKIE)){
        $ar=$api->displayAllkey($_COOKIE[$__SESSIONID]);
    }
    else{
        $ar=$api->displayAllkey($_SESSION[$__SESSIONID]);
    }
    // print_r($ar);

    ?><table style='border: 1px solid black;'>
        <tr>
        <th>apiKey</th>
        <th>lastUsed</th>
        <th>createdOn</th>
        <th>isactive</th>
        </tr>

        <?php
        foreach($ar as $key) {
            ?>
            <tr>
            <td style='border: 1px solid black;'><a href="#" onclick="copyToClipboard('<?php echo $key['apiKey']?>')"><?php echo $key['apiKey']?></a></td>
            <td style='border: 1px solid black;'><?php echo  $key['lastUsed'] ? date("d/m/Y", $key['lastUsed']) : 'Never' ?></td>
            <td style='border: 1px solid black;'><?php echo  date("d/m/Y",$key['createdOn'])?></td>
            <!-- <td style='border: 1px solid black;'><?php //echo  $key['isactive']?></td> -->
            <td style='border: 1px solid black;'>
                <form action="" method="post">
                    <input type="submit" value="<?php if($key['isactive']==1){echo "deactivate";}else{echo "activate";} ?>" name="<?php if($key['isactive']==1){echo "1";}else{echo "0";} ?>" style="<?php if($key['isactive']==1){echo 'background-color: green; color: white;';}else{echo 'background-color: red; color: white;';} ?>">
                    <input type="hidden" name="key" value="<?php echo $key['apiKey'] ?>">
                </form>
            </td>
            </tr>
            
        <?php } ?>
        </table>

    <script>
        function copyToClipboard(text) {
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = text;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
            alert("Copied the API key :" + text);
        }
    </script>

    <?php
    if(array_key_exists("1",$_POST)){
        // echo "deactivate";
        // echo $_POST["key"];
        $api->changeAPIstate($_POST["key"]);
        header("Refresh:0");
    }
    elseif(array_key_exists("0",$_POST)){
        // echo "activate";
        // echo $_POST["key"];
        $api->changeAPIstate($_POST["key"]);
        header("Refresh:0");
    }
    else{
    }
    function isprime($n){
        if($n == 1){
            return false;
        }
        for($i = 2; $i <= sqrt($n); $i++){
            if($n % $i == 0){
                return false;
            }
        }
        return true;
    }
    ob_end_flush();

