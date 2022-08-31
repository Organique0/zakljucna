<div id="mapa" style="display:none">
  <?php echo (json_encode($labirinti));?>
</div>

<nav id="izbiraLevela" style="margin-left:2.8em; padding-top:0.5em">
    <p class="h4"> Izberi level</p>
    <ul class="pagination">
        <?php 
        for ($s=1; $s<=$this->model->kolikoStopenjObstaja(); $s++){
            echo '<li><button class="btn btn-outline-primary" id='.$s.' onClick="javascript:spremeniLevel('.$s.')">'.$s.'</button></li>';
        };
        echo '<li><button class="btn btn-outline-primary" id="novLevel" onClick="javascript:dodajLevel();")">+</button></li>';
        ?>
    </ul>
</nav>


<div id="content" class="container-fluid">
    <div id ="button-holder"></div>
    <div id="izbira" class="form-check">
        <p class="h3">Izberi tip bloka</p>
        <input class="form-check-input" type="radio" id="stena" name="tipBloka" value="0">
        <label class="form-check-label" for="stena">stena</label><br>
        <input class="form-check-input" type="radio" id="pot" name="tipBloka" value="1">
        <label class="form-check-label" for="pot">pot</label><br>
        <input class="form-check-input" type="radio" id="cilj" name="tipBloka" value="2">
        <label class="form-check-label" for="cilj">cilj</label><br>
        <input class="form-check-input" type="radio" id="start" name="tipBloka" value="3">
        <label class="form-check-label" for="start">start</label><br>
    
    </div>
        <form action="<?php echo base_url();?>Pisi/shrani" method="post" name="labirint">
            <button class="btn btn-outline-success" onClick="spremeniTekstgumba()" id="gumbShrani" type="submit" name="posljiLabirint">Shrani</button>
        </form>
<!--    <form action="<?php // echo base_url();?>Pisi/brisi" method="post" name="labirint">
            <button class="btn btn-outline-danger" value= stopnja id="gumbShrani" type="submit" name="posljiLabirint">Izbriši</button>
        </form> -->
    </div>    
</div>

<style>
    #content{
        display:flex;
        flex:0 0 30em;   
        padding:3em;
    }
    #izbira,#izbiraSmeri{
        margin-left:3em;
    }
    button {
        width: 3em;
        height: 3em;
        border: solid 1px black;
        background:white;
    }
    #button-holder {
        flex:0 0 30em;    
    }
    #gumbShrani{
        margin-left:3em;
        width:6em;
        height: 6em;
    }
    .zacetna{
        background-image:url("https://static.thenounproject.com/png/16977-200.png");
        background-color:yellow;
        background-size:cover;
    }
    .pot{
    background-color:#158cba;
    }
    .cilj{
    background-color:#ff4136;
    }
