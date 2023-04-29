<div id="mapa">
  <?php echo (json_encode($labirinti));?>
</div>

<nav id="izbiraLevela">
  <p class="h4"> Izberi level</p>
  <ul class="pagination">
    <?php 
      $reseniLeveli = isset($_SESSION["upoIme"]) ? $this->model->vrniKoncaneLeveleUporabnika($_SESSION["upoIme"]) :"";
      for ($s=1; $s<=$this->model->kolikoStopenjObstaja(); $s++){
        echo '<li><button class="btn btn-outline-primary" id='.$s.' onClick="javascript:spremeniLevel('.$s.')">'.$s.'</button></li>';
        isset($_SESSION["upoIme"]) ? oznaciResene($reseniLeveli,$s) :"";
    };

    function oznaciResene($reseniLeveli,$s){
      foreach($reseniLeveli as $stopnja){
        if($stopnja['stopnja'] == $s){
          ?>
            <script>
              e = document.getElementById(<?php echo $s?>);
              e.classList.remove("btn-outline-warning");
              e.classList.add("btn-outline-success");
            </script>
          <?php
        }
      }
    }
    ?>
  </ul>
</nav>

<div id="content" >
    <div id="blocklyArea" style="width:40%;"><div id="blocklyDiv" style="height: 45em;"></div></div> <!-- ta div določa velikost polja-->
    <div style="margin:0 1em;">
      <button onclick="runCode()" id="gumbZazeni" class="btn btn-outline-primary">Zaženi</button>
      <br>
      <button onclick="ponastavi();resetInterpreter();" id="gumbResetiraj" class="btn btn-outline-warning" style="margin-top:1em;margin-bottom:1em;">Postavi na zacetek</button>
      <br>
      <button onclick="workspace.clear();ponastavi();resetInterpreter();" id="gumbResetiraj" class="btn btn-outline-danger">Izbrisi vse bloke</button>
    </div>

    <div id ="button-holder">
    </div>

    <div id="rezultat"  class="container" style="width:40%;"></div>
</div>
<!--ko narediš blok v customblocks.js, samo vzstaviš njegovo ime tuki notri, da ga doda v toolbox !-->
<xml  id="toolbox">
  <category name="Logika" colour="#158cba">
    <block type="controls_if"></block>
    <block type="logic_negate"></block>
    <block type="logic_boolean"></block>
    
  </category>
  <category name="Zanke" colour="#28b62c">
    <block type="controls_repeat_ext">
      <value name="TIMES">
        <shadow type="math_number">
          <field name="NUM"></field>
        </shadow>
      </value>
    </block>
    <block type="controls_whileUntil"></block>
    <block type="controls_flow_statements"></block>
  </category>
  
  <sep></sep>
  
  <category name="Premikanje" colour="#ff4136">
    <block type="premikNaprej"></block>
    <block type="obrniDesno"></block>
    <block type="obrniLevo"></block>
    <block type="dosegelKonecPoti"></block>
  </category>
  
</xml>
<style>
  #content{
    display:flex;
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
  #gumbZazeni,#gumbResetiraj{
    margin:0px 5px;
    width:6em;
    height:6em;
  }
  .trenutna{
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
  #mapa{
    color:white; text-indent: 100%;
    white-space: nowrap;
    overflow: hidden;
  }
  #izbiraLevela,#content{
    margin-left:1em;
  }
