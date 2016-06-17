function Choix(form) {
i = form.Groupe.selectedIndex;
form.Produit.selectedIndex = 0;
if (i == 0) {
   
    form.Produit.innerHTML="<option></option>";
    form.Produit.options[0].text="--- Produit ---";
  return;
  }
switch (i) {
case 1 : var txt = new Array ('Crabe 50','Crevettes 50','Crevettes 20','Legumes 40','Legumes 20','Porc 100','Porc 50','Porc 20','Poulet 100','Poulet 50','Poulet 20','Poulet Halal 50','Poulet Halal 20','Crousti Crevettes 50','Crousti Crevettes 16','Crousti Poulet 50','Crousti Poulet 20','Grand Crevettes 20','Grand Porc 20','Grand Poulet 20'); break;
case 2 : var txt = new Array ('Agneau 50','Agneau 20','Boeuf 50','Boeuf 20','Boeuf Halal 50','Boeuf Halal 20','SCrevettes 20','SLegumes 50','SLegumes 20','SPoulet 50','SPoulet 20','SPoulet Halal 50','SPoulet Halal 20','SReunion Boeuf Halal 20','SReunion Porc 20'); break;
case 3 : var txt = new Array ('Bouchons Combava 50','Bouchons Combava 16','Bouchons Poulet Halal','Brioches Porc 4','Brioches Porc 2','Brioches Poulet 4','Brioches Poulet 2','Ha Kao Crevettes 100','Ha Kao Crevettes 50','Ha Kao Crevettes Halal 50','Ha Kao Crevettes Halal 15','Sui Kao 30','Sui Kao 15','Siu Mai Crevette 100','Siu Mai Crevette 50','Siu Mai Crevettes Halal 50','Siu Mai Crevettes Halal 16','Siu Mai Porc 100','Siu Mai Porc 50','Perle de Coco 50','Perle de Coco 12','GIO Royal','GIO Dong Huong','GIO Bi Dong Huong'); break;
}
form.Produit.innerHTML="<option></option>";
form.Produit.options[0].text="--- Produit ---";
for (i=0;i<txt.length;i++) {
  form.Produit.appendChild(document.createElement("option"));
  form.Produit.options[i+1].text=txt[i];
  }
}