<!DOCTYPE html>

<title>
    doolhof mobile edition
</title>

<style>
    html {
        background: black;
        height: 100%; 
        overflow: hidden;
    }
    * {
        touch-action: manipulation;
        /*dit is om er voor te zorgen dat je niet wat kan selecteren.*/
        user-select: none; /* supported by Chrome and Opera */
        -webkit-user-select: none; /* Safari */
        -khtml-user-select: none; /* Konqueror HTML */
        -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
    }
</style>

<?php
if (!isset($_SESSION['pogingen'])) {
    $_SESSION['pogingen'] = 0;
}
?>

<meta name='viewport' content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >

<html>
    <script>
        var time_interval_var;
		var interrupt_interval_var;
        var alive = true;
        var collected = false;
        var left_old, left_new;
        var click = 0;
        var poging = <?php echo $_SESSION['pogingen']; ?>;
            

            
        function get_key() {
            
            

            collision()
            finish_check()
            coin_collect()
            //onderstand is muziek starten als je beweeg, zodat het ook op chrome werkt.
            document.getElementById('muziek').loop = true;
            document.getElementById('muziek').play();

        }
        function up() {
            
            if(click === 0) {
                start_interval();
                click++;
            }

            top_old = parseInt(document.getElementById('player').style.top);
            score_old = parseInt(document.getElementById('score').innerHTML); 
            if (alive === true) {
                if (top_old > 0) {
                    document.getElementById('player').style.top = top_old - 4 + '%';
                    document.getElementById('score').innerHTML =  (score_old - 10);
                    collision()
                    finish_check()
                    coin_collect()
                    var randomsound = parseInt(Math.random() * 3)
                    
                    if(randomsound < 1){
                        document.getElementById('movement1').play();
                         
                    }

                    else {
                        document.getElementById('movement2').play();
                        
                    }
                
                        
                }
                else {
                            
                }
            }
            else {
               
            }
        }

        function down() {
           
            if(click === 0) {
                start_interval();
                click++;
            }
            
            top_old = parseInt(document.getElementById('player').style.top);
            bottom_edge = parseInt(document.getElementById('player').style.top) + parseInt(document.getElementById('player').style.height);
            score_old = parseInt(document.getElementById('score').innerHTML); 
            if (alive === true) {
                if (bottom_edge <= 99) {
                    document.getElementById('player').style.top = top_old + 4 + '%';
                    document.getElementById('score').innerHTML =  (score_old - 10);
                    collision()
                    finish_check()
                    coin_collect()
                    var randomsound = parseInt(Math.random() * 3)
                   
                    if(randomsound < 1){
                        document.getElementById('movement1').play();
                       
                    }

                    else {
                        document.getElementById('movement2').play();
                        
                    }
                }
                else {

                }
                        
                        
            }
            else {
                 
            }
        }
        function left() {
            
            if(click === 0) {
                start_interval();
                click++;
            }

            left_old = parseInt(document.getElementById('player').style.left);
            score_old = parseInt(document.getElementById('score').innerHTML); 
            if (alive === true) {
                if (left_old > 0) {
                    document.getElementById('player').style.left = left_old - 4 + '%';
                    document.getElementById('score').innerHTML =  (score_old - 10);
                    collision()
                    finish_check()
                    coin_collect()
                    var randomsound = parseInt(Math.random() * 3)
                    
                    if(randomsound < 1){
                        document.getElementById('movement1').play();
                        
                    }

                    else {
                        document.getElementById('movement2').play();
                        
                    }
                    
                        
                }
                else {
                            
                }
            }
            else {
               
            }
        }
        function right() {
            
            if(click === 0) {
                start_interval();
                click++;
            }

            left_old = parseInt(document.getElementById('player').style.left);
            right_edge = parseInt(document.getElementById('player').style.left) + parseInt(document.getElementById('player').style.width);
            score_old = parseInt(document.getElementById('score').innerHTML); 
            if (alive === true) {
                if (right_edge <= 99) {
                    document.getElementById('player').style.left = left_old + 4 + '%';
                    document.getElementById('score').innerHTML =  (score_old - 10);
                    collision()
                    finish_check()
                    coin_collect()
                    var randomsound = parseInt(Math.random() * 3)
                   
                    if(randomsound < 1){
                        document.getElementById('movement1').play();
                        
                    }

                    else {
                        document.getElementById('movement2').play();
                       
                    }
                }
                else{

                 }
                
                        
            }
            else {
                
            }
        }

        function score() {
            score_old = parseInt(document.getElementById('score').innerHTML); 

            document.getElementById('score').innerHTML =  (score_old - 2);
        }          

		function interrupt_interval() {
			clearInterval(time_interval_var);
		}

		function start_interval() {
			time_interval_var = setInterval(score, 20);
        }

        function reset_timer() {
            score_old = parseInt(document.getElementById('score').innerHTML); 
            clearInterval(time_interval_var);
            document.getElementById('score').innerHTML =  10000;
        }

        

        function finished() {
            
            sessionStorage.setItem('doolhof', '1');
            sessionStorage.setItem('pogingen', poging);
            window.location.href = 'index.php?pagina=einde&score=' + document.getElementById('score').innerHTML + '&doolhof=1&pogingen=' + poging;
        }


        function collision() {
            
            player.top = parseInt(document.getElementById('player').style.top);
            player.left = parseInt(document.getElementById('player').style.left);
            player.bottom = parseInt(document.getElementById('player').style.top) + parseInt(document.getElementById('player').style.height);
            player.right = parseInt(document.getElementById('player').style.left) + parseInt(document.getElementById('player').style.width);      
            //als het maximale getal te hoog is werkt de finish niet.
            for(var i = 1; i < 42; ++i) {
            
                //0.01 steeds zodat er geen collision is als ze elkaar raken maar niet overlappen.
                var muur_top = parseInt(document.getElementById('muur' + i).style.top) + 0.01;
                var muur_left = parseInt(document.getElementById('muur' + i).style.left) + 0.01;
                var muur_bottom = parseInt(document.getElementById('muur' + i).style.top) + parseInt(document.getElementById('muur' + i).style.height) - 0.01;
                var muur_right = parseInt(document.getElementById('muur' + i).style.left) + parseInt(document.getElementById('muur' + i).style.width) - 0.01;       
                
            
                
                if (player.top > muur_bottom || player.right < muur_left || player.bottom < muur_top || player.left > muur_right) {
                
                    
                

                }
                
                else {
                    if (alive === true) {
                    document.getElementById('explosion').play();
                    document.getElementById('score').innerHTML =  'dacht je echt dat je zo kon finishen?';
                    //voor makkelijker testen volgende 2 regels comments maken.
                    alive = false;
                    setTimeout(reset_player, 1000);
                    }

                    else {
                        //collision voor de 2e keer dus niks doen.
                        
                    }
                }
            
            }

        }
        function finish_check() {
            
            player.top = parseInt(document.getElementById('player').style.top);
            player.left = parseInt(document.getElementById('player').style.left);
            player.bottom = parseInt(document.getElementById('player').style.top) + parseInt(document.getElementById('player').style.height);
            player.right = parseInt(document.getElementById('player').style.left) + parseInt(document.getElementById('player').style.width);      
            
            
            
            var finish_top = parseInt(document.getElementById('finish').style.top) + 0.01;
            var finish_left = parseInt(document.getElementById('finish').style.left) + 0.01;
            var finish_bottom = parseInt(document.getElementById('finish').style.top) + parseInt(document.getElementById('finish').style.height) - 0.01;
            var finish_right = parseInt(document.getElementById('finish').style.left) + parseInt(document.getElementById('finish').style.width) - 0.01;       
            

            
           
            if (player.top > finish_bottom || player.right < finish_left || player.bottom < finish_top || player.left > finish_right) {
            
               
            

            }
            
            else {
                alive = false;
                clearInterval(time_interval_var);
                sessionStorage.setItem('score', document.getElementById('score').innerHTML);
                //document.getElementById('victory').play(); word niet meer gebruikt
                finished();
            }
            
            

        }

        function make_coin() {
            var number = parseInt((Math.random() * 3) + 1);
            if (number < 2) {
                var anchor = document.getElementById("coin");
                var coin = document.createAttribute("style");      
                coin.value = "visibility: visable; position: absolute; content:url(coin.png); left:36%; top: 86%; width: 4%; height: 10%; background-color: #00009900; color: white; text-align: center;";                          
                anchor.setAttributeNode(coin);                          
            }
            else if (number > 2) {
                var anchor = document.getElementById("coin");
                var coin = document.createAttribute("style");      
                coin.value = "visibility: visable; position: absolute; content:url(coin.png); left:68%; top: 72%; width: 4%; height: 10%; background-color: #00009900; color: white; text-align: center;";                          
                anchor.setAttributeNode(coin);   
            }
            else {
                var anchor = document.getElementById("coin");
                var coin = document.createAttribute("style");      
                coin.value = "visibility: visable; position: absolute; content:url(coin.png); left:52%; top: 4%; width: 4%; height: 10%; background-color: #00009900; color: white; text-align: center;";                          
                anchor.setAttributeNode(coin);   
            }
                
        }

        function coin_collect() {
             
            
            player.top = parseInt(document.getElementById('player').style.top);
            player.left = parseInt(document.getElementById('player').style.left);
            player.bottom = parseInt(document.getElementById('player').style.top) + parseInt(document.getElementById('player').style.height);
            player.right = parseInt(document.getElementById('player').style.left) + parseInt(document.getElementById('player').style.width);      
            
            //kijkt of de coin al is gepakt zodat je hem niet meerdere keren kan pakken
            if (collected === false) {
                //0.01 steeds zodat er geen collision is als ze elkaar raken maar niet overlappen.
                var coin_top = parseInt(document.getElementById('coin').style.top) + 0.01;
                var coin_left = parseInt(document.getElementById('coin').style.left) + 0.01;
                var coin_bottom = parseInt(document.getElementById('coin').style.top) + parseInt(document.getElementById('coin').style.height) - 0.01;
                var coin_right = parseInt(document.getElementById('coin').style.left) + parseInt(document.getElementById('coin').style.width) - 0.01;       
                

                if (player.top > coin_bottom || player.right < coin_left || player.bottom < coin_top || player.left > coin_right) {
                    
                        
                        

                }
                        
                else {
                    score_old = parseInt(document.getElementById('score').innerHTML);
                    document.getElementById('score').innerHTML =  (score_old + 1000);
                    document.getElementById('coin_collect').play();   
                    document.getElementById('coin').style.visibility = 'hidden';
                    collected = true;
                            
                }
                    
            }

            else {
                
            }
                    
                    
        }
        

        function reset_player() {
            document.getElementById('player').style.top =  45 +  "%";
            document.getElementById('player').style.left =  0 + "%";  
            reset_timer();
            poging = poging + 1;
            alive = true;
            collected = false;
            make_coin();
            click = 0;
        }
        

    </script>
    <body onkeydown="get_key()" onload="reset_player(); coin_collect()">
        <main>   
        
		
            <div id="muur1" style="position: absolute; top: 42%; left: 0%; height: 1%; width: 11%; background-color: white;"></div>
            
            <div id="muur2" style="position: absolute; top: 56%; left: 0%; height: 1%; width: 11%; background-color: white;"></div>
         
            <div id = "muur3" style="position: absolute; top: 0%; left: 0%; height: 2%; width: 100%; background-color: white;"></div> 
            
            <div id = "muur4" style="position: absolute; top: 2%; left: 0%; height: 40%; width: 2%; background-color: white;"></div>
            
            <div id="muur5" style="position: absolute; top: 57%; left: 0%; height: 41%; width: 2%; background-color: white;"></div>

            <div id="muur6" style="position: absolute; top: 98%; left: 0%; height: 2%; width: 100%; background-color: white;"></div>

            <div id="muur7" style="position: absolute; top: 0%; left: 94%; height: 8%; width: 6%; background-color: white;"></div>

            <div id="muur8" style="position: absolute; top: 15%; left: 9%; height: 12%; width: 1%; background-color: white;"></div>

            <div id="muur9" style="position: absolute; top: 27%; left: 9%; height: 1%; width: 9%; background-color: white;"></div>

            <div id="muur10" style="position: absolute; top: 27%; left: 17%; height: 40%; width: 1%; background-color: white;"></div>

            <div id="muur11" style="position: absolute; top: 15%; left: 17%; height: 1%; width: 18%; background-color: white;"></div>

            <div id="muur12" style="position: absolute; top: 15%; left: 25%; height: 20%; width: 1%; background-color: white;"></div>

            <div id="muur13" style="position: absolute; top: 43%; left: 83%; height: 1%; width: 17%; background-color: white;"></div>

            <div id="muur14" style="position: absolute; top: 56%; left: 75%; height: 1%; width: 25%; background-color: white;"></div>

            <div id="muur15" style="position: absolute; top: 48%; left: 18%; height: 1%; width: 37%; background-color: white;"></div>

            <div id="muur16" style="position: absolute; top: 67%; left: 10%; height: 16%; width: 1%; background-color: white;"></div>

            <div id="muur17" style="position: absolute; top: 65%; left: 25%; height: 1%; width: 13%; background-color: white;"></div>

            <div id="muur18" style="position: absolute; top: 83%; left: 10%; height: 1%; width: 16%; background-color: white;"></div>

            <div id="muur19" style="position: absolute; top: 65%; left: 25%; height: 19%; width: 1%; background-color: white;"></div>

            <div id="muur20" style="position: absolute; top: 34%; left: 34%; height: 1%; width: 8%; background-color: white;"></div>

            <div id="muur21" style="position: absolute; top: 15%; left: 42%; height: 20%; width: 1%; background-color: white;"></div>

            <div id="muur22" style="position: absolute; top: 15%; left: 42%; height: 1%; width: 15%; background-color: white;"></div>

            <div id="muur23" style="position: absolute; top: 2%; left: 57%; height: 14%; width: 1%; background-color: white;"></div>

            <div id="muur24" style="position: absolute; top: 83%; left: 34%; height: 1%; width: 12%; background-color: white;"></div>

            <div id="muur25" style="position: absolute; top: 65%; left: 46%; height: 19%; width: 1%; background-color: white;"></div>

            <div id="muur26" style="position: absolute; top: 65%; left: 46%; height: 1%; width: 10%; background-color: white;"></div>

            <div id="muur27" style="position: absolute; top: 84%; left: 56%; height: 14%; width: 1%; background-color: white;"></div>

            <div id="muur28" style="position: absolute; top: 84%; left: 66%; height: 1%; width: 25%; background-color: white;"></div>

            <div id="muur29" style="position: absolute; top: 8%; left: 98%; height: 35%; width: 2%; background-color: white;"></div>

            <div id="muur30" style="position: absolute; top: 57%; left: 98%; height: 41%; width: 2%; background-color: white;"></div>

            <div id="muur31" style="position: absolute; top: 43%; left: 66%; height: 41%; width: 1%; background-color: white;"></div>

            <div id="muur32" style="position: absolute; top: 70%; left: 67%; height: 1%; width: 24%; background-color: white;"></div>

            <div id="muur33" style="position: absolute; top: 83%; left: 34%; height: 15%; width: 1%; background-color: white;"></div>

            <div id="muur34" style="position: absolute; top: 31%; left: 74%; height: 1%; width: 13%; background-color: white;"></div>

            <div id="muur35" style="position: absolute; top: 32%; left: 55%; height: 17%; width: 1%; background-color: white;"></div>

            <div id="muur36" style="position: absolute; top: 32%; left: 56%; height: 1%; width: 10%; background-color: white;"></div>

            <div id="muur37" style="position: absolute; top: 15%; left: 66%; height: 1%; width: 20%; background-color: white;"></div>

            <div id="muur38" style="position: absolute; top: 43%; left: 66%; height: 1%; width: 8%; background-color: white;"></div>

            <div id="muur39" style="position: absolute; top: 43%; left: 66%; height: 1%; width: 8%; background-color: white;"></div>

            <div id="muur40" style="position: absolute; top: 31%; left: 74%; height: 13%; width: 1%; background-color: white;"></div>

            <div id="muur41" style="position: absolute; top: 15%; left: 86%; height: 16%; width: 1%; background-color: white;"></div>

            <div id="muur42" style="position: absolute; top: 31%; left: 74%; height: 1%; width: 13%; background-color: white;"></div>


            <p id="score_text"style="color: black; position:absolute; left: 95%; top:  0%; margin: 0%; font-size: 80%;">
                score:
            </p>
            
            <p id="score"style="color: black; position:absolute; left: 95%; top:  4%; margin: 0%; font-size: 80%;">
                10000
            </p>
           

            <div id="finish" style="position: absolute; top: 44%; left: 94%; height: 12%; width: 6%; background-color: green;"></div>

            
            <div id="coin" class="image"></div>
            
            
            <div id="player" class="image" style="position: absolute; content:url(Ricardo.png); left:0%; top: 45%; width: 4%; height: 10%; background-color: #00009900; color: white; text-align: center;" ></div>


            <button id='up' onclick="up(); get_key()" style='position: absolute; font-size:100%; left:14%; top: 63%; width: 8%; height: 16%; background-color: #00009900; color: white; text-align: center; padding: 0px; color: rgb(0, 195, 255);'>up</button>

            <button id='down' onclick="down(); get_key()" style='position: absolute; font-size:100%; left:14%; top: 80%; width: 8%; height: 16%; background-color: #00009900; color: white; padding: 0px; text-align:center; color: rgb(0, 195, 255);''>down</button>

            <button id='left' onclick="left(); get_key()" style='position: absolute; font-size:100%; left:5%; top: 80%; width: 8%; height: 16%; background-color: #00009900; color: white; text-align: center; padding: 0px; color: rgb(0, 195, 255);''>left</button>

            <button id='right' onclick="right(); get_key()" style='position: absolute; font-size:100%; left:24%; top: 80%; width: 8%; height: 16%; background-color: #00009900; color: white; text-align: center; padding: 0px; color: rgb(0, 195, 255);''>right</button>


            <audio id="movement1">
                <source src="movement1.mp3" type="audio/mp3">
            </audio>

            <audio id="movement2">
                <source src="movement2.mp3" type="audio/mp3">
            </audio>

            <audio id="explosion">
                <source src="explosion.mp3" type="audio/mp3">
            </audio>

            <audio id="victory">
                <source src="victory.mp3" type="audio/mp3">
            </audio>

            <audio id="coin_collect">
                <source src="coin.mp3" type="audio/mp3">
            </audio>
            
            <!--de muziek. werkt niet in chrome omdat daar autoplay geblokkeerd is. dus daar speelt het als je beweegt.-->
            <audio id="muziek" autoplay loop>
                <source src="muziek.mp3" type="audio/mp3">
            </audio>
            
        </main>
    </body>
</html>