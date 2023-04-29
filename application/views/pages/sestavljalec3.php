<div id="content">
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
        <label class="form-check-label" for="start">start</label>
    </div>
        <form action="<?php echo base_url();?>Pisi/shrani" method="post" name="labirint">
            <button class="btn btn-outline-success" onClick="spremeniTekstgumba()" id="gumbShrani" type="submit" name="posljiLabirint">Shrani</button>
        </form>
    </div>
    <div>
        <?php print_r($labirinti)?>
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

    let level=
        [
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

    var stopnja = "003";
    var orientacije = ["desno","dol","levo","gor"];//globalno hrani orientacije
    var trenutnaOrientacijaStevec = 2; 
    var trenutnaOrientacija = orientacije[trenutnaOrientacijaStevec];

    var tip = document.getElementsByName('tipBloka');

    //gumbu "shrani" priredi vrednost mape levela
    function vrniStringMapo(){
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
    //

    function izpisiTip() {
        for (var i = 0, length = tip.length; i < length; i++){
            if(tip[i].checked){
                return (tip[i].value);
            }
        }
    } 
    generate();
    function generate(){ //10 x 10 gumbov
        for(let y = 0; y < 10; y++){
            for(let x = 0; x < 10; x++){
                var btn = document.createElement("button");
                btn.id = x.toString()+y.toString();//doda id
                btn.addEventListener("click", function(){klik(x,y)}); //pokliče funkcijo ob kliku
                document.getElementById('button-holder').appendChild(btn);  //doda v div 'button-holder'
            }              
        }
    }
        
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
                document.getElementById(x.toString()+y.toString()).className="zacetna";
                obrniDesno();
                break;
            default:
                
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
  function obrniGumb(){
    switch(trenutnaOrientacija){
      case "desno":
        return "rotate(0deg)";
      case "levo":
        return "rotate(180deg)";
      case "gor":
        return "rotate(270deg)";
      case "dol":
        return "rotate(90deg)";
    }
  };
}
</script>




