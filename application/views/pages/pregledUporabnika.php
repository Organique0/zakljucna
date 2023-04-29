<div class="okno">
    <p class="h1 text-center">Izpis uporabnika</p> 
    <p class="h3">Uporabniško ime: <?php echo $podatkiUporabnika->uporabnisko_ime?></p>

    <span>ADMIN: </span>
    <input class="form-check-input" type="checkbox" 
            name=""
            value="" 
            onClick="spremeniAdmin1(<?php echo $podatkiUporabnika->idUporabnika; ?>)" 
            id="admin<?php echo $podatkiUporabnika->idUporabnika?>" 
            <?php if ($this->model->aliJeAdmin($podatkiUporabnika->uporabnisko_ime) == 1) echo "checked"; ?>
    >
    <br>
    <span>SESTAVLJALEC: </span>
    <input class="form-check-input" type="checkbox"
            name=""
            value="" 
            onClick="spremeniAdmin1(<?php echo $podatkiUporabnika->idUporabnika; ?>)" 
            id="admin<?php echo $podatkiUporabnika->idUporabnika?>" 
            <?php if ($this->model->aliJeSestavljalec($podatkiUporabnika->uporabnisko_ime) == 1) echo "checked"; ?>
    >
    <p class="h3">Rešene stopnje:</p>
    <div class="container float-start">
        <table class="table w-25">
            <thead>
                <th scope="col">Stopnja</th>
                <th scope="col">Datum</th>
            </thead>
            <tbody>
            <?php foreach($reseniLeveli as $stopnja){
                echo("<tr>");
                echo("<td>".$stopnja['stopnja']."</td>");
                echo("<td>".$stopnja['datum']."</td>");
                echo("</tr>");
            }
            ?>
        </table>
    </div>
</div>
<style>
    .okno{
        padding:1em;
    }
</style>
<script>
        //get je slaba ideja, ker ni preveč varen. Je pa manj dela.
        async function spremeniAdmin1(idUporabnika){
                if(document.getElementById("admin"+idUporabnika).checked == true){
                        await fetch('<?php echo base_url();?>Pisi/dodajAdmin2?idUporabnika='+idUporabnika);
                }
                else{
                        await fetch('<?php echo base_url();?>Pisi/odstraniAdmin2?idUporabnika='+idUporabnika);
                }       
        };
        async function spremeniSestavljalec1(idUporabnika){
                if(document.getElementById("sestavljalec"+idUporabnika).checked == true){
                        await fetch('<?php echo base_url();?>Pisi/dodajSestavljalec2?idUporabnika='+idUporabnika);
                }
                else{
                        await fetch('<?php echo base_url();?>Pisi/odstraniSestavljalec2?idUporabnika='+idUporabnika);
                }
        };
        
</script>