</style>
<script>
    //gumbu "shrani" priredi vrednost mape levela
    
    function vrniStringMapo(){
        stopnja = vrniStopnjo();
        let labirintMapa=""+trenutnaOrientacijaStevec+stopnja;
        level.forEach(element => {
            element.forEach(element =>{
                labirintMapa+=element;
            })
        });
        return labirintMapa;
    };

    function spremeniTekstgumba() {
        var input = document.getElementById("gumbShrani");
        input.value = vrniStringMapo();
    };

    function izpisiTip() {
        for (var i = 0, length = tip.length; i < length; i++){
            if(tip[i].checked){
                return (tip[i].value);
            }
        }
    }
    //-------------------------------------------------------------------------------------
    //naredi js objekt vseh labirintov 
    const obj = JSON.parse(document.getElementById("mapa").innerHTML);

    var trenutniLevel = 1;
    var stopnja= vrniStopnjo();
    var orientacije = ["desno","dol","levo","gor"];//globalno hrani orientacije
    var zacetnaOrientacijaStevec = vrniTrenutnoOrientacijoStevec(trenutniLevel);
    var trenutnaOrientacijaStevec = zacetnaOrientacijaStevec; 
    var zacetnaPozicijaId;
    var koncnaPozicijaId;
    var trenutnaOrientacija = orientacije[zacetnaOrientacijaStevec];
    var tip = document.getElementsByName('tipBloka');

    function spremeniLevel(z){
        trenutniLevel=z;
        stopnja = vrniStopnjo();
        level = vrniLabirintArray(trenutniLevel);
        ponastavi();
    };

    //naredi string stopnja, ki ima vedno dolzino 3 (za vpis v bazo)
    function vrniStopnjo(){
        return (trenutniLevel.toString().padStart(3, '0'));
    };

    function dodajLevel(){
        trenutniLevel = <?php echo $this->model->kolikoStopenjObstaja()+1?> ;
        stopnja = vrniStopnjo();
        

        trenutnaOrientacija = "levo";
        trenutnaOrientacijaStevec = 2;
        document.getElementById('button-holder').innerHTML = "";
         
        level = [
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0],
    ];

        for(let y = 0; y < 10; y++){
            for(let x = 0; x < 10; x++){
                var btn = document.createElement("button");
                btn.id = x.toString()+y.toString();
                btn.addEventListener("click", function(){klik(x,y)}); //pokliče funkcijo ob kliku
                btn.className = "stena";
                document.getElementById('button-holder').appendChild(btn);
            }
        }
        
        

    }

    //iz json stringa vseh labirintov, generira polje polj, v katerem so vrednosti za izbran labirint
    
    function vrniLabirintArray(trenutniLevel){
        let labirintString = obj[trenutniLevel-1].labirint;
        let labirintArray = [];
        let row;
        for(let y = 0; y < 100; y+=10){
            row=labirintString.slice(y,y+10);
            labirintArray.push(row.split(""));
        }
        return labirintArray;
    };

    var level;
    level=vrniLabirintArray(trenutniLevel);

    generate();
    function generate(){ //10 x 10 gumbov
        var izbranTip;
        for(let y = 0; y < 10; y++){
            for(let x = 0; x < 10; x++){
                var btn = document.createElement("button");
                btn.id = x.toString()+y.toString();
                izbranTip = vrniLabirintArray(trenutniLevel)[y][x];
                if(izbranTip == '3'){
                    zacetnaPozicijaId = ""+x+y; 
                }
                if(izbranTip == '2'){
                    koncnaPozicijaId = ""+x+y;
                }
                btn.addEventListener("click", function(){klik(x,y)}); //pokliče funkcijo ob kliku
                btn.className = nastaviTipClass(x,y,izbranTip);
                document.getElementById('button-holder').appendChild(btn);
            }
        }
    };

    document.getElementsByClassName("zacetna")[0].style.transform = obrniGumb();//spremeni smer puscice
        
    function klik(x,y) {
        izbranTip = izpisiTip();
        switch(izbranTip) {
            case "0":
                document.getElementById(x.toString()+y.toString()).className="stena";
                break;
            case "1":
                document.getElementById(x.toString()+y.toString()).className="pot";
                break;
            case "2":
                document.getElementById(x.toString()+y.toString()).className="cilj";
                break;
            case "3":
                //če zacetek ze obstaja, ne ustari novega
                if(document.getElementsByClassName("zacetna").length == 0){
                    document.getElementById(x.toString()+y.toString()).className="zacetna";
                    obrniDesno();
                    break;
                }
            default:
                if(document.getElementById(x.toString()+y.toString()).className == "zacetna"){
                    obrniDesno();
                    return;
                }
        }
        level[y][x]=Number(izbranTip); //doda nov podseznam na koncu seznama mapa
    };

    function obrniDesno() {//zacetni obrne smer ob kliku
        if(trenutnaOrientacijaStevec == 3){ //ce gre index čez dolzino
            trenutnaOrientacijaStevec = 0; //ga nastavi na začetek
        }
        else{
            trenutnaOrientacijaStevec += 1;
        }
        trenutnaOrientacija = orientacije[trenutnaOrientacijaStevec];
        document.getElementsByClassName("zacetna")[0].style.transform = obrniGumb();
  };

    

    function nastaviTipClass(x,y,izbranTip) {
        switch(izbranTip) {
            case '0':
                return "stena";
            case '1':
                return "pot";
            case '2':
                return "cilj";
            case '3':
                return "zacetna";
            default:     
        }
    };

    function obrniGumb(){
        switch(trenutnaOrientacija){
        case "desno":
            return "rotate(0deg)";
        case "levo":
            return "rotate(180deg)";
        case "gor":
            return "rotate(-90deg)";
        case "dol":
            return "rotate(90deg)";
        }
    };

    //ob zagonu ponastavi na zacetne vrednosti
    function ponastavi(){
        trenutnaOrientacija = orientacije[vrniTrenutnoOrientacijoStevec(trenutniLevel)];
        trenutnaOrientacijaStevec = vrniTrenutnoOrientacijoStevec(trenutniLevel);
        document.getElementById('button-holder').innerHTML = "";
        generate();
        document.getElementsByClassName("zacetna")[0].style.transform = obrniGumb();
    };

    function vrniTrenutnoOrientacijoStevec(trenutniLevel){
        let zacetnaOrientacija = parseInt(obj[trenutniLevel-1].zacetnaOrientacija);
        return zacetnaOrientacija;
    };

    //z fetch API pošlje trenutni level na strežnik (GET metoda)
    async function posljiTrenutniLevel(){
        await fetch('<?php echo base_url();?>Pisi/levelKoncan?trenutniLevel='+trenutniLevel).then(console.log("zaključen level shranjen"));
    };

  //ob zagonu ponastavi na zacetne vrednosti
  function ponastavi(){
      trenutnaOrientacija = orientacije[vrniTrenutnoOrientacijoStevec(trenutniLevel)];
      trenutnaOrientacijaStevec = vrniTrenutnoOrientacijoStevec(trenutniLevel);
      document.getElementById('button-holder').innerHTML = "";
      generate();
      document.getElementsByClassName("zacetna")[0].style.transform = obrniGumb();
  };

  
</script>




