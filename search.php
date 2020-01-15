<?php
    include("includes/header.php");
    include("includes/classes/Song.php");
    include("includes/classes/Musician.php");

    if(isset($_GET['term'])){
        $term = urldecode($_GET['term']);
        $serchedTerm = "%$term%";
    }else{
        $term = '';
    }
?>
<div>
    <h3>Search for musician or a song</h3>
    <input type="text" class="searchBar" placeholder="start typing...." value="<?php echo $term;?>">

    <script>
    $(function(){
        let setTime;
        $(".searchBar").keyup(function(){
            clearTimeout(setTime);

            setTime = setTimeout(function(){
                let searchValue = $(".searchBar").val();
                let urlParams = new URLSearchParams(location.search);
                urlParams.set('term',searchValue);
                window.location.search = urlParams.toString();
            },2000);
        })
    })

</script>

<?php if($term == '') exit();?>

    <h5>songs</h5>
    <div class="songsResult">
        <?php
            $songQuery = $pdo->prepare("SELECT id FROM songs WHERE title LIKE ?");
            $songQuery->execute([$serchedTerm]);
            $result = $songQuery->fetchAll();
            $num_rows = count($result);
            if($num_rows < 1){
                echo 'no song found with '. $term;
            }

            $songArray = array();
            foreach($result as $song){
                array_push($songArray,$song['id']);

                $songClass = new Song($pdo,$song['id']);
                $songTitle = $songClass->getTitle();
                echo $songTitle.'<br>';
            }

          
        ?>
    </div>


    <h5>musicians</h5>
    <div class="musiciansResult">
        <?php

            $musicianQuery = $pdo->prepare("SELECT id FROM users WHERE isMusician=1 AND firstName LIKE ?");
            $musicianQuery->execute([$serchedTerm]);
            $result = $musicianQuery->fetchAll();
            $num_rows = count($result);
            if($num_rows < 1){
                echo 'no musician found with '. $term;
            }

            $musicianArray = array();
            foreach($result as $musician){
                array_push($musicianArray,$musician['id']);

                $musicianClass = new Musician($pdo,$musician['id']);
                $musicianFirstName = $musicianClass->getFirstName();
                $musicianLastName = $musicianClass->getLastName();
                $musicianId = $musician['id'];
                echo "
                <a href='musician-profile.php?musicianId=".$musicianId."'>".$musicianFirstName ." ".$musicianLastName."</a><br>
                ";
            }


        ?>
    </div>
</div>

