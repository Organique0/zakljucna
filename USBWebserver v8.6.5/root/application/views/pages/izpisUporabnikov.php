<div class="w-50 m-auto">
<table class="table table-hover table-sm">
        <thead class="thead-dark">
                <tr>
                        <th class="p-3">ID</th>
                        <th class="p-3">ime</th>
                        <th class="p-3">E-pošta</th>
                        <th class="p-3 text-center">admin</th>
                        <th class="p-3 text-center">sestavljalec</th>
                        <th></th>
                </tr>   
        </thead>
        <tbody>  
                <?php foreach ($vsiUporabniki as $uporabnik): ?>
                        <tr class="border">
                                <td class="p-3" >
                                        <?php echo $uporabnik['idUporabnika']; ?>
                                </td>
                                <td class="w-auto p-3">
                                        <?php echo $uporabnik['uporabnisko_ime']; ?>
                                </td>
                                <td class="p-3" >
                                        <?php echo $uporabnik['Eposta']; ?>
                                </td>
                                <td class="p-3 text-center" >
                                        <input class="form-check-input" type="checkbox" 
                                        name=""
                                        value="" 
                                        onClick="spremeniAdmin1(<?php echo $uporabnik['idUporabnika']; ?>)" 
                                        id="admin<?php echo $uporabnik['idUporabnika']?>" 
                                        <?php if ($this->model->aliJeAdmin($uporabnik['uporabnisko_ime']) == 1) echo "checked"; ?>>
                                        
                                </td>
                                <td class="p-3 text-center" >
                                        <input class="form-check-input" type="checkbox" 
                                        name=""
                                        value="" 
                                        onClick="spremeniSestavljalec1(<?php echo $uporabnik['idUporabnika']; ?>)"
                                        id="sestavljalec<?php echo $uporabnik['idUporabnika']?>" 
                                        <?php if ($this->model->aliJeSestavljalec($uporabnik['uporabnisko_ime']) == 1) echo "checked"; ?>>

                                </td>
                                <td>   
                                <form action="pregledUporabnika" method="get">
                                        <button type="submit" class="btn btn-outline-primary float-end bi bi-search" name="uporabnisko_ime" value=<?php echo $uporabnik['uporabnisko_ime'];?>>pregled</button>
                                </form>
                                        
                                </td>
                        </tr>
                <?php endforeach; ?>
                
        </tbody>
</table>
</div>
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