</style>
<script>
  
    var blocklyArea = document.getElementById('blocklyArea');
    var blocklyDiv = document.getElementById('blocklyDiv');
    
    //nastavitve za blokly delovno površino
    var workspace = Blockly.inject(blocklyDiv,{
    toolbox:document.getElementById('toolbox'),
    trashcan:true,
    plugins: {},
    language: 'javascript',
    grid:{             
        spacing:20,     
        length:3,       
        colour: '#ccc', 
        snap:true,      
    }
});

  //za prikaz kode uporabljam vtičnik monaco editor
  var editor = monaco.editor.create(document.getElementById("rezultat"), {
    language:"javascript",
    roundedSelection: false,
    scrollBeyondLastLine: false,
    readOnly: false,
    theme: "vs-light",
  });

  setTimeout(function() {
    editor.updateOptions({
      lineNumbers: "on"
    });
  }, 2000);


  //skrbi za izpis kode v realnem času 
  function myUpdateFunction(event) {
    Blockly.JavaScript.addReservedWords('code');
    var code = Blockly.JavaScript.workspaceToCode(workspace);
    editor.getModel().setValue(code);
  }
  workspace.addChangeListener(myUpdateFunction);

  var trenutniLevel = 1;
  function spremeniLevel(z){
    trenutniLevel=z;
    zacetnaOrientacijaStevec = function(trenutniLevel){
      let zacetnaOrientacija = obj[trenutniLevel-1].zacetnaOrientacija;
      return zacetnaOrientacija;
    };
    ponastavi();
  }
  function spremeniLevelGor(){
    trenutniLevel+=1;
    zacetnaOrientacijaStevec = function(trenutniLevel){
      let zacetnaOrientacija = obj[trenutniLevel-1].zacetnaOrientacija;
      return zacetnaOrientacija;
    };
    ponastavi();
  }
  function spremeniLevelDol(){
    trenutniLevel-=1;
    zacetnaOrientacijaStevec = function(trenutniLevel){
      let zacetnaOrientacija = obj[trenutniLevel-1].zacetnaOrientacija;
      return zacetnaOrientacija;
    };
    ponastavi();
  }

  //naredi js objekt vseh labirintov 
  const obj = JSON.parse(document.getElementById("mapa").innerHTML); 

  var level = function(trenutniLevel){
    let labirintString = obj[trenutniLevel-1].labirint;
    let labirintArray = [];
    let row;
    for(let y = 0; y < 100; y+=10){
      row=labirintString.slice(y,y+10);
      labirintArray.push(row.split(""));
    }
    return labirintArray;
  };

  generate();
  function generate(){ //10 x 10 gumbov
    var izbranTip;
      for(let y = 0; y < 10; y++){
          for(let x = 0; x < 10; x++){
              var btn = document.createElement("button");
              btn.id = x.toString()+y.toString();
              izbranTip=level(trenutniLevel)[y][x];
              if(izbranTip == '3'){
                zacetnaPozicijaId = ""+x+y; 
              }
              if(izbranTip == '2'){
                koncnaPozicijaId = ""+x+y;
              }
              btn.className = nastaviTipClass(x,y,izbranTip);
              
              document.getElementById('button-holder').appendChild(btn);
        }
      }
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
            return "trenutna";
        default:
            
        }
}

  //ob zagonu ponastavi na zacetne vrednosti
  function ponastavi(){
      trenutnaOrientacija = orientacije[vrniTrenutnoOrientacijoStevec(trenutniLevel)];
      trenutnaOrientacijaStevec = vrniTrenutnoOrientacijoStevec(trenutniLevel);
      document.getElementById('button-holder').innerHTML = "";
      generate();
      document.getElementsByClassName("trenutna")[0].style.transform = obrniGumb();
  };

  function vrniTrenutnoOrientacijoStevec(trenutniLevel){
    let zacetnaOrientacija = parseInt(obj[trenutniLevel-1].zacetnaOrientacija);
    return zacetnaOrientacija;
  }

  //premikanje
  var orientacije = ["desno","dol","levo","gor"];//globalno hrani orientacije
  var zacetnaOrientacijaStevec = vrniTrenutnoOrientacijoStevec(trenutniLevel);
  var trenutnaOrientacijaStevec = zacetnaOrientacijaStevec; 
  var zacetnaPozicijaId;
  var koncnaPozicijaId;
  var trenutnaOrientacija = orientacije[zacetnaOrientacijaStevec];
  document.getElementsByClassName("trenutna")[0].style.transform = obrniGumb();//spremeni smer puscice
  
  //z fetch API pošlje trenutni level na strežnik (GET metoda)
  async function posljiTrenutniLevel(){
    await fetch('<?php echo base_url();?>Pisi/levelKoncan?trenutniLevel='+trenutniLevel).then(console.log("zaključen level shranjen"));
  };

  function kamPremaknem(trenutnaOrientacija,x, y){
    switch(trenutnaOrientacija){
      case "desno":
        x+=1;
        return ""+x+y;
      case "levo":
        x-=1;
        return ""+x+y;
      case "gor":
        y-=1;
        return ""+x+y;
      case "dol":
        y+=1;
        return ""+x+y;
    }
  };
  async function premikNaprej(){
    var trenutna = document.getElementsByClassName("trenutna");

    //trenutna je polje zato je nujno dodati [0]
    let x = parseInt(trenutna[0].id.charAt(0));
    let y = parseInt(trenutna[0].id.charAt(1));

    novID = kamPremaknem(trenutnaOrientacija,x,y); //vrne id naslednjega gumba
    var naslednji = document.getElementById(novID);

    if(naslednji.className == "stena"){
      resetInterpreter(); //izbriše čakalno vrsto izvajanja blokov
      alert("karambol");
      return;
    }
    
    if(naslednji.className == "cilj"){
        trenutna[0].className = "pot";
        naslednji.className = "trenutna";
        document.getElementsByClassName("trenutna")[0].style.transform = obrniGumb();
        await new Promise(r => setTimeout(r, 15)); //počaka, da se premakne, predenj zaključi
        resetInterpreter();
        alert("zmaga");
        posljiTrenutniLevel();
        return;
      }
    trenutna[0].className = "pot";
    naslednji.className = "trenutna";
    document.getElementsByClassName("trenutna")[0].style.transform = obrniGumb();
  }

  function obrniLevo() {
    if(trenutnaOrientacijaStevec == 0){
      trenutnaOrientacijaStevec = 3;
    }
    else{
      trenutnaOrientacijaStevec -= 1;
    }
    trenutnaOrientacija = orientacije[trenutnaOrientacijaStevec];
    document.getElementsByClassName("trenutna")[0].style.transform = obrniGumb();
    
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

  function obrniDesno() {
    if(trenutnaOrientacijaStevec == 3){ //ce gre index čez dolzino
      trenutnaOrientacijaStevec = 0; //ga nastavi na začetek
    }
    else{
      trenutnaOrientacijaStevec = trenutnaOrientacijaStevec + 1;
    }
    trenutnaOrientacija = orientacije[trenutnaOrientacijaStevec];
    document.getElementsByClassName("trenutna")[0].style.transform = obrniGumb();
  };
  
  //JS-Interpreter
  //izbriše čakalno vrsto izvajanja blokov
  function resetInterpreter() {
    myInterpreter = null;
  }
  var myInterpreter = null;
  var runner;
  //najprej moram oviti vse funkcije, ker jih js-interpreter drugače ne vidi
  const initFunc = function(interpreter, globalObject) {

    const wrapper = function() {
      premikNaprej();
    };

    interpreter.setProperty(globalObject, 'premikNaprej', interpreter.createNativeFunction(wrapper));

    const wrapper1 = function() {
      obrniDesno();
    };
    interpreter.setProperty(globalObject, 'obrniDesno', interpreter.createNativeFunction(wrapper1));

    const wrapper2 = function() {
      obrniLevo();
    };
    interpreter.setProperty(globalObject, 'obrniLevo', interpreter.createNativeFunction(wrapper2));

    //za blok, ki preveri ali je konec poti 
    //ta ne dela, če ni definiran tukaj. 
    //Nevem točno zakaj, ampak drugače noče končati, ko bi moral.
    //verjetno je enostavno nekaj v zvezi z tem, kako JSInterpreter deluje
    const wrapper3 = function() {

      var trenutna = document.getElementsByClassName("trenutna");

      //trenutna je polje zato je nujno dodati [0]
      let x = parseInt(trenutna[0].id.charAt(0));
      let y = parseInt(trenutna[0].id.charAt(1));

      novID = kamPremaknem(trenutnaOrientacija,x,y); //vrne id naslednjega gumba
      var naslednji = document.getElementById(novID);

      if(naslednji.className == "stena"){
        return true;
      }
      else{
        return false;
      }
    };
    interpreter.setProperty(globalObject, 'dosegelKonecPoti', interpreter.createNativeFunction(wrapper3));
  };
  function runCode() {
      //prepreči neskončno delovanje
      window.LoopTrap = 1000;
      Blockly.JavaScript.INFINITE_LOOP_TRAP = 'if(--window.LoopTrap == 0) throw "Infinite loop.";\n';
      
      //prebere vso kodo iz dodanih blokov
      var code = Blockly.JavaScript.workspaceToCode(workspace); 
      Blockly.JavaScript.INFINITE_LOOP_TRAP = null;

      //js-interpreter lahko izvaja vsak korak posebaj. Med koraki, lahko poljubno določimo pavzo
      myInterpreter = new Interpreter(code, initFunc);
      try {
        nextStep();
        ponastavi();//ob zagonu ponastavi na zacetne vrednosti
        //myInterpreter.run(); //izvede vso kodo brez pavz
        //eval(code);//izvede vso kodo brez pavz (easy metoda)
      } catch (e) {
        console.log(e);
      }
    
  }
  function nextStep() {
    if(myInterpreter != null){
      if (myInterpreter.step()) {
          window.setTimeout(nextStep, 15);//stevilka določa dolzino pavze
        }
      }
    }

  //s to funkcijo lahko omogočimo, da označuje blok, ki se trenutno izvaja (ubistvu ne dela)
  function highlightBlock(id) {
    workspace.highlightBlock(id);
  }
</script